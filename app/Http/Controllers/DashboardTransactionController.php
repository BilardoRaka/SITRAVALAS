<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\Email;
use App\Models\Transaction;
use App\Models\Forex;
use App\Models\BuyTransaction;
use App\Models\SellTransaction;
use App\Models\Customer;
use App\Models\User;
use App\Models\Account;
use PDF;

class DashboardTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $account_id = auth()->user()->id;
        $role = auth()->user()->role;
        $requestwilayah = request('wilayah');
        $requestbulan = request('bulan');
        $requesttahun = request('tahun');

        if($role == "cabang"){
            $showTrans = Transaction::where('account_id', $account_id)->latest();
            $requestwilayah = auth()->user()->user->id;
        } elseif($role != "cabang") {
            $showTrans = Transaction::trans(request(['wilayah','bulan','tahun']))->latest();
        }

        if($role == "cabang" and $requesttahun and $requestbulan){
            $showTrans = Transaction::where('account_id', $account_id)->whereYear('created_at', $requesttahun)->whereMonth('created_at', $requestbulan)->latest();
        }

        return view('dashboard.transactions.index',[
            'transactions' => $showTrans->paginate(10)->withQueryString(),
            'trans' => Transaction::all(),
            'buy' => BuyTransaction::all(),
            'sell' => SellTransaction::all(),
            'users' => User::all(),
            'accounts' => Account::all(),
            'requestwilayah' => $requestwilayah,
            'requestbulan' => $requestbulan,
            'requesttahun' => $requesttahun
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
        $this->authorize('isCabang');

        $forex_id = $request->forex_id;
        $jumlah = $request->jumlah;
        $harga_satuan = $request->harga_satuan;
        $nik = $request->nik;
        $jt = $request->jenis_transaksi;
        $account_id = auth()->user()->id;
        $saldo_lama = Transaction::where('account_id', $account_id)->latest()->value('saldo'); 

        for($i = 0; $i < count($jumlah); $i++) {
            $total[] = $jumlah[$i] * $harga_satuan[$i];
        }

        $totalsemua = 0;
        foreach($total as $item) {
            $totalsemua += $item;
        }

        $dataTrans = [
            'customer_id' => $nik,
            'account_id' => $account_id
        ];

        if($jt == "BeliBarang"){
            $dataTrans['debit'] = $totalsemua;
            $saldo_baru = $saldo_lama - $totalsemua;
        } else {
            $dataTrans['kredit'] = $totalsemua;
            $saldo_baru = $saldo_lama + $totalsemua;
        }
        
        $dataTrans['saldo'] = $saldo_baru;

        Transaction::create($dataTrans);
        
        $id_transaksi = Transaction::where('account_id', $account_id)->latest()->value('id'); 

        for($i=0; $i < count($jumlah); $i++) {
            $dataSave = [
                'transaction_id' => $id_transaksi,
                'forex_id' => $forex_id[$i],
                'jumlah' => $jumlah[$i],
                'harga_satuan' => $harga_satuan[$i],
                'total' => $total[$i]
            ];
            if($jt == "BeliBarang") {
                BuyTransaction::create($dataSave);  
            } elseif ($jt == "JualBarang") {
                SellTransaction::create($dataSave);
            }
        }
        
        $tran = Transaction::where('id', $id_transaksi)->get();

        if($jt == "BeliBarang") {
            $body = [
                'transaction' => $tran[0],
                'buys' => BuyTransaction::where('transaction_id', $id_transaksi)->get(),
                'user' => User::where('id', $account_id)->value('wilayah'),
                'jt' => 'Beli Barang'            
            ];
        } elseif($jt == "JualBarang") {
            $body = [
                'transaction' => $tran[0],
                'sells' => SellTransaction::where('transaction_id', $id_transaksi)->get(),
                'user' => User::where('id', $account_id)->value('wilayah'),
                'jt' => 'Jual Barang'
            ];
        }

        $email = Customer::where('id', $nik)->value('email');

        Mail::to($email)->send(new Email($body));
        
        return redirect('/dashboard/transactions')->with('Sukses', 'Transaksi baru berhasil dibuat!');
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
    public function edit($id)
    {
        $this->authorize('isCabang');
        return view('dashboard.transactions.edit',[
            'forexes' => Forex::all(),
            'id' => $id
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
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
        //
    }

    public function customer()
    {
        $this->authorize('isCabang');
        return view('dashboard.transactions.customer',[
            'customers' => Customer::filter()->paginate(10)
        ]);
    }

    public function ModalMasuk(Request $request)
    {
        $this->authorize('isCabang');
        $jumlahModal = $request->jumlahModal;
        $account_id = auth()->user()->id;
        $saldo_lama = Transaction::where('account_id', $account_id)->latest()->value('saldo'); 
        $saldo_baru = $jumlahModal + $saldo_lama;

        $dataSave = [
            'account_id' => $account_id,
            'kredit' => $jumlahModal,
            'saldo' => $saldo_baru
        ];

        Transaction::create($dataSave);

        return redirect('/dashboard/transactions')->with('Sukses', 'Modal Usaha berhasil ditambahkan!');
    }

    public function invoice($id)
    {
        $nik = Transaction::where('id', $id)->value('customer_id');
        $kredit = Transaction::where('id', $id)->value('kredit');
        $acc = Transaction::where('id', $id)->value('account_id');

        if($kredit == null){
            $jt = "BeliBarang";
        } elseif($kredit != null){
            $jt = "JualBarang";
        }
        
        if($jt == "BeliBarang"){
            $pdf = PDF::loadView('dashboard.transactions.invoice', [
                'customer' => Customer::where('id', $nik)->get(),
                'transaction' => Transaction::where('id', $id)->get(),
                'buys' => BuyTransaction::where('transaction_id', $id)->get(),
                'user' => User::where('id', $acc)->get(),
                'jt' => 'Beli Forex'
            ])->setPaper('a5', 'landscape');
            } elseif($jt == "JualBarang") {
            $pdf = PDF::loadView('dashboard.transactions.invoice', [
                'customer' => Customer::where('id', $nik)->get(),
                'transaction' => Transaction::where('id', $id)->get(),
                'sells' => SellTransaction::where('transaction_id', $id)->get(),
                'user' => User::where('id', $acc)->get(),
                'jt' => 'Jual Forex'
            ])->setPaper('a5', 'landscape');    
            }
    
            return $pdf->stream('invoice.pdf',array('Attachment'=>0));
    }

    public function rekapitulasi(Request $request)
    {

        $wilayah = request('wilayah');
        $bulan = request('bulan');
        $tahun = request('tahun');
        $account = User::where('id', $wilayah)->get();
        $forex = Forex::all();
        $transactions = Transaction::where('account_id', $wilayah)->whereYear('created_at', $tahun)->whereMonth('created_at', $bulan)->get();

        $pdf = PDF::loadView('dashboard.transactions.rekapitulasi', [
            'transactions' => $transactions,
            'account' => $account,
            'tahun' => $tahun,
            'bulan' => $bulan,
            'forexes' => Forex::all(),
            'buys' => BuyTransaction::all(),
            'sells' => SellTransaction::all()
        ]);
        
        return $pdf->stream('RekapBulanan - '.$account[0]->wilayah.' - '.$tahun.' - '. date("F", mktime(0, 0, 0, $bulan, 1)) .'.pdf',array('Attachment'=>0));
    }
}
