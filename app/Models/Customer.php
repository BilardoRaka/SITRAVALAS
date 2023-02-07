<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    //Set PrimaryKey jadi Tidak Auto-Increment
    public $incrementing = false;

    //Set TypeData untuk PrimaryKey
    protected $keyType = 'string';

    protected $fillable = ['id','nama','alamat','tempatlahir','tgllahir','email','nohp']; 

    public function scopeFilter($query)
    {
        if(request('search')) {
            return $query = customer::where('id', 'like', '%' . request('search') . '%')
            ->orWhere('nama', 'like', '%' . request('search') . '%');
        }
    }

    public function transaction()
    {
        return $this->hasMany(Transaction::class);
    }
}
