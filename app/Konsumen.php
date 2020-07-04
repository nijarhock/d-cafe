<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Konsumen extends Model
{
    protected $table = 'konsumen';

    public function kategori()
    {
        return $this->belongsTo('App\KonsumenKategori', 'konsumen_kategori_id', 'id');
    }
}
