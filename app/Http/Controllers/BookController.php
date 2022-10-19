<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $book = Book::all();

        return response()->json([
            "message"=>"load data success",
            "data"=> $book
        ],200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $message = [
            "title" => "Masukan Judul",
            "description" => "Masukan Judul",
            "author" => "Masukan Judul",
            "publisher" => "Masukan Judul",
            "date_of_issue" => "Masukan Judul"
        ];
        $validasi = Validator::make($request->all(),[
            "title" => "required",
            "description" => "required",
            "author" => "required",
            "publisher" => "required",
            "date_of_issue" => "required"
        ], $message);
        if ($validasi ->fails()) {
            return $validasi -> errors();
        }
        $book1 = Book::create($validasi->validate());
        $book1->save();

        return response()->json([
            "message"=>"load data success",
            "data"=> $book1
        ],201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $books = Book::find($id);
        if($books){
            return $books;
        }else{
            return ["message" => "Data tidak ditemukan"];
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $book2 = Book::findOrFail($id);
        $book2->update($request->all());
        $book2->save();

        return $book2;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delbook = Book::find($id);
        if($delbook){
            $delbook->delete();
            return ["message" => "Delete Berhasil"];
        }else{
            return ["message" => "Delete tidak ditemukan"];
        }
    }
}
