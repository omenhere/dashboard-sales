<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bundling extends Model
{
    protected $primaryKey = 'id_bundling';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['id_bundling', 'name_bundling'];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_bundling', 'id_bundling', 'id_product');
    }
}
