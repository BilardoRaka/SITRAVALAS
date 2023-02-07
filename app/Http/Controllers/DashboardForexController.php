<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Forex;
use App\Models\Transaction;
use App\Models\BuyTransaction;
use App\Models\SellTransaction;
use Carbon\Carbon;

class DashboardForexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->user()->role == "cabang"){
            abort(403);
        }

        $min = request('min');
        $max = request('max');
        $addmax = Carbon::parse($max)->addDays(1)->toDateTimeString();

        $transactions = Transaction::whereBetween('created_at', [$min, $addmax])->get();
        
        return view('dashboard.forexes.index', [
            'forexes' => Forex::all(),
            'transactions' => $transactions,
            'max' => $max,
            'min' => $min,
            'buys' => BuyTransaction::all(),
            'sells' => SellTransaction::all()
        ]); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('isAdmin');

        $DataValas = $request->validate([
            'id' => 'required|unique:forexes',
            'keterangan' => 'required|min:4',
        ]);
        
        $DataValas['id'] = strtoupper($DataValas['id']);
        Forex::create($DataValas);

        return redirect('/dashboard/forexes')->with('Sukses', 'Data Valas telah berhasil dibuat');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Forex $forex)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Forex $forex)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('isAdmin');
        Forex::destroy($id); 

        return redirect('/dashboard/forexes')->with('Sukses', 'Data Valas berhasil dihapus!');
    }
}
