<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
<<<<<<< HEAD
use App\Product;
use App\detail_supplies;
use App\TransactionDetail;
=======
>>>>>>> 8b89de85d390654f3b223af49246284a8672e46b
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

<<<<<<< HEAD
        $data = new Category;
        $data->name = $request->name;
        $kode = substr($request->name, 0, 3);
        $data->kode = strtoupper($kode)."-".rand(1000,9999);
=======
        $data=new category;
        $data->name = $request->name;
>>>>>>> 8b89de85d390654f3b223af49246284a8672e46b
        $data->save();

        return redirect("/category");
    }
    
    public function edit($id)
    {
<<<<<<< HEAD
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
=======
        $data=DB::table("categories")->where("id",$id)->get();
        return view("manage_product.category.edit",["category" => $data]);
    }
    
    public function update(Request $request)
    {
        $request->validate([
            "name"=>"required"
        ]);

        DB::table("categories")->where("id",$request->id)->update([
            "name"=>$request->name
        ]);
>>>>>>> 8b89de85d390654f3b223af49246284a8672e46b

        return redirect("/category");
    }

    public function destroy($id)
    {
<<<<<<< HEAD
        $data = Category::find($id);
=======
        $data= Category::find($id);
>>>>>>> 8b89de85d390654f3b223af49246284a8672e46b
        $data->delete();
        
        return redirect()->back();
    }
}
