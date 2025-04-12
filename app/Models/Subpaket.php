<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subpaket extends Model
{
    use HasFactory;
    protected $table = 'subpakets';
    public $incrementing = false;
    protected $fillable = ['id', 'bundle_id', 'name'];

    public function bundle()
    {
        return $this->belongsTo(Bundle::class, 'bundle_id');
    }
    public function pricing()
    {
        return $this->hasOne(Pricing::class);
    }

}