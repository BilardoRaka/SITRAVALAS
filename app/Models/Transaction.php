<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $guarded = ['id']; 

    public function buytransaction()
    {
        return $this->hasMany(BuyTransaction::class);
    }

    public function selltransaction()
    {
        return $this->hasMany(SellTransaction::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeTrans($query, array $filters)
    {
        $query->when($filters['wilayah'] ?? false, function($query, $wilayah) {
            return $query->where(function($query) use ($wilayah) {
                $query->where('account_id', $wilayah);
            });
        });

        $query->when($filters['bulan'] ?? false, function($query, $bulan) {
            return $query->where(function($query) use ($bulan){
                $query->whereMonth('created_at', $bulan);
            });
        });

        $query->when($filters['tahun'] ?? false, function($query, $tahun) {
            return $query->where(function($query) use ($tahun){
                $query->whereYear('created_at', $tahun);
            });
        });
    }

    public function scopeWaktu($query)
    {
        if(request('tahun')) {
            return $query = Transaction::whereYear('created_at', request('tahun'));
        }

        if(request('bulan')) {
            return $query = Transaction::whereMonth('created_at', request('bulan'));
        }
    }
}
