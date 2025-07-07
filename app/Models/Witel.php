<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Witel extends Model
{
    protected $primaryKey = 'id_witel';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['id_witel', 'nama_witel'];

    public function stos()
    {
        return $this->hasMany(Sto::class, 'id_witel');
    }

    public function productPrices()
    {
        return $this->hasMany(ProductPrice::class, 'id_witel');
    }
}
