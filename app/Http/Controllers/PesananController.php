<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;
use App\Konsumen;
use App\Meja;
use App\Menu;
use App\MenuKategori;
use App\Pesanan;
use App\PesananDetail;
use App\Pembayaran;
use App\JenisBayar;
use App\Logs;

class PesananController extends Controller
{
    public function generateCode()
    {
        $today = Pesanan::whereDate('created_at', date('Y-m-d'))->count();
        if($today == 0)
        {
            return "ABC".date('dmY')."-001";
        }
        else
        {
            $today = Pesanan::whereDate('created_at', date('Y-m-d'))->orderBy('created_at', 'DESC')->first();
            $nomor = substr($today->kode, -3);
            $nomor = str_pad($nomor+1,3,"0",STR_PAD_LEFT);

            return "ABC".date('dmY')."-".$nomor;
        }
    }

    public function index()
    {
        $kode = $this->generateCode();
        $konsumen = Konsumen::all();
        $kategori = MenuKategori::all();
        $meja = Meja::where('status', 'kosong')->get();
        return view('pesanan.index', ['jquery' => 'pesanan.jquery', 
                                      "kode" => $kode, 
                                      "konsumen" => $konsumen, 
                                      'meja' => $meja,
                                      'kategori' => $kategori
                                      ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kode' => 'required|string|max:255|unique:pesanan',
            'konsumen_id' => 'required|string|max:255',
            'meja_id' => 'required|string|max:255',
            'diskon' => 'required|integer|min:0|max:100',
            'ppn' => 'required|integer|min:0|max:100',
        ]);

        if($validator->fails())
        {
            return response()->json($validator->errors(), 400);
        }

        $pesanan = new Pesanan;
        $pesanan->kode = $request->kode;
        $pesanan->konsumen_id = $request->konsumen_id;
        $pesanan->user_id = Auth::id();
        $pesanan->meja_id = $request->meja_id;
        $pesanan->total_harga = 0;
        $pesanan->diskon = $request->diskon;
        $pesanan->ppn = $request->ppn;
        $pesanan->grand_total = 0;
        $pesanan->status = "proses";
        $pesanan->save();

        $logs = new Logs;
        $logs->user_id = Auth::id();
        $logs->desc = "User ".Auth::user()->name." Tambah Pesanan $request->kode | $request->konsumen_id | $request->meja_id | $request->diskon | $request->ppn";
        $logs->save();

        // update meja
        $meja = Meja::find($request->meja_id);
        $meja->status = "isi";
        $meja->save();

        return response()->json("OK");
    }

    public function detail(Request $request)
    {
        $master = Pesanan::where("kode", $request->kode)->first();
        $detail = PesananDetail::where("Pesanan_id", $master->id)->get();
        $jenis_byr = JenisBayar::all();

        return view("pesanan.detail", ["detail" => $detail, "master" => $master, "jenis_byr" => $jenis_byr]);
    }

    public function store_detail(Request $request)
    {
        $master = Pesanan::where("kode", $request->kode)->first();

        if(!$master)
        {
            return response()->json("Klik Simpan Terlebih Dahulu");
        }

        $count = Menu::where("id", $request->menu_id)->where("stok", ">", "0")->count();
        if($count == 0)
        {
            return response()->json("Stok Menu Tidak Tersedia");
        }

        $count = PesananDetail::where("pesanan_id", $master->id)->where("menu_id", $request->menu_id)->count();
        if($count == 0)
        {
            $detail = new PesananDetail;
            $detail->pesanan_id = $master->id;
            $detail->menu_id = $request->menu_id;
            $detail->qty = 1;
            $detail->harga = Menu::find($request->menu_id)->harga;
            $detail->total_harga = Menu::find($request->menu_id)->harga;
            $detail->save();
        }
        else
        {
            $count = PesananDetail::where("pesanan_id", $master->id)->where("menu_id", $request->menu_id)->first();
            $detail = PesananDetail::find($count->id);
            $detail->qty = $detail->qty + 1;
            $detail->harga = Menu::find($request->menu_id)->harga;
            $detail->total_harga = Menu::find($request->menu_id)->harga * $detail->qty;
            $detail->save();
        }

        $logs = new Logs;
        $logs->user_id = Auth::id();
        $logs->desc = "User ".Auth::user()->name." Tambah Menu $request->menu_id | $request->kode ";
        $logs->save();

        $sum = PesananDetail::where("pesanan_id", $master->id)->sum("total_harga");
        $diskon_val = $sum * $master->diskon / 100;
        $ppn_val = ($sum - $diskon_val) * $master->ppn / 100;

        // update master
        $pesanan = Pesanan::find($master->id);
        $pesanan->total_harga = $sum;
        $pesanan->grand_total = $sum - $diskon_val + $ppn_val;
        $pesanan->save();

        // update stok
        $menu = Menu::find($request->menu_id);
        $menu->stok = $menu->stok - 1;
        $menu->save();

        return response()->json("OK");
    }

    public function update_detail(Request $request)
    {
        $master = Pesanan::where("kode", $request->kode)->first();
        $detail = PesananDetail::find($request->id);

        if(!$master)
        {
            return response()->json("Klik Simpan Terlebih Dahulu");
        }

        $selisih_stok = $request->qty - $detail->qty;
        if($selisih_stok > 0)
        {
            $count = Menu::where("id", $detail->menu_id)->where("stok", ">=", $selisih_stok)->count();
            if($count == 0)
            {
                return response()->json("Stok Menu Tidak Tersedia");
            }
        }

        $detail = PesananDetail::find($request->id);
        $detail->qty = $detail->qty + $selisih_stok;
        $detail->harga = Menu::find($detail->menu_id)->harga;
        $detail->total_harga = Menu::find($detail->menu_id)->harga * $detail->qty;
        $detail->save();

        $logs = new Logs;
        $logs->user_id = Auth::id();
        $logs->desc = "User ".Auth::user()->name." Ubah Qty Menu $request->menu_id | $request->kode ";
        $logs->save();

        $sum = PesananDetail::where("pesanan_id", $master->id)->sum("total_harga");
        $diskon_val = $sum * $master->diskon / 100;
        $ppn_val = ($sum - $diskon_val) * $master->ppn / 100;

        // update master
        $pesanan = Pesanan::find($master->id);
        $pesanan->total_harga = $sum;
        $pesanan->grand_total = $sum - $diskon_val + $ppn_val;
        $pesanan->save();

        // update stok
        $menu = Menu::find($detail->menu_id);
        $menu->stok = $menu->stok - $selisih_stok;
        $menu->save();

        return response()->json("OK");
    }

    public function hapus_detail(Request $request)
    {
        $detail = PesananDetail::find($request->id);
        $master = Pesanan::find($detail->pesanan_id);

        $logs = new Logs;
        $logs->user_id = Auth::id();
        $logs->desc = "User ".Auth::user()->name." Hapus Menu $detail->nama | $master->kode ";
        $logs->save();

        $menu = Menu::find($detail->menu_id);
        $menu->stok = $menu->stok + $detail->qty;
        $menu->save();
        $detail->delete();

        
        $sum = PesananDetail::where("pesanan_id", $master->id)->sum("total_harga");
        $diskon_val = $sum * $master->diskon / 100;
        $ppn_val = ($sum - $diskon_val) * $master->ppn / 100;

        // update master
        $pesanan = Pesanan::find($master->id);
        $pesanan->total_harga = $sum;
        $pesanan->grand_total = $sum - $diskon_val + $ppn_val;
        $pesanan->save();

        return response()->json("OK");
    }

    public function simpan_bayar(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nilai_bayar' => 'required|integer',
        ]);

        if($validator->fails())
        {
            return response()->json($validator->errors(), 400);
        }
        
        $master = Pesanan::where("kode", $request->kode)->first();
        $pembayaran = new Pembayaran;
        $pembayaran->pesanan_id = $master->id;
        $pembayaran->jenis_byr_id = $request->jenis_byr_id;
        $pembayaran->nilai_bayar = $request->nilai_bayar;
        $pembayaran->kembalian = $request->nilai_bayar - $master->grand_total;
        $pembayaran->save();

        // update master
        $pesanan = Pesanan::find($master->id);
        $pesanan->status = "lunas";
        $pesanan->save();

        // update meja
        $meja = Meja::find($master->meja_id);
        $meja->status = "kosong";
        $meja->save();

        return response()->json("OK");
    }

    public function print_dapur(Request $request)
    {
        $pesanan = Pesanan::where("kode", $request->kode)->first();
        return view('print.dapur', ["pesanan" => $pesanan]);
    }

    public function print_invoice(Request $request)
    {
        $pesanan = Pesanan::where("kode", $request->kode)->first();
        return view('print.invoice', ["pesanan" => $pesanan]);
    }

    public function proses()
    {
        if(Auth::user()->role == "waiter")
        {
            $pesanan = Pesanan::where("status", "proses")->where("user_id", Auth::id())->get();
        }
        else
        {
            $pesanan = Pesanan::where("status", "proses")->get();
        } 
        return view('pesanan.proses', ['jquery' => 'pesanan.jquery', 'pesanan' => $pesanan]);
    }

    public function batal()
    {
        if(Auth::user()->role == "waiter")
        {
            $pesanan = Pesanan::where("status", "proses")->where("grand_total", 0)->where("user_id", Auth::id())->get();
        }
        else
        {
            $pesanan = Pesanan::where("status", "proses")->where("grand_total", 0)->get();
        } 
        return view('pesanan.batal', ['jquery' => 'pesanan.jquery', 'pesanan' => $pesanan]);
    }

    public function show(Request $request)
    {
        $pesanan = Pesanan::find($request->id);
        return view('pesanan.show', ['pesanan' => $pesanan]);
    }

    public function check_lanjut(Request $request)
    {
        $count = Pesanan::where("kode", $request->kode)->where("status", "proses")->count();

        if($count > 0)
        {
            return response()->json("OK");
        }
        else
        {
            return response()->json("Pesanan Tidak Terdaftar");
        }
    }

    public function proses_batal(Request $request)
    {
        $count = PesananDetail::where("pesanan_id", $request->id)->count();
        if($count > 0)
        {
            return response()->json("Pesanan Tidak Kosong");
        }

        $pesanan = Pesanan::find($request->id);
        $pesanan->status = "batal";
        $pesanan->save();

        return response()->json("OK");
    }
}
