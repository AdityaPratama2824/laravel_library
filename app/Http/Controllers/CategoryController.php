<?php

namespace App\Http\Controllers;
use App\Models\Category;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datas = Category::all();
        return view('categories.index', compact('datas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required|unique:categories,category_name'
        ],[
            'category_name.required' => "Category is required boss!!",
            'category_name.unique' => "Category has already on database my bos!!",
        ]);

        Category::create([
            'category_name' => $request->category_name
        ]);

        return redirect("/admin/category")->with("success", "category has been added!");
    }

     public function show($id)
    {
        $data = Category::find($id);

        return view("categories.edit", compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'category_name' => 'required|unique:categories,category_name'
        ],[
            'category_name.required' => "Category is required boss!!",
            'category_name.unique' => "Category has already on database my bos!!",
        ]);

        $data = Category::find($id);
        $data->category_name = $request->category_name;
        $data->save();

        return redirect("/admin/category")->with("success", "category has been updated!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Category::find($id);
        $data->delete();
        return redirect("/admin/category")->with("success", "category has been deleted!");
    }
}
