<?php

namespace App\Http\Controllers;
use Exception;

use Illuminate\Http\Request;
use App\Models\Categories;
use Faker\Core\File;

class CategoryController extends Controller
{
    public function index()
    {
        $category=Categories::paginate(10);
        return response()->json($category,200);
    }

    public function show($id)
    {
        $category=Categories::find($id);
        if($category){
            return response()->json($category,200);
        }else return response()->json('category not found');
    }

    public function store(Request $request)
    {
        try{
            $validated = $request->validate([
                'name' => 'required|unique:category,name'
            ]);
            $category= new Categories();
            $category->name=$request->name;
            $category->save();
            return response()->json('category added',201);
        }catch(Exception $e){
            return response()->json($e,500);
        }
    }

    public function update($id,Request $request)
    {
        try{
            $validated = $request->validated([
                'name' => 'required|unique:brands,name',
                'image' => 'required'
            ]);
            Categories::where('id',$id)->update(['name'=>$request->name]);
            return response()->json('category update',200);
        }catch(Exception $e){
            return response()->json($e,500);
        }
    }

    public function delete($id)
    {

            $category=Categories::find($id);
            if($category){
                $category->deleted();
                return response()->json('category deleted');
            }else return response()->json('category not found');
    }
}