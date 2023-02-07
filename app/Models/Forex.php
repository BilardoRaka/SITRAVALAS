<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Forex extends Model
{
    use HasFactory;

    //Set PrimaryKey jadi Kode
    //protected $primaryKey = 'kode';

    //Set PrimaryKey jadi Tidak Auto-Increment
    public $incrementing = false;

    //Set TypeData untuk PrimaryKey
    protected $keyType = 'string';

    protected $fillable = ['id','keterangan','stok']; 
}
