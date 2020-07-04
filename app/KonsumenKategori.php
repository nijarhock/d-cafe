<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KonsumenKategori extends Model
{
    protected $table = "konsumen_kategori";

    public function konsumens()
    {
        return $this->hasMany('App\Konsumen');
    }
}
