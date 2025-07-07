<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductPrice extends Model
{
    protected $table = 'product_prices';
    public $timestamps = false;

    protected $fillable = ['id_product', 'id_witel', 'id_sto', 'harga_jasa'];

    public function sto()
    {
        return $this->belongsTo(Sto::class, 'id_sto');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'id_product');
    }

    public function witel()
    {
        return $this->belongsTo(Witel::class, 'id_witel');
    }
}
