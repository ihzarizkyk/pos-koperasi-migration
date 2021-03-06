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
use App\Http\Traits\AdjustmentTrait;

class AdjustmentController extends Controller
{
    use AdjustmentTrait;

    public function index()
    {
        $dates = Carbon::now();
        $start = isset($_GET['start']) ? new Carbon($_GET['start']) : Carbon::now()->startOfYear();
        $end = isset($_GET['end']) ? new Carbon($_GET['end']) : Carbon::now()->endOfYear();
        if($start->diffInYears($end) > 1){
            $end = new Carbon($start);
            $end->addYear();
        }
        $start = $start->toDateString();
        $end = $end->toDateString();
        $data = Adjustment::whereBetween(DB::raw('DATE_FORMAT(adjustments.created_at, "%Y-%m-%d")'), [$start, $end]);
        $adjustment = $data->paginate(7);
        $jumlah_adjustment = $data->count();
        $total_nominal_adjustment = Adjustment::whereBetween(DB::raw('DATE_FORMAT(adjustments.created_at, "%Y-%m-%d")'), [$start, $end])->totalNominal()->first()->append('total');
        $adjustment = $adjustment->withQueryString();
        return view("manage_product.adjustment.index", compact('dates', 'adjustment', 'jumlah_adjustment', 'total_nominal_adjustment', 'start', 'end'));
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
        $kode_barang = $_POST['kode_barang_array'];
        $in_stock = $_POST['in_stock_array'];
        $actual_stock = $_POST['actual_stock_array'];
        $note = $_POST['note_array'];
        if ($this->addAdjustment($kode_barang, $in_stock, $actual_stock, $note)) {
            Session::flash('create_success', 'Adjusment baru berhasil ditambahkan');
            return redirect('/adjustment');
        } else {
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
