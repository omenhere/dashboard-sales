<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = [
        'id_witel',
        'id_sto',
        'id_product',
        'quantity',
    ];

    public function witel()
    {
        return $this->belongsTo(Witel::class, 'id_witel');
    }

    public function sto()
    {
        return $this->belongsTo(Sto::class, 'id_sto');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'id_product');
    }
}
