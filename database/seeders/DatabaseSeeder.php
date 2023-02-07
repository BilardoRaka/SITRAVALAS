<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Account;
use App\Models\Customer;
use App\Models\Forex;
use App\Models\Transaction;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(3)->create();
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        
        User::create([
            'wilayah' => '',
            'alamat' => '',
            'koordinat' => ''
        ]);

        User::create([
            'wilayah' => '',
            'alamat' => '',
            'koordinat' => ''
        ]);

        User::create([
            'wilayah' => 'SALATIGA',
            'alamat' => 'Ds. Honggowongso No. 334, Balikpapan 44980, Gorontalo',
            'koordinat' => "https://maps.google.com/maps?q=39.9747,%20-82.8947&t=&z=13&ie=UTF8&iwloc"
        ]);

        User::create([
            'wilayah' => 'PURWOKERTO',
            'alamat' => 'Ds. Honggowongso No. 334, Balikpapan 44980, Gorontalo',
            'koordinat' => "https://maps.google.com/maps?q=39.9747,%20-82.8947&t=&z=13&ie=UTF8&iwloc"
        ]);

        User::create([
            'wilayah' => 'PURBALINGGA',
            'alamat' => 'Ds. Honggowongso No. 334, Balikpapan 44980, Gorontalo',
            'koordinat' => "https://maps.google.com/maps?q=39.9747,%20-82.8947&t=&z=13&ie=UTF8&iwloc"
        ]);
        
        User::create([
            'wilayah' => 'WONOSOBO',
            'alamat' => 'Ds. Honggowongso No. 334, Balikpapan 44980, Gorontalo',
            'koordinat' => "https://maps.google.com/maps?q=39.9747,%20-82.8947&t=&z=13&ie=UTF8&iwloc"
        ]);

        User::create([
            'wilayah' => 'KEBUMEN',
            'alamat' => 'Ds. Honggowongso No. 334, Balikpapan 44980, Gorontalo',
            'koordinat' => "https://maps.google.com/maps?q=39.9747,%20-82.8947&t=&z=13&ie=UTF8&iwloc"
        ]);

        User::create([
            'wilayah' => 'PURWOREJO',
            'alamat' => 'Ds. Honggowongso No. 334, Balikpapan 44980, Gorontalo',
            'koordinat' => "https://maps.google.com/maps?q=39.9747,%20-82.8947&t=&z=13&ie=UTF8&iwloc"
        ]);

        User::create([
            'wilayah' => 'KUTOARJO',
            'alamat' => 'Ds. Honggowongso No. 334, Balikpapan 44980, Gorontalo',
            'koordinat' => "https://maps.google.com/maps?q=39.9747,%20-82.8947&t=&z=13&ie=UTF8&iwloc"
        ]);

        User::create([
            'wilayah' => 'CIREBON',
            'alamat' => 'Ds. Honggowongso No. 334, Balikpapan 44980, Gorontalo',
            'koordinat' => "https://maps.google.com/maps?q=39.9747,%20-82.8947&t=&z=13&ie=UTF8&iwloc"
        ]);

        Account::create([
            'user_id' => 1,
            'username' => 'admin',
            'password' => bcrypt('12345'),
            'role' => 'admin'
        ]);

        Account::create([
            'user_id' => 2,
            'username' => 'pimpinan',
            'password' => bcrypt('12345'),
            'role' => 'pimpinan'
        ]);

        Account::create([
            'user_id' => 3,
            'username' => 'sltg1',
            'password' => bcrypt('12345'),
            'role' => 'cabang'
        ]);

        Account::create([
            'user_id' => 4,
            'username' => 'pwt1',
            'password' => bcrypt('12345'),
            'role' => 'cabang'
        ]);

        Account::create([
            'user_id' => 5,
            'username' => 'pbg1',
            'password' => bcrypt('12345'),
            'role' => 'cabang'
        ]);

        Account::create([
            'user_id' => 6,
            'username' => 'wnsb1',
            'password' => bcrypt('12345'),
            'role' => 'cabang'
        ]);

        Account::create([
            'user_id' => 7,
            'username' => 'kbm1',
            'password' => bcrypt('12345'),
            'role' => 'cabang'
        ]);

        Account::create([
            'user_id' => 8,
            'username' => 'pwrj1',
            'password' => bcrypt('12345'),
            'role' => 'cabang'
        ]);

        Account::create([
            'user_id' => 9,
            'username' => 'ktrj1',
            'password' => bcrypt('12345'),
            'role' => 'cabang'
        ]);

        Account::create([
            'user_id' => 10,
            'username' => 'crb1',
            'password' => bcrypt('12345'),
            'role' => 'cabang'
        ]);
        
        Forex::create([
            'id' => 'USD',
            'keterangan' => 'American Dollar'
        ]);

        Forex::create([
            'id' => 'AUD',
            'keterangan' => 'Australian Dollar'
        ]);

        Forex::create([
            'id' => 'SGD',
            'keterangan' => 'Singapore Dollar'
        ]);

        Forex::create([
            'id' => 'SAR',
            'keterangan' => 'Saudi Arabian Real'
        ]);

        Forex::create([
            'id' => 'KWD',
            'keterangan' => 'Kuwait Dinar'
        ]);

        Forex::create([
            'id' => 'MYR',
            'keterangan' => 'Malaysian Ringgit'
        ]);

        Forex::create([
            'id' => 'VND',
            'keterangan' => 'Vietnam Dong'
        ]);

        Forex::create([
            'id' => 'CNY',
            'keterangan' => 'Chinese Yuan'
        ]);

        Forex::create([
            'id' => 'BND',
            'keterangan' => 'Brunei Darussalam Dollar'
        ]);

        Forex::create([
            'id' => 'GBP',
            'keterangan' => 'Great Britain Poundsterling'
        ]);

        Transaction::create([
            'account_id' => '3',
            'kredit' => 10000000,
            'saldo' => 10000000
        ]);

        Transaction::create([
            'account_id' => '4',
            'kredit' => 7000000,
            'saldo' => 7000000
        ]);

        Transaction::create([
            'account_id' => '5',
            'kredit' => 5000000,
            'saldo' => 5000000
        ]);

        Transaction::create([
            'account_id' => '6',
            'kredit' => 12000000,
            'saldo' => 12000000
        ]);

        Transaction::create([
            'account_id' => '7',
            'kredit' => 13000000,
            'saldo' => 13000000
        ]);

        Transaction::create([
            'account_id' => '8',
            'kredit' => 3500000,
            'saldo' => 3500000
        ]);

        Transaction::create([
            'account_id' => '9',
            'kredit' => 6500000,
            'saldo' => 6500000
        ]);

        Transaction::create([
            'account_id' => '10',
            'kredit' => 4500000,
            'saldo' => 4500000
        ]);

        Customer::factory(50)->create();
    }
}
