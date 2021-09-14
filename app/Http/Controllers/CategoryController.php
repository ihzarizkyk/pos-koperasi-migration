<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
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

        $data=new category;
        $data->name = $request->name;
        $data->save();

        return redirect("/category");
    }
    
    public function edit($id)
    {
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

        return redirect("/category");
    }

    public function destroy($id)
    {
        $data= Category::find($id);
        $data->delete();
        
        return redirect()->back();
    }
}
