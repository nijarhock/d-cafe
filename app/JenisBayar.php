<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Pembayaran;

class JenisBayar extends Model
{
    protected $table = "jenis_byr";

    public function sumBayar($id, $pesanan_id)
    {
        return Pembayaran::where("jenis_byr_id", $id)->where("pesanan_id", $pesanan_id)->sum("nilai_bayar");
    }
}
