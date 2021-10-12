<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Adjustment;
use App\AdjustmentDetail;
use App\Product;
use DB;
use Session;
use Str;
use Carbon\Carbon;
use Exception;

class AdjustmentController extends Controller
{
    private function getRomawi($bln){
        switch ($bln){
            case 1: 
                return "I";
                break;
            case 2:
                return "II";
                break;
            case 3:
                return "III";
                break;
            case 4:
                return "IV";
                break;
            case 5:
                return "V";
                break;
            case 6:
                return "VI";
                break;
            case 7:
                return "VII";
                break;
            case 8:
                return "VIII";
                break;
            case 9:
                return "IX";
                break;
            case 10:
                return "X";
                break;
            case 11:
                return "XI";
                break;
            case 12:
                return "XII";
                break;
        }
    }

    public function index()
    {
        $dates = now();
        $start = isset($_GET['start']) ? new Carbon($_GET['start']) : Carbon::today()->subDay(29);
        $end = isset($_GET['end']) ? new Carbon($_GET['end']) : Carbon::today();
        if($start->diffInDays($end) > 90){
            $end = new Carbon($start);
            $end->addDay(90);
        }
        $end->addDay(1);
        $adjustment = Adjustment::whereBetween('adjustments.created_at', [$start, $end])->paginate(1);
        $total_nominal_adjustment = Adjustment::whereBetween('adjustments.created_at', [$start, $end])->totalNominal()->first()->append('total');
        $end = $end->subDay(1);
        $adjustment = $adjustment->withQueryString();
        return view("manage_product.adjustment.index", compact('dates', 'adjustment', 'total_nominal_adjustment', 'start', 'end'));
    }
    public function create()
    {
        return view("manage_product.adjustment.create");
    }

    public function ProductSearch(Request $req)
    {
        // $id_account = Auth::id();
        // // $category = Category::all();
        // $check_access = Acces::where('user', $id_account)
        // ->first();
        // if($check_access->transaksi == 1){
            $cari = $req->cari;
            $products = Product::productSearch($cari)->get();
            $data = $products->count();

        	return response()->json([
        		'product' => $products,
        		// 'status' => $status
        	]);
        // }else{
        //     return back();
        // }
    }

    public function store()
    {
        // echo json_encode($_POST);
        DB::beginTransaction();
        try{
            $last_adj = Adjustment::lastIdAdjustment()->id_adjustment;
            if($last_adj == null){
                $last_adj = 1;
            }else{
                $last_adj+=1;
            }
            $id_adjustment = "ADJ.".str_pad($last_adj,3,'0', STR_PAD_LEFT)."/".mt_rand(1000,9999)."/".$this->getRomawi(date('m'))."/".date('Y');
            $adjust = new Adjustment;
            $adjust->id_adjustment = $id_adjustment;
            $adjust->save();
            $kode_barang = $_POST['kode_barang_array'];
            $in_stock = $_POST['in_stock_array'];
            $actual_stock = $_POST['actual_stock_array'];
            for($i=0; $i < count($kode_barang); $i++){
                if($in_stock[$i]==$actual_stock[$i]){
                    throw new \ErrorException('Error found');
                }
                $adjust_detail = new AdjustmentDetail;
                $adjust_detail->adjustment_id = $id_adjustment;
                $adjust_detail->kode_barang = $kode_barang[$i];
                $adjust_detail->in_stock = $in_stock[$i];
                $adjust_detail->actual_stock = $actual_stock[$i];
                $adjust_detail->save();
                $product = Product::where('kode_barang', $kode_barang[$i])->first();
                $product->stok = $actual_stock[$i];
                $product->save();
            }
            Product::stockChanging($kode_barang);
            DB::commit();
            Session::flash('create_success', 'Adjusment baru berhasil ditambahkan');
            return redirect('/adjustment');

        }catch(Exception $exception){
            DB::rollback();
            Session::flash('create_failed', 'Adjusment baru gagal ditambahkan');
            return redirect('/adjustment/create');
        }

    }
    public function show($id)
    {
        $adjustment = Adjustment::with(['adjustment_details', 'adjustment_details.product'])->find($id);
        return view('manage_product.adjustment.detail', compact('adjustment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
