<?php

namespace App\Http\Controllers;

use App\Models\Debits;
use App\Models\Situation;
use App\Models\Debtor;
use App\Models\User;
use Illuminate\Http\Request;

class DebitsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $user_id = auth()->user()->id;
         $d = Debtor::with('Debits')->where('user_id', $user_id)->get();
        return view('debit.index', ['debtors' => $d, 'invalid'=>'']);
       

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { 
       $debtor  = Debtor::where('user_id', auth()->user()->id)->get();
       return view('debit.create', ['debtor' => $debtor, 'invalid'=>'']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $debit = new Debits();
        $debit->create($request->all());
        $user_id = auth()->user()->id;
        $d = Debtor::with('Debits')->where('user_id', $user_id)->get();
        return redirect()->route('debit.index', ['debtors' => $d,'invalid'=>'']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Debits  $debits
     * @return \Illuminate\Http\Response
     */
    public function show(Debits $debits)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Debits  $debits
     * @return \Illuminate\Http\Response
     */
    public function edit(Debits $debits)
    {
       $situation = Situation::all();
       return view('debit.edit', ['debits'=>$debits, 'situation'=>$situation,]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Debits  $debits
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Debits $debits)
    {
        $debits->update($request->all());
        $user_id = auth()->user()->id;
        $d = Debtor::with('Debits')->where('user_id', $user_id)->get();
        return redirect()->route('debit.index', ['debtors' => $d, 'invalid'=>'']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Debits  $debits
     * @return \Illuminate\Http\Response
     */
    public function destroy(Debits $debits)
    {
        $user_id = auth()->user()->id;
        $d = Debtor::with('Debits')->where('user_id', $user_id)->get();
        if($debits->situation_id == 1){
        $invalid= "*Debito consta em aberto!";
        return view('debit.index', ['debtors' => $d, 'invalid'=>$invalid]); 
        }else{
            $debits->delete();
            return view('debit.index', ['debtors' => $d, 'invalid'=>'']); 
        }

    }
}
