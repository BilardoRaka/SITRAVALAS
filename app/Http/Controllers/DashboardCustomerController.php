<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Transaction;
use App\Models\BuyTransaction;
use App\Models\SellTransaction;
use Illuminate\Http\Request;
use Faker\Generator;
use Illuminate\Container\Container;
use PDF;

class DashboardCustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.customers.index',[
            'customers' => Customer::filter()->latest()->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.customers.create',[
            'customers' => Customer::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $DataCustomer = [
            'id' => 'required|integer|unique:customers',
            'nama' => 'required|string',
            'alamat' => 'required',
            'tempatlahir' => 'required',
            'tgllahir' => 'required|date',
            'nohp' => 'required'
        ];

        if(request('email') == null){
            $faker = Container::getInstance()->make(Generator::class);
            $DataCustomer['email'] = $faker->email();
        } elseif(request('email') != null) {
            $DataCustomer['email'] = 'email:dns|unique:customers';
        }

        $validatedData = $request->validate($DataCustomer);
        Customer::create($validatedData);

        return redirect('/dashboard/customers')->with('Sukses', 'Data pelanggan telah berhasil dibuat');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        return view('dashboard.customers.edit',[
            'customer' => $customer
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        $DataCustomer = [
            'nama' => 'required|string',
            'alamat' => 'required',
            'tempatlahir' => 'required',
            'tgllahir' => 'required|date',
            'nohp' => 'required'
        ];

        if($request->email != $customer->email) {
            $DataCustomer['email'] = 'email:dns|unique:customers';
        }

        $validatedData = $request->validate($DataCustomer);

        Customer::where('id', $customer->id)->update($validatedData);

        return redirect('/dashboard/customers')->with('Sukses', 'Data pelanggan telah berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        Customer::destroy($customer->id); 

        return redirect('/dashboard/customers')->with('Sukses', 'Data pelanggan berhasil dihapus!');
    }

    public function printPreview()
    {
        if(auth()->user()->role == "cabang"){
            abort(403);
        }
        
        $customers = customer::all();
    
        $pdf = PDF::loadView('dashboard.customers.print', [
            'customers' => $customers,
        ]);
        
        return $pdf->stream('ListCustomer.pdf',array('Attachment'=>0));

    }

    public function history($id)
    {
        if(auth()->user()->role == "cabang"){
            abort(403);
        }

        return view('dashboard.customers.history',[
            'transactions' => Transaction::where('customer_id', $id)->get(),
            'buys' => BuyTransaction::all(),
            'sells' => SellTransaction::all()
        ]);
    }
}
