<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Book;

use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        $books = Book::join('categories', function($join){
            return $join->on("categories.id", "=", "books.category_id");
        })
        ->select(
            "books.id as id",
            "books.title",
            "books.author",
            "books.qty",
            "books.year",
            "categories.category_name"
        )
        ->get();


        return view('book.index', compact('categories', 'books'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|unique:books,title',
            'author' => 'required',
            'qty' => 'required|digits_between:1,2',
            'year' => 'required|digits:4'
        ]);

        Book::create([
            'category_id' => $request->category_id,
            'title' => $request->title,
            'author' => $request->author,
            'qty' => $request->qty,
            'year' => $request->year
        ]);

        return redirect("/admin/book")->with("success", "book has been added!");

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $categories = Category::all();
        $book = Book::findOrFail($id);
        return view("book.edit", compact('categories', 'book'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|unique:books,title',
            'author' => 'required',
            'qty' => 'required|digits_between:1,2',
            'year' => 'required|digits:4'
        ]);

        $data = Book::find($id);
        $data->category_id = $request->category_id;
        $data->title = $request->title;
        $data->author = $request->author;
        $data->qty = $request->qty;
        $data->year = $request->year;
        $data->save();

        return redirect("/admin/book")->with("success", "book has been updated!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         $book = Book::findOrFail($id);
         $book->delete();
        return redirect("/admin/book")->with("success", "book has been deleted!");
    }
}
