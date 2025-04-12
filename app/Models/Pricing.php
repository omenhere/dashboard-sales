<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pricing extends Model
{
    use HasFactory;
    protected $table = 'pricing';
    public $incrementing = false;  
    protected $fillable = [
        'id',
        'witel_id',
        'sto_id',
        'subpaket_id',
        'material_price',
        'jasa_price'
    ];


    public function subpaket()
    {
        return $this->belongsTo(Subpaket::class, 'subpaket_id');
    }

    public function witel()
    {
        return $this->belongsTo(Witel::class, 'witel_id');
    }

    public function sto()
    {
        return $this->belongsTo(Sto::class, 'sto_id');
    }
}