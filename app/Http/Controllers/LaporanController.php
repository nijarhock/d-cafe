<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pesanan;
use App\Menu;
use App\JenisBayar;
use App\PesananDetail;
use App\Logs;
use Auth;

class LaporanController extends Controller
{
    public function pesanan()
    {
        return view("laporan.pesanan", ["jquery" => "laporan.jquery"]);
    }

    public function detail_pesanan(Request $request)
    {
        $dari = date("Y-m-d");
        $sampai = date("Y-m-d");
        if($request->dari)
        {
            $dari = $request->dari;
        }

        if($request->sampai)
        {
            $sampai = $request->sampai;
        }

        if(Auth::user()->role == "waiter") 
        {
            $pesanan = Pesanan::where("user_id", Auth::id())->whereBetween('created_at', [$dari, $sampai])->get();
        }
        else
        {
            $pesanan = Pesanan::whereBetween('created_at', [$dari, $sampai])->get();
        }
        return view("laporan.detail_pesanan", ["pesanan" => $pesanan]);
    }

    public function stok_min()
    {
        $menu = Menu::where("stok", "<", "stok_min")->get();
        return view("laporan.stok_min", ["jquery" => "laporan.jquery", "menu" => $menu]);
    }

    public function bayar()
    {
        return view("laporan.bayar", ["jquery" => "laporan.jquery"]);
    }

    public function detail_bayar(Request $request)
    {
        $dari = date("Y-m-d");
        $sampai = date("Y-m-d");
        if($request->dari)
        {
            $dari = $request->dari;
        }

        if($request->sampai)
        {
            $sampai = $request->sampai;
        }
        $jenis_byr = JenisBayar::all();
        $pesanan = Pesanan::whereBetween('created_at', [$dari, $sampai])->get();
        
        return view("laporan.detail_bayar", ["pesanan" => $pesanan, "jenis_byr" => $jenis_byr]);
    }

    public function detail()
    {
        return view("laporan.detail", ["jquery" => "laporan.jquery"]);
    }

    public function detail_detail(Request $request)
    {
        $dari = date("Y-m-d");
        $sampai = date("Y-m-d");
        if($request->dari)
        {
            $dari = $request->dari;
        }

        if($request->sampai)
        {
            $sampai = $request->sampai;
        }

        $pesanan = PesananDetail::whereBetween('created_at', [$dari, $sampai])->get();
        
        return view("laporan.detail_detail", ["pesanan" => $pesanan]);
    }

    public function logs()
    {
        return view("laporan.logs", ["jquery" => "laporan.jquery"]);
    }

    public function detail_logs(Request $request)
    {
        $dari = date("Y-m-d");
        $sampai = date("Y-m-d");
        if($request->dari)
        {
            $dari = $request->dari;
        }

        if($request->sampai)
        {
            $sampai = $request->sampai;
        }

        $logs = Logs::whereBetween('created_at', [$dari, $sampai])->get();
        
        return view("laporan.detail_logs", ["logs" => $logs]);
    }
}
