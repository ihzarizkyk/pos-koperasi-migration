<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Supplier;

class SuplierController extends Controller
{
    public function index()
    {
        $data=DB::table("suppliers")->get();
        return view("manage_product.supply_product.supplier.index", ['suplier' => $data]);
    }

    public function edit($id)
    {
        $data = DB::table("suppliers")->where("id",$id)->get();
        return view("manage_product.supply_product.supplier.edit",compact("data"));
    }

    public function create()
    {
        return view("manage_product.supply_product.supplier.create");
    }

    public function update(Request $request)
    {
        $request->validate([
            "nama" => "required",
            "alamat" => "required",
            "telepon" => "required",
            "email" => "required",
            "asal" => "required",
            "perusahaan" => "required"
        ]);

        DB::table("suppliers")->where("id",$request->id)->update([
            "nama" => $request->nama,
            "alamat" => $request->alamat,
            "telepon" => $request->telepon,
            "email" => $request->email,
            "asal" => $request->asal,
            "perusahaan" => $request->perusahaan,          
        ]);

        return redirect()->route("supplier");
    }

    public function store(Request $request)
    {
        $request->validate([
            "nama" => "required",
            "alamat" => "required",
            "telepon" => "required",
            "email" => "required",
            "asal" => "required",
            "perusahaan" => "required"
        ]);

        $data = new Supplier;
        $data->nama = $request->nama;
        $data->alamat = $request->alamat;
        $data->telepon = $request->telepon;
        $data->email = $request->email; 
        $data->asal = $request->asal;
        $data->perusahaan = $request->perusahaan;        
        $data->save();

        return redirect()->route("supplier");
    }

    public function delete($id)
    {
        $data = Suplier::find($id);
        $data->delete();
        
        return redirect()->back();
    }
}
