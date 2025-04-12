<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Sale extends Model
{
    use HasFactory;

    protected $table = 'sales';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'witel_id',
        'sto_id',
        'subpaket_id',
        'quantity',
        'sale_date',
    ];

    protected static function booted()
    {
        static::creating(function ($model) {
            $model->id = $model->id ?? (string) Str::uuid();
            $model->sale_date = $model->sale_date ?? now()->toDateString();
        });
    }

    public function witel()
    {
        return $this->belongsTo(Witel::class);
    }

    public function sto()
    {
        return $this->belongsTo(Sto::class);
    }

    public function subpaket()
    {
        return $this->belongsTo(Subpaket::class);
    }
}
