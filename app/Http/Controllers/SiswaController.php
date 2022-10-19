<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $siswa = Siswa::all();
        return $siswa;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
            "gender" => "Masukan gender",
            "age" => "Masukan age",
        ];
        $validasi = Validator::make($request->all(), [
            "nama" => "required",
            "gender" => "required",
            "age" => "required",
        ], $message);

        if ($validasi->fails()) {
            return $validasi->errors();
        }
        $siswa1 = Siswa::create($request->all());
        $siswa1->save();

        return $siswa1;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $usiswa = Siswa::findOrFail($id);
        $usiswa->update($request->all());
        $usiswa->save();

        return $usiswa;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delsiswa = Siswa::findOrFail($id);
        $delsiswa->delete();

        return $delsiswa;
    }
}
