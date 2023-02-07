<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Account;
use Illuminate\Support\Facades\Hash;

class DashboardAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.accounts.index', [
            'accounts' => Account::paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.accounts.create',[
            'accounts' => Account::all()
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
        $DataAccount = $request->validate([
            'username' => 'required|min:4|max:12|unique:accounts',
            'password' => 'required|min:4|max:12',
            'role' => 'required'
        ]);

        $DataUser = $request->validate([
            'wilayah' => 'nullable',
            'alamat' => 'nullable',
            'koordinat' => 'prohibited'
        ]);

        $DataUser['wilayah'] = strtoupper($DataUser['wilayah']);
        
        User::create($DataUser);

        $DataAccount['user_id'] = User::get()->last()->id;
        $DataAccount['password'] = Hash::make($DataAccount['password']);

        Account::create($DataAccount);

        return redirect('/dashboard/accounts')->with('Sukses', 'Akun telah berhasil dibuat');
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
    public function edit(Account $account)
    {
        return view('dashboard.accounts.edit', [
            'account' => $account
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Account $account)
    {
        $DataAccount = ([
            'password' => 'required|min:4|max:12',
            'role' => 'required'
        ]);
        $DataUser = $request->validate([
            'wilayah' => 'nullable',
            'alamat' => 'nullable',
            'koordinat' => 'prohibited'
        ]);

        $DataUser['wilayah'] = strtoupper($DataUser['wilayah']);

        if($request->username != $account->username) {
            $DataAccount['username'] = 'required|min:4|max:12|unique:accounts';
        }

        $ValidatedDataAccount = $request->validate($DataAccount);
        
        User::where('id', $account->user->id)->update($DataUser);
        
        $DataAccount['user_id'] = $account->user->id;
        $ValidatedDataAccount['password'] = Hash::make($ValidatedDataAccount['password']);

        Account::where('id', $account->id)->update($ValidatedDataAccount);

        return redirect('/dashboard/accounts')->with('Sukses', 'Akun telah berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id); 
        Account::destroy($id); 

        return redirect('/dashboard/accounts')->with('Sukses', 'Akun berhasil dihapus!');
    }
}
