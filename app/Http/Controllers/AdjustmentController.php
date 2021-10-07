<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Adjustment;
use App\Product;

class AdjustmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dates = now();
        return view("manage_product.adjustment.index",["dates" => $dates]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view("manage_product.adjustment.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {

    $adjust = new Adjustment;
    $adjust->in_stock = $req->in_stock;
    $adjust->actual_stock = $req->actual_stock;
    $adjust->note = $req->note;
    // $supply->date = $req->date;
    $adjust->save();

    foreach($req->kode_barang as $no => $kode_barang) {
        $product = Product::where('kode_barang', $kode_barang)->first();

        if($product->stok == 0){
        $product->nama_barang = $req->nama_barang[$no];
        $product->save();
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Adjustment::find($id);
        $products = Product::all();
        return view('manage_product.adjustment.detail', compact('data','products'));
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
