<?php

namespace App\Http\Controllers;

use Auth;
use Session;
use App\Acces;
use App\Supply;
use App\Product;
use App\Category;
use App\Transaction;
use App\TransactionDetail;
use App\Supply_system;
use App\detail_supplies;
use App\Imports\ProductImport;
use App\Exports\ProductExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductManageController extends Controller
{
    // Show View Product
    public function viewProduct()
    {
        $id_account = Auth::id();
        $category = Category::all();
        $check_access = Acces::where('user', $id_account)
        ->first();
        if($check_access->kelola_barang == 1){
        	$products = Product::all()
            ->sortBy('kode_barang');
            $supply_system = Supply_system::first();
            $cari = '';
            $sort = '';
            $data = $products->count();

        	return view('manage_product.product', compact('sort', 'data', 'cari', 'products', 'supply_system', 'category'));
        }else{
            return back();
        }
    }

    // Show View New Product
    public function viewNewProduct()
    {
        $id_account = Auth::id();
        $category = Category::all();
        $check_access = Acces::where('user', $id_account)
        ->first();
        if($check_access->kelola_barang == 1){
            $supply_system = Supply_system::first();

        	return view('manage_product.new_product', compact('supply_system', 'category'));
        }else{
            return back();
        }
    }

    // Filter Product Table
    public function filterTable($id)
    {
        $id_account = Auth::id();
        $check_access = Acces::where('user', $id_account)
        ->first();
        $category = Category::all();
        if($check_access->kelola_barang == 1){
            $supply_system = Supply_system::first();
            $cari = '';
            $sort = $id;
            if ($id == 'harga_jual') {
                $products = [];
                $items = Product::all();
                foreach ($items as $item) {
                    $count = (int)$item->hpp + (int)$item->laba_rupiah;
                    if ($item->harga != $count) {
                        $products[] = $item;
                    }
                }
                $data = count($products);
            }
            else{
                $products = Product::orderBy($id, 'asc')->get();
                $data = $products->count();
            }

            return view('manage_product.product', compact('sort', 'data', 'cari', 'products', 'supply_system', 'category'));
            
        }else{
            return back();
        }
    }

    // Create New Product
    public function createProduct(Request $req)
    {
        $id_account = Auth::id();
        $check_access = Acces::where('user', $id_account)
        ->first();
        if($check_access->kelola_barang == 1){
        	$check_product = Product::where('kode_barang', $req->kode_barang)
        	->count();
<<<<<<< HEAD
            $kode = Category::where('id', $req->kategori)->first();
            $lastId = Product::latest('id')->count();
=======
>>>>>>> 8b89de85d390654f3b223af49246284a8672e46b
            $supply_system = Supply_system::first();

        	if($check_product == 0)
        	{
        		$product = new Product;
<<<<<<< HEAD
                if ($lastId) {
                    $newId = (int)$lastId + 1;
                    $product->kode_barang = $kode->kode. $newId;
                } else {
                    $product->kode_barang = $kode->kode.'1';
                }
                
=======
    	    	$product->kode_barang = $req->kode_barang;
>>>>>>> 8b89de85d390654f3b223af49246284a8672e46b
    	    	$product->category_id = $req->kategori;
    	    	$product->nama_barang = $req->nama_barang;
    	    	if($req->berat_barang != '')
    	    	{
    	    		$product->berat_barang = $req->berat_barang . ' ' . $req->satuan_berat;
    	    	}
    	    	if($req->merek != '')
    	    	{
    	    		$product->merek = $req->merek;
    	    	}
                if($supply_system->status == true){
                    $product->stok = $req->stok;
                }else{
                    $product->stok = 1;
                }
                $harga = preg_replace("/[^a-zA-Z0-9]/", "", $req->harga);
    	    	$product->harga = $harga;
                $hpp = preg_replace("/[^a-zA-Z0-9]/", "", $req->hpp);
                /*
                 HPP:
                 STOK AWAL  * HPP + Pasok Barang / total barang

                */
                $product->hpp = $hpp;
                $product->laba_rupiah = trim($req->laba_rupiah) != "" ? preg_replace("/[^a-zA-Z0-9]/", "", $req->laba_rupiah) : 0;
                $product->laba_persen = $product->laba_rupiah / $hpp * 100;
    	    	$product->save();

    	    	Session::flash('create_success', 'Barang baru berhasil ditambahkan');

    		    return redirect('/product');
        	}else{
        		Session::flash('create_failed', 'Kode barang telah digunakan');

    		    return back();
        	}
    	}else{
            return back();
        }
    }

    // Import New Product
    public function importProduct(Request $req)
    {
        $id_account = Auth::id();
        $check_access = Acces::where('user', $id_account)
        ->first();
        if($check_access->kelola_barang == 1){
        	try{
        		$file = $req->file('excel_file');
    			$nama_file = rand().$file->getClientOriginalName();
    			$file->move('excel_file', $nama_file);
    			Excel::import(new ProductImport, public_path('/excel_file/'.$nama_file));

    			Session::flash('import_success', 'Data barang berhasil diimport');
        	}catch(\Exception $ex){
        		Session::flash('import_failed', 'Cek kembali terdapat data kosong atau kode barang yang telah tersedia');

        		return back();
        	}

        	return redirect('/product');
        }else{
            return back();
        }
    }

    // Export Product
    public function exportProduct(Request $req){
        $cari = $req->cari;
        $sort = $req->sort;
        

        if ($sort == 'harga_jual') {
            $title = 'fillter ('.$sort.')';
            $products = [];
            $items = Product::select('kode_barang','category_id','nama_barang','berat_barang','merek','laba_rupiah','laba_persen','stok','harga','hpp','keterangan','created_at','updated_at')->orderBy('kode_barang')->get();
            foreach ($items as $item) {
                $count = (int)$item->hpp + (int)$item->laba_rupiah;
                if ($item->harga != $count) {
                    $products[] = $item;
                }
            }
        }
        else{
            $products = [];
            if ($cari) {
                $title = 'fillter ('.$cari.')';
                $items = Product::query()->where('kode_barang', $cari)
                                        ->orWhere('nama_barang', $cari)
                                        ->orWhere('merek', $cari)
                                        ->orWhere('stok', $cari)
                                        ->select('kode_barang','category_id','nama_barang','berat_barang','merek','laba_rupiah','laba_persen','stok','harga','hpp','keterangan','created_at','updated_at')
                                        ->orderBy('kode_barang')->get();
                foreach ($items as $item) {
                    $products[] = $item;
                }
            }
            elseif ($sort) {
                $title = 'fillter ('.$sort.')';
                $items = Product::select('kode_barang','category_id','nama_barang','berat_barang','merek','laba_rupiah','laba_persen','stok','harga','hpp','keterangan','created_at','updated_at')->orderBy($sort, 'asc')->get();
                foreach ($items as $item) {
                    $products[] = $item;
                }
            }
            else {
                $title = 'all';
                $items = Product::select('kode_barang','category_id','nama_barang','berat_barang','merek','laba_rupiah','laba_persen','stok','harga','hpp','keterangan','created_at','updated_at')->orderBy('kode_barang')->get();
                foreach ($items as $item) {
                    $products[] = $item;
                }
            }
        }
        
        return Excel::download(new ProductExport($products), 'product '.$title.'.xlsx');
    }

    //Cari Barang
    public function search(Request $req)
    {
        $id_account = Auth::id();
        $category = Category::all();
        $check_access = Acces::where('user', $id_account)
        ->first();
        if($check_access->kelola_barang == 1){
            $cari = $req->cari;
            $products = Product::query()
                        ->where('kode_barang', 'like',"%".$cari."%")
                        ->orWhere('nama_barang', 'like',"%".$cari."%")
                        ->orWhere('merek', 'like', "%".$cari."%")
                        ->orWhere('stok', 'like', "%".$cari."%")
                        ->get();
            $data = $products->count();
            $supply_system = Supply_system::first();
            $sort = '';

        	return view('manage_product.product', compact('sort', 'data' ,'cari', 'products', 'supply_system', 'category'));
        }
        else{
            return back();
        }
    }

    // Edit Product
    public function editProduct($id)
    {
        $id_account = Auth::id();
        $check_access = Acces::where('user', $id_account)
        ->first();
        if($check_access->kelola_barang == 1){
            $product = Product::find($id);

            return response()->json(['product' => $product]);
        }else{
            return back();
        }
    }

    // Update Product
    public function updateProduct(Request $req)
    {
        $id_account = Auth::id();
        $check_access = Acces::where('user', $id_account)
        ->first();
        if($check_access->kelola_barang == 1){
<<<<<<< HEAD
            $product_data = Product::find($req->id);
            $kode = Category::where('id', $req->kategori)->first();
            $lastId = Product::latest('id')->count();
            
            $product = Product::find($req->id);
            $kode_barang = $product->kode_barang;
            $product->kode_barang = $kode->kode.$req->id;
            $product->category_id = $req->kategori;
            $product->nama_barang = $req->nama_barang;
            $product->berat_barang = $req->berat_barang . ' ' . $req->satuan_berat;
            $product->merek = $req->merek;
            $product->stok = $req->stok;
            $harga = preg_replace("/[^a-zA-Z0-9]/", "", $req->harga);
            $product->harga = $harga;
            $hpp = preg_replace("/[^a-zA-Z0-9]/", "", $req->hpp);
            $product->hpp = $hpp;
            $product->laba_rupiah = trim($req->laba_rupiah) != "" ? preg_replace("/[^a-zA-Z0-9]/", "", $req->laba_rupiah) : 0;
            $product->laba_persen = $product->laba_rupiah / $hpp * 100;
            if($req->stok <= 0)
            {
                $product->keterangan = "Habis";
            }else{
                $product->keterangan = "Tersedia";
            }
            $product->save();

            detail_supplies::where('kode_barang', $kode_barang)
            ->update(['kode_barang' => $product->kode_barang]);
            TransactionDetail::where('kode_barang', $kode_barang)
            ->update(['kode_barang' => $product->kode_barang]);

            Session::flash('update_success', 'Data barang berhasil diubah');

            return redirect('/product');
=======
            $check_product = Product::where('kode_barang', $req->kode_barang)
            ->count();
            $product_data = Product::find($req->id);
            if($check_product == 0 || $product_data->kode_barang == $req->kode_barang)
            {
                $product = Product::find($req->id);
                $kode_barang = $product->kode_barang;
                $product->kode_barang = $req->kode_barang;
                $product->category_id = $req->kategori;
                $product->nama_barang = $req->nama_barang;
                $product->berat_barang = $req->berat_barang . ' ' . $req->satuan_berat;
                $product->merek = $req->merek;
                $product->stok = $req->stok;
                $harga = preg_replace("/[^a-zA-Z0-9]/", "", $req->harga);
    	    	$product->harga = $harga;
                $hpp = preg_replace("/[^a-zA-Z0-9]/", "", $req->hpp);
                $product->hpp = $hpp;
                $product->laba_rupiah = trim($req->laba_rupiah) != "" ? preg_replace("/[^a-zA-Z0-9]/", "", $req->laba_rupiah) : 0;
                $product->laba_persen = $product->laba_rupiah / $hpp * 100;
                if($req->stok <= 0)
                {
                    $product->keterangan = "Habis";
                }else{
                    $product->keterangan = "Tersedia";
                }
                $product->save();

                detail_supplies::where('kode_barang', $kode_barang)
                ->update(['kode_barang' => $req->kode_barang]);
                TransactionDetail::where('kode_barang', $kode_barang)
                ->update(['kode_barang' => $req->kode_barang]);

                Session::flash('update_success', 'Data barang berhasil diubah');

                return redirect('/product');
            }else{
                Session::flash('update_failed', 'Kode barang telah digunakan');

                return back();
            }
>>>>>>> 8b89de85d390654f3b223af49246284a8672e46b
        }else{
            return back();
        }
    }


    // Delete Product
    public function deleteProduct($id)
    {
        $id_account = Auth::id();
        $check_access = Acces::where('user', $id_account)
        ->first();
        if($check_access->kelola_barang == 1){
            Product::destroy($id);

            Session::flash('delete_success', 'Barang berhasil dihapus');

            return back();
        }else{
            return back();
        }
    }
}
