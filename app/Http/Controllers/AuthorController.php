<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $autor = Author::all();

        return response()->json([
            "message"=>" data success",
            "data"=> $autor
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
            "nama" => "Masukan nama",
            "email" => "Masukan email",
            "gender" => "Masukan gender",
            "no_hp" => "Masukan No Hp",
            "tanggal_lahir" => "Masukan Tanggal Lahir",
            "tempat_lahir" => "Masukan Tempat lahir"
        ];
        $validasi = Validator::make($request->all(),[
            "nama" => "required",
            "email" => "required",
            "gender" => "required",
            "no_hp" => "required",
            "tanggal_lahir" => "required",
            "tempat_lahir" => "required"
        ], $message);
        if ($validasi ->fails()) {
            return $validasi -> errors();
        }
        $author1 = Author::create($validasi->validate());
        $author1->save();

        return response()->json([
            "message"=>"data success",
            "data"=> $author1
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
        $author = Author::find($id);
        if($author){
            return $author;
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
        $book2 = Author::findOrFail($id);
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
        $delbook = Author::find($id);
        if($delbook){
            $delbook->delete();
            return ["message" => "Delete Berhasil"];
        }else{
            return ["message" => "Delete tidak ditemukan"];
        }
    }
}
