<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    protected $table = 'pesanan';

    public function detail()
    {
        return $this->hasMany('App\PesananDetail', 'pesanan_id');
    }

    public function konsumen()
    {
        return $this->belongsTo('App\Konsumen', 'konsumen_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function meja()
    {
        return $this->belongsTo('App\Meja', 'meja_id');
    }
}
