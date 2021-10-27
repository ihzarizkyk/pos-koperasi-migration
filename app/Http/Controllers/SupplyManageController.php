<?php

namespace App\Http\Controllers;

use PDF;
use Auth;
use Session;
use Carbon\Carbon;
use App\Acces;
use App\Supply;
use App\Supplier;
use App\Market;
use App\Product;
use App\Category;
use App\Activity;
use App\detail_supplies;
use App\Supply_system;
use App\Imports\SupplyImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class SupplyManageController extends Controller
{
    // Supply System
    public function supplySystem($id)
    {
        $id_account = Auth::id();
        $check_access = Acces::where('user', $id_account)
        ->first();
        if($check_access->kelola_barang == 1){
            $supply_system = Supply_system::first();
            if($id == 'active'){
                $supply_system->status = true;
                $supply_system->save();

                Session::flash('supply_system_status', 'Sistem berhasil diaktifkan');

                return back();
            }else{
                $supply_system->status = false;
                $supply_system->save();

                Session::flash('supply_system_status', 'Sistem berhasil dinonaktifkan');

                return back();
            }
        }else{
            return back();
        }
    }

    // Show View Supply
    public function viewSupply()
    {
        $id_account = Auth::id();
        $product = Product::all();
        $supplier = Supplier::all();
        $check_access = Acces::where('user', $id_account)
        ->first();
        $pasok = Supply::all();
        $supply_system = Supply_system::first();
        if($check_access->kelola_barang == 1 && $supply_system->status == true){
            $supplies = Supply::all();
            $array = array();
            foreach ($supplies as $no => $supply) {
                array_push($array, $supplies[$no]->created_at->toDateString());
            }
            $dates = array_unique($array);
            rsort($dates);

            return view('manage_product.supply_product.supply', compact('dates', 'product', 'pasok', 'supplier'));
        }else{
            return back();
        }
    }

    // Show View Statistic Supply
    public function statisticsSupply()
    {
        $id_account = Auth::id();
        $check_access = Acces::where('user', $id_account)
        ->first();
        $supply_system = Supply_system::first();
        if($check_access->kelola_barang == 1 && $supply_system->status == true){
        	$products = Product::all()
        	->sortBy('kode_barang');
        	
        	return view('manage_product.supply_product.statistics_supply', compact('products'));
        }else{
            return back();
        }
    }

    // Show View New Supply
    public function viewNewSupply()
    {
        $id_account = Auth::id();
        $supply = Supplier::all();
        $check_access = Acces::where('user', $id_account)
        ->first();
        $supply_system = Supply_system::first();
        $category = Category::all();
        if($check_access->kelola_barang == 1 && $supply_system->status == true){
            $products = Product::all()
            ->sortBy('kode_barang');

            return view('manage_product.supply_product.new_supply', compact('products', 'supply', 'category'));
        }else{
            return back();
        }
    }

    // Check Supply Data
    public function checkSupplyCheck($id)
    {
        $id_account = Auth::id();
        $check_access = Acces::where('user', $id_account)
        ->first();
        $supply_system = Supply_system::first();
        if($check_access->kelola_barang == 1 && $supply_system->status == true){
            $check_product = Product::where('kode_barang', $id)
            ->count();

            if($check_product != 0){
                echo "sukses";
            }else{
                echo "gagal";
            }
        }else{
            return back();
        }
    }

    // Take Supply Data
    public function checkSupplyData($id)
    {
        $id_account = Auth::id();
        $check_access = Acces::where('user', $id_account)
        ->first();
        $supply_system = Supply_system::first();
        if($check_access->kelola_barang == 1 && $supply_system->status == true){
            $product = Product::where('kode_barang', $id)
            ->first();

            return response()->json(['product' => $product]);
        }else{
            return back();
        }
    }

    // Take Supply Statics Product
    public function statisticsProduct($id)
    {
        $id_account = Auth::id();
        $check_access = Acces::where('user', $id_account)
        ->first();
        $supply_system = Supply_system::first();
        if($check_access->kelola_barang == 1 && $supply_system->status == true){
        	$product = Product::where('kode_barang', '=', $id)
        	->first();
        	$supplies = Supply::where('kode_barang', '=', $id)
            ->select('supplies.*')
            ->orderBy('created_at', 'ASC')
            ->get();
            $dates = array();
            $ammounts = array();
            foreach ($supplies as $no => $supply) {
            	$dates[$no] = date('d M, Y', strtotime($supply->created_at));
            	$ammounts[$no] = $supply->harga_beli;
            }

        	return response()->json([
        		'product' => $product,
        		'dates' => $dates,
        		'ammounts' => $ammounts
        	]);
        }else{
            return back();
        }
    }

    // Take Supply Statics Users
    public function statisticsUsers($id)
    {
        $id_account = Auth::id();
        $check_access = Acces::where('user', $id_account)
        ->first();
        $supply_system = Supply_system::first();
        if($check_access->kelola_barang == 1 && $supply_system->status == true){
        	$total_user = Supply::select('id_pemasok')
            ->where('kode_barang', '=', $id)
            ->distinct()
            ->get();

            echo $total_user->count() . ' Pemasok';
        }else{
            return back();
        }
    }

    // Take Supply Statics Table
    public function statisticsTable($id)
    {
        $id_account = Auth::id();
        $check_access = Acces::where('user', $id_account)
        ->first();
        $supply_system = Supply_system::first();
        if($check_access->kelola_barang == 1 && $supply_system->status == true){
        	$supplies = Supply::where('kode_barang', '=', $id)
            ->select('supplies.*')
            ->orderBy('created_at', 'DESC')
            ->get();

            return view('manage_product.supply_product.statistics_table', compact('supplies'));
        }else{
            return back();
        }
    }

    // Create New Supply
    public function createSupply(Request $req)
    {
        $id_account = Auth::id();
        $check_access = Acces::where('user', $id_account)
        ->first();
        $supply_system = Supply_system::first();
        if($check_access->kelola_barang == 1 && $supply_system->status == true){
            if ($req->has('fullfill')) {
                $jumlah_data = 0;
                
                $supply = new Supply;
                $supply->nota = $req->nota;
                $supply->suppliers_id = $req->supplier;
                $supply->status = 1;
                $supply->id_pemasok = Auth::id();
                $supply->date = $req->date;
                $supply->save();

                foreach ($req->kode_barang_supply as $no => $kode_barang) {
                    $product_status = Product::where('kode_barang', $kode_barang)
                    ->first();

                    if($product_status->stok == 0){
                        $product_status->keterangan = 'Tersedia';
                        $product_status->save();
                    }

                    $product = Product::where('kode_barang', $kode_barang)
                    ->first();

                    if ($product->hpp != 0) {
                        //hpp
                        $hpp = (($product->stok * $product->hpp) + ($req->jumlah_supply[$no] * $req->harga_beli_supply[$no])) / ($product->stok + $req->jumlah_supply[$no]);
                        $product->hpp = $hpp;
                        // $laba_rupiah = $hpp - $product->harga;
                        // $laba_persen = $laba_rupiah / $hpp * 100;

                        // $product->laba_rupiah = $laba_rupiah;
                        // $product->laba_persen = $laba_persen;
                        
                        $product->save();
                    }

                    $detail = new detail_supplies;
                    $detail->supplies_id = $supply->id;
                    $detail->kode_barang = $kode_barang;
                    $detail->nama_barang = $product->nama_barang;
                    $detail->jumlah = $req->jumlah_supply[$no];
                    $detail->tempat_beli = $req->tempat_beli[$no];
                    $detail->harga_beli = $req->harga_beli_supply[$no];
                    $detail->subtotal = $req->subtotal[$no];
                    $detail->status = 1;
                    $detail->save();
                    $jumlah_data += 1;
                }

                $activity = new Activity;
                $activity->id_user = Auth::id();
                $activity->user = Auth::user()->nama;
                $activity->nama_kegiatan = 'pasok';
                $activity->jumlah = $jumlah_data;
                $activity->save();
                Session::flash('create_success', 'Barang berhasil dipasok');

                return redirect('/supply');
            }
            elseif ($req->has('create')) {
                $jumlah_data = 0;

                $supply = new Supply;
                $supply->nota = $req->nota;
                $supply->suppliers_id = $req->supplier;
                $supply->status = 0;
                $supply->id_pemasok = Auth::id();
                $supply->date = $req->date;
                $supply->save();

                foreach ($req->kode_barang_supply as $no => $kode_barang) {
                    $product_status = Product::where('kode_barang', $kode_barang)
                    ->first();

                    if($product_status->stok == 0){
                        $product_status->keterangan = 'Tersedia';
                        $product_status->save();
                    }
                    
                    $product = Product::where('kode_barang', $kode_barang)
                    ->first();

                    if ($product->hpp != 0) {
                        //hpp
                        $hpp = (($product->stok * $product->hpp) + ($req->jumlah_supply[$no] * $req->harga_beli_supply[$no])) / ($product->stok + $req->jumlah_supply[$no]);
                        $product->hpp = $hpp;
                        $product->save();
                    }

                    $detail = new detail_supplies;
                    $detail->supplies_id = $supply->id;
                    $detail->kode_barang = $kode_barang;
                    $detail->nama_barang = $product->nama_barang;
                    $detail->jumlah = $req->jumlah_supply[$no];
                    $detail->tempat_beli = $req->tempat_beli[$no];
                    $detail->harga_beli = $req->harga_beli_supply[$no];
                    $detail->subtotal = $req->subtotal[$no];
                    $detail->status = 1;
                    $detail->save();
                    $jumlah_data += 1;
                }

                $activity = new Activity;
                $activity->id_user = Auth::id();
                $activity->user = Auth::user()->nama;
                $activity->nama_kegiatan = 'pasok';
                $activity->jumlah = $jumlah_data;
                $activity->save();

                Session::flash('create_success', 'Stok pending barang berhasil ditambah');

                return redirect('/supply');
                }
        }else{
            return back();
        }
    }

    // Import New Supply
    public function importSupply(Request $req)
    {
        $id_account = Auth::id();
        $check_access = Acces::where('user', $id_account)
        ->first();
        $supply_system = Supply_system::first();
        if($check_access->kelola_barang == 1 && $supply_system->status == true){
            try{
                $file = $req->file('excel_file');
                $nama_file = rand().$file->getClientOriginalName();
                $file->move('excel_file', $nama_file);
                $import = new SupplyImport;
                Excel::import($import, public_path('/excel_file/'.$nama_file));

                $array = (new SupplyImport)->toArray(public_path('/excel_file/'.$nama_file));
                $jumlah_data = count($array[0]);

                $activity = new Activity;
                $activity->id_user = Auth::id();
                $activity->user = Auth::user()->nama;
                $activity->nama_kegiatan = 'pasok';
                $activity->jumlah = $jumlah_data;
                $activity->save();

                Session::flash('import_success', 'Data barang berhasil diimport');
            }catch(\Exception $ex){
                Session::flash('import_failed', 'Cek kembali terdapat data kosong, stok barang kosong atau kode barang yang tidak tersedia');

                return back();
            }

            return redirect('/supply');
        }else{
            return back();
        }
    }

    // Export Supply Report
    public function exportSupply(Request $req)
    {
        $id_account = Auth::id();
        $check_access = Acces::where('user', $id_account)
        ->first();
        $supply_system = Supply_system::first();
        if($check_access->kelola_barang == 1 && $supply_system->status == true){
            $jenis_laporan = $req->jns_laporan;
            $current_time = Carbon::now()->isoFormat('Y-MM-DD') . ' 23:59:59';
            if($jenis_laporan == 'period'){
                if($req->period == 'minggu'){
                    $last_time = Carbon::now()->subWeeks($req->time)->isoFormat('Y-MM-DD') . ' 00:00:00';
                    $supplies = Supply::select('supplies.*')
                    ->whereBetween('created_at', array($last_time, $current_time))
                    ->get();
                    $array = array();
                    foreach ($supplies as $no => $supply) {
                        array_push($array, $supplies[$no]->created_at->toDateString());
                    }
                    $dates = array_unique($array);
                    rsort($dates);
                    $tgl_awal = $last_time;
                    $tgl_akhir = $current_time;
                }elseif($req->period == 'bulan'){
                    $last_time = Carbon::now()->subMonths($req->time)->isoFormat('Y-MM-DD') . ' 00:00:00';
                    $supplies = Supply::select('supplies.*')
                    ->whereBetween('created_at', array($last_time, $current_time))
                    ->get();
                    $array = array();
                    foreach ($supplies as $no => $supply) {
                        array_push($array, $supplies[$no]->created_at->toDateString());
                    }
                    $dates = array_unique($array);
                    rsort($dates);
                    $tgl_awal = $last_time;
                    $tgl_akhir = $current_time;
                }elseif($req->period == 'tahun'){
                    $last_time = Carbon::now()->subYears($req->time)->isoFormat('Y-MM-DD') . ' 00:00:00';
                    $supplies = Supply::select('supplies.*')
                    ->whereBetween('created_at', array($last_time, $current_time))
                    ->get();
                    $array = array();
                    foreach ($supplies as $no => $supply) {
                        array_push($array, $supplies[$no]->created_at->toDateString());
                    }
                    $dates = array_unique($array);
                    rsort($dates);
                    $tgl_awal = $last_time;
                    $tgl_akhir = $current_time;
                }
            }else{
                $start_date = $req->tgl_awal_export;
                $end_date = $req->tgl_akhir_export;
                $start_date2 = $start_date[6].$start_date[7].$start_date[8].$start_date[9].'-'.$start_date[3].$start_date[4].'-'.$start_date[0].$start_date[1].' 00:00:00';
                $end_date2 = $end_date[6].$end_date[7].$end_date[8].$end_date[9].'-'.$end_date[3].$end_date[4].'-'.$end_date[0].$end_date[1].' 23:59:59';
                $supplies = Supply::select('supplies.*')
                ->whereBetween('created_at', array($start_date2, $end_date2))
                ->get();
                $array = array();
                foreach ($supplies as $no => $supply) {
                    array_push($array, $supplies[$no]->created_at->toDateString());
                }
                $dates = array_unique($array);
                rsort($dates);
                $tgl_awal = $start_date2;
                $tgl_akhir = $end_date2;
            }
            $market = Market::first();

            $pdf = PDF::loadview('manage_product.supply_product.export_report_supply', compact('dates', 'tgl_awal', 'tgl_akhir', 'market'));
            return $pdf->stream();
        }else{
            return back();
        }
    }

    //po barang baru
    public function newProduct(Request $req)
    {
        $id_account = Auth::id();
        $check_access = Acces::where('user', $id_account)
        ->first();
        if($check_access->kelola_barang == 1){
            $kode = Category::where('id', $req->kategori)->first();
            $lastProduct = Product::latest('id')->first();
            $new = new Product;
            if ($lastProduct) {
                $autoIncrements = substr($lastProduct->kode_barang, -1);
                $newId = (int)$autoIncrements + 1;
                $new->kode_barang = $kode->kode. $newId;
            } else {
                $new->kode_barang = $kode->kode.'1';
            }
            $new->nama_barang = $req->nama_barang;
            $new->category_id = $req->kategori;
            $new->keterangan = "Pre-Order";

            $new->save();
            Session::flash('create_success', 'Barang Pre-Order berhasil ditambahkan');
            return redirect('/supply/new');
        }
    }

    //view detail pasok
    public function detail($id)
    {
        $data = Supply::find($id);
        $suppliers = Supplier::all();
        $items = detail_supplies::where('supplies_id', $id)->get();
        $total = detail_supplies::where('supplies_id', $id)->count();
        $products = Product::all();
        return view('manage_product.supply_product.detail_pasok', compact('data', 'suppliers', 'items', 'products', 'total'));
    }

    //edit pasokan 
    public function edited(Request $req, $id)
    {
        $id_account = Auth::id();
        $check_access = Acces::where('user', $id_account)
        ->first();
        $supply_system = Supply_system::first();
        if($check_access->kelola_barang == 1 && $supply_system->status == true){
            if ($req->has('fullfill')) {
                $update_supply = Supply::where('id', $id)->first();

                $update_supply->nota = $req->nota;
                $update_supply->suppliers_id = $req->supplier;
                $update_supply->status = 1;
                $update_supply->id_pemasok = Auth::id();
                $update_supply->date = $req->date;

                $update_supply->save();

                $index = 0;
                foreach ($req->barang as $key => $kode_barang) {
                    $pasok = Product::where('kode_barang', $kode_barang)->firstOrFail();
                    $detail_item = detail_supplies::where('kode_barang', $kode_barang)->where('supplies_id', $id)->firstOrFail();
                    $pasok->stok = $pasok->stok + $req->jumlah[$key];

                    if ($pasok->hpp != 0 && $detail_item->jumlah != $req->jumlah[$key]) {
                        $hpp = (($pasok->stok * $pasok->hpp) + ($req->jumlah[$key] * $req->beli[$key])) / ($pasok->stok + $req->jumlah[$key]);
                        $pasok->hpp = $hpp;
                    }

                    if ($pasok->hpp != 0) {
                        $laba_rupiah = $pasok->hpp - $pasok->harga;
                        $laba_persen = $laba_rupiah / $pasok->hpp * 100;
    
                        $pasok->laba_rupiah = $laba_rupiah;
                        $pasok->laba_persen = $laba_persen;
                    }
                    $pasok->save();

                    $detail_item->kode_barang = $kode_barang;
                    $detail_item->nama_barang = $pasok->nama_barang;
                    $detail_item->jumlah = $req->jumlah[$key];
                    $detail_item->tempat_beli = $req->tempat_beli[$key];
                    $detail_item->harga_beli = $req->beli[$key];
                    $detail_item->subtotal = $req->beli[$key] * $req->jumlah[$key];
                    $detail_item->status = 1;

                    $detail_item->save();
                    $index += 1;
                }

                Session::flash('create_success', 'Pasokan barang berhasil diupdate');
                return redirect('/supply');

            }
            elseif ($req->has('create')) {

                $update_supply = Supply::where('id', $id)->firstOrFail();

                $update_supply->nota = $req->nota;
                $update_supply->suppliers_id = $req->supplier;
                $update_supply->status = 0;
                $update_supply->id_pemasok = Auth::id();
                $update_supply->date = $req->date;

                $update_supply->save();

                $index = 0;
                foreach ($req->barang as $key => $kode_barang) {
                    $pasok = Product::where('kode_barang', $kode_barang)->firstOrFail();
                    $detail_item = detail_supplies::where('kode_barang', $kode_barang)->where('supplies_id', $id)->firstOrFail();

                    if ($pasok->hpp != 0 && $detail_item->jumlah != $req->jumlah[$key]) {
                        $hpp = (($pasok->stok * $pasok->hpp) + ($req->jumlah[$key] * $req->beli[$key])) / ($pasok->stok + $req->jumlah[$key]);
                        $pasok->hpp = $hpp;
                    }

                    $pasok->save();

                    $detail_item->kode_barang = $kode_barang;
                    $detail_item->nama_barang = $pasok->nama_barang;
                    $detail_item->jumlah = $req->jumlah[$key];
                    $detail_item->tempat_beli = $req->tempat_beli[$key];
                    $detail_item->harga_beli = $req->beli[$key];
                    $detail_item->subtotal = $req->beli[$key] * $req->jumlah[$key];
                    $detail_item->status = 0;

                    $detail_item->save();
                    $index += 1;
                }
                Session::flash('create_success', 'Berhasil edit pasok barang');

                return redirect('/supply');
            }
        }
        else{
            return back();
        }
    }

    //view history pasok
    public function pasok_complate($id)
    {
        $data = Supply::find($id);
        $suppliers = Supplier::all();
        $items = detail_supplies::where('supplies_id', $id)->get();
        $total = detail_supplies::where('supplies_id', $id)->count();
        $products = Product::all();
        return view('manage_product.supply_product.detail_pasok', compact('data', 'suppliers', 'items', 'products', 'total'));
    }
}
