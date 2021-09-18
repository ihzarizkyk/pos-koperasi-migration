<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Product;
use App\detail_supplies;
use App\TransactionDetail;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function index()
    {
        $data = Category::all();
        return view("manage_product.category.index",["category" => $data]);
    }

    public function create()
    {
        return view("manage_product.category.create");
    }
    

    public function store(Request $request)
    {
        $request->validate([
            "name" => "required"
        ]);

        $data = new Category;
        $data->name = $request->name;
        $kode = substr($request->name, 0, 3);
        $data->kode = strtoupper($kode)."-".rand(1000,9999);
        $data->save();

        return redirect("/category");
    }
    
    public function edit($id)
    {
        $data = Category::find($id);
        return view("manage_product.category.edit", compact('data'));
    }
    
    public function update(Request $request, $id)
    {
        $update = Category::where("id", $id)->first();

        $oldCode = $update->kode;
        $update->name = $request->nama;
        $kode = substr($request->nama, 0, 3);
        $update->kode = strtoupper($kode)."-".rand(1000,9999);

        $update->save();

        $product = Product::where('kode_barang', 'like', "%".$oldCode."%")->get();
        foreach ($product as $value) {
            $last = substr($value->kode_barang, -1);
            Product::where('kode_barang', $value->kode_barang)
            ->update(['kode_barang' => $update->kode.$last]);
        }

        $supply = detail_supplies::where('kode_barang', 'like', "%".$oldCode."%")->get();
        foreach ($supply as $item) {
            $last = substr($item->kode_barang, -1);
            detail_supplies::where('kode_barang', $item->kode_barang)
            ->update(['kode_barang' => $update->kode.$last]);
        }

        $transaction = TransactionDetail::where('kode_barang', 'like', "%".$oldCode."%")->get();
        foreach ($transaction as $val) {
            $last = substr($val->kode_barang, -1);
            TransactionDetail::where('kode_barang', $val->kode_barang)
            ->update(['kode_barang' => $update->kode.$last]);
        }

        return redirect("/category");
    }

    public function destroy($id)
    {
        $data = Category::find($id);
        $data->delete();
        
        return redirect()->back();
    }
}
