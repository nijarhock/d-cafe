<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;
use App\MenuKategori;
use App\Logs;
use App\Menu;

class MenuKategoriController extends Controller
{
    public function index()
    {
        $kategori = MenuKategori::all();
        return view('menu_kategori.index', ['jquery' => "menu_kategori.jquery", "kategori" => $kategori]);
    }

    public function create()
    {
        return view('menu_kategori.create', ["jquery" => "menu_kategori.jquery"]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255|unique:menu_kategori'
        ]);

        if($validator->fails())
        {
            return response()->json($validator->errors(), 400);
        }

        $kategori = new MenuKategori;
        $kategori->nama = $request->nama;
        $kategori->save();

        $logs = new Logs;
        $logs->user_id = Auth::id();
        $logs->desc = "User ".Auth::user()->name." Tambah Kategori Menu ".$request->nama;
        $logs->save();

        return response()->json("OK", 200);
    }

    public function show(Request $request)
    {
        $kategori = MenuKategori::find($request->id);

        return response()->json($kategori);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255'
        ]);

        if($validator->fails())
        {
            return response()->json($validator->errors(), 400);
        }

        $kategori = MenuKategori::find($request->id);
        $kategori->nama = $request->nama;
        $kategori->save();

        $logs = new Logs;
        $logs->user_id = Auth::id();
        $logs->desc = "User ".Auth::user()->name." Ubah Kategori Menu $request->id | ".$request->nama;
        $logs->save();

        return response()->json("OK", 200);
    }

    public function destroy(Request $request)
    {
        $count = Menu::where("menu_kategori_id", $request->id)->count();
        if($count > 0)
        {
            return response()->json("Kategori Menu Sudah Digunakan Tidak Bisa Hapus", 200);
        }

        $kategori = MenuKategori::find($request->id);
        $logs = new Logs;
        $logs->user_id = Auth::id();
        $logs->desc = "User ".Auth::user()->name." Hapus Kategori Menu $request->id | ".$kategori->nama;
        $logs->save();
        $kategori->delete();

        return response()->json("OK", 200);
    }
}
