<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Models\Brands;

class BrandsController extends Controller
{
    public function index()
    {
        $brands=Brands::paginate(10);
        return response()->json($brands,200);
    }

    public function show($id)
    {
        $brand=Brands::find($id);
        if($brand){
            return response()->json($brand,200);
        }else return response()->json('brand not found');
    }

    public function store(Request $request)
    {
        try{
            $validated = $request->validate([
                'name' => 'required|unique:brands,name'
            ]);
            $brand= new Brands();
            $brand->name=$request->name;
            $brand->save();
            return response()->json('brand added',201);
        }catch(Exception $e){
            return response()->json($e,500);
        }
    }

    public function update_brand($id,Request $request)
    {
        try{
            $validated = $request->validated([
                'name' => 'required'
            ]);
            Brands::where('id',$id)->update(['name'=>$request->name]);
            return response()->json('brand update',200);
        }catch(Exception $e){
            return response()->json($e,500);
        }
    }

    public function delete_brand($id)
    {

            $brand=Brands::find($id);
            if($brand){
                $brand->deleted();
                return response()->json('brand deleted'); 
            }else return response()->json('brand not found');
    }
}