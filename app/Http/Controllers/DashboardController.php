<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Stevebauman\Location\Facades\Location;
use App\Models\User;
use Faker\Generator;
use Illuminate\Container\Container;


class DashboardController extends Controller
{
    public function index(){

        //Call APIs
        $request = Http::get("https://idrexchangerate-bilardoraka64.b4a.run");

        $kursFeed = collect(json_decode($request))->get("kursFeed");
        $date = collect(json_decode($request))->get("Date");
        // dd($date);
        return view('dashboard.index',[
            'forexes' => $kursFeed,
            'tanggal' => $date
        ]);
    }

    public function getLocation(){
        return view('dashboard.deteksiLokasi');
    }

    public function newLocation(){
        $faker = Container::getInstance()->make(Generator::class);
        $ip = $faker->ipv4(); 
        $retrieve = Location::get($ip);

        $url = "https://maps.google.com/maps?q=".$retrieve->latitude.",%20".$retrieve->longitude."&t=&z=13&ie=UTF8&iwloc";

        $DataUser['koordinat'] = $url;
        User::where('id', auth()->user()->user->id)->update($DataUser);
        return redirect('/dashboard/deteksiLokasi')->with('Sukses', 'Koordinat kios telah diperbarui!');
    }
}
