<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;
use App\KonsumenKategori;
use App\Logs;
use App\Konsumen;

class KonsumenKategoriController extends Controller
{
    public function index()
    {
        $kategori = KonsumenKategori::all();
        return view('konsumen_kategori.index', ['jquery' => "konsumen_kategori.jquery", "kategori" => $kategori]);
    }

    public function create()
    {
        return view('konsumen_kategori.create', ["jquery" => "konsumen_kategori.jquery"]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama'  => 'required|string|max:255|unique:konsumen_kategori',
            'diskon'=> 'required|integer|max:100|min:0'
        ]);

        if($validator->fails())
        {
            return response()->json($validator->errors(), 400);
        }

        $kategori = new KonsumenKategori;
        $kategori->nama = $request->nama;
        $kategori->diskon = $request->diskon;
        $kategori->save();

        $logs = new Logs;
        $logs->user_id = Auth::id();
        $logs->desc = "User ".Auth::user()->name." Tambah Kategori Konsumen ".$request->nama." | ".$request->diskon;
        $logs->save();

        return response()->json("OK", 200);
    }

    public function show(Request $request)
    {
        $kategori = KonsumenKategori::find($request->id);

        return response()->json($kategori);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'diskon'=> 'required|integer|max:100|min:0'
        ]);

        if($validator->fails())
        {
            return response()->json($validator->errors(), 400);
        }

        $kategori = KonsumenKategori::find($request->id);
        $kategori->nama = $request->nama;
        $kategori->diskon = $request->diskon;
        $kategori->save();

        $logs = new Logs;
        $logs->user_id = Auth::id();
        $logs->desc = "User ".Auth::user()->name." Ubah Kategori Konsumen $request->id | ".$request->nama." | ".$request->diskon;
        $logs->save();

        return response()->json("OK", 200);
    }

    public function destroy(Request $request)
    {
        $count = Konsumen::where("konsumen_kategori_id", $request->id)->count();
        if($count > 0)
        {
            return response()->json("Kategori Sudah Digunakan Tidak Bisa Hapus", 200);
        }

        $kategori = KonsumenKategori::find($request->id);
        $logs = new Logs;
        $logs->user_id = Auth::id();
        $logs->desc = "User ".Auth::user()->name." Hapus Kategori Konsumen $request->id | ".$kategori->nama." | ".$request->diskon;
        $logs->save();
        $kategori->delete();

        return response()->json("OK", 200);
    }
}
