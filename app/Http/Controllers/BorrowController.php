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
        $borrows = Borrow::join('books', 'borrows.book_id', '=', 'books.id')
        ->join('users', 'borrows.user_id', '=', 'users.id')
        ->select('borrows.*', 'books.title', 'users.name')->get();
        $books = Book::all();
        $users = User::whereHas('roles', function($query){
            $query->where("role_name", "=", "member");
        })->get();
        return view("borrow.index", compact('books', 'users', 'borrows'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $request->validate([
            'book_id' => 'required|exists:books,id',
          'user_id' => 'required|unique:borrows,user_id,NULL,id,return_borrow,NULL',
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
         $books = Book::all();
        $borrow = Borrow::find($id);
        $users = User::whereHas('roles', function($query){
            $query->where("role_name", "=", "member");
        })->get();

        return view("borrow.edit", compact('books', 'users', 'borrow'));
    }

    /**
     * Update the specified resource in storage.
     */
public function update(Request $request, string $id)
{
    $request->validate([
        'book_id' => 'required|exists:books,id',
        'user_id' => 'required|exists:users,id',
        'qty' => 'required|digits_between:1,2',
        'start_borrow' => 'required|date',
    ]);

    $borrow = Borrow::findOrFail($id);
    $borrow->book_id = $request->book_id;
    $borrow->user_id = $request->user_id;
    $borrow->start_borrow = $request->start_borrow;
    $borrow->qty = $request->qty;
    $start = new \DateTime($request->start_borrow);
    $start->modify('+3 days');
    $borrow->end_borrow = $start->format('Y-m-d');

    $borrow->save();

    return redirect("/admin/borrow")->with("success", "Borrow has been updated!");
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
               $borrow = Borrow::findOrFail($id);
        $borrow->delete();
        return redirect("/admin/borrow")->with("success", "Borrow has been deleted!");
    }
}
