<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bundle extends Model
{
    use HasFactory;
    protected $table = 'bundles';
    public $incrementing = false;  
    protected $fillable = ['id','name'];

    public function subpakets()
    {
        return $this->hasMany(Subpaket::class, 'bundle_id');
    }
}