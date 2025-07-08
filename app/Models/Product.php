<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ProductPrice;

class Product extends Model
{
    protected $primaryKey = 'id_product';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['id_product', 'name_product', 'harga_materi'];


    public function prices()
    {
        return $this->hasMany(ProductPrice::class, 'id_product');
    }

    public function bundlings()
    {
        return $this->belongsToMany(Bundling::class, 'product_bundling', 'id_product', 'id_bundling');
    }
    public function getBundleAttribute()
    {
        return $this->bundlings->first();
    }



}
