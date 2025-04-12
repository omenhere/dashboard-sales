<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sto extends Model
{
    use HasFactory;
    protected $table = 'stos';
    protected $fillable = ['id', 'witel_id', 'name'];
    public $incrementing = false;
    protected $keyType = 'string';

    public function witel()
    {
        return $this->belongsTo(Witel::class);
    }

    public function pricings()
    {
        return $this->hasMany(Pricing::class);
    }

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }
}
