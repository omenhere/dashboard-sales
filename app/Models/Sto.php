<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sto extends Model
{
    protected $primaryKey = 'id_sto';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['id_sto', 'nama_sto', 'id_witel'];

    public function witel()
    {
        return $this->belongsTo(Witel::class, 'id_witel');
    }

}

