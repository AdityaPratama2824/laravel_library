<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\User;    
use App\Models\Borrow;

class BorrowController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::all();
        $users = User::whereHas('role', function($query){
            $query->where("role_name", "=", "member");
        })->get();
        return view("borrow.index", compact('books', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $request->validate([
            'book_id' => 'required|exists:books,id',
            'user_id' => 'required|unique:users,id',
            'qty' => 'required|digits_between:1,2',
            'start_borrow' => 'required|date',
            'end_borrow' => 'required|date'
        ]);

        Borrow::create([
            'book_id' => $request->book_id,
            'user_id' => $request->user_id,
            'qty' => $request->qty,
            'start_borrow' => $request->start_borrow,
            'end_borrow' => $request->end_borrow,
            'fine' => 0,
        ]);

        return redirect("/admin/borrow")->with("success", "borrow data has been created!");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
