<?php

namespace App\Http\Controllers;

use App\Models\Debtor;
use App\Models\Debits;
use Illuminate\Http\Request;


class DebtorController extends Controller
{
    /*public function __construct(){
       $this->middleware('auth');
    }*/
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
       $debtor = Debtor::where('user_id', auth()->user()->id)->get();
        return view('debtor.index', ['debtor' => $debtor, 'invalid'=>'']);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('debtor.create');
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        $debtor = new Debtor();
        $debtor->create($request->all());
        $debtor = Debtor::where('user_id', auth()->user()->id)->get();
        return redirect()->route('debtor.index', ['debtor' => $debtor, 'invalid'=>'']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Debtor  $debtor
     * @return \Illuminate\Http\Response
     */
    public function show(Debtor $debtor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Debtor  $debtor
     * @return \Illuminate\Http\Response
     */
    public function edit(Debtor $debtor)
    {
       
        return view('debtor.edit',['debtor' => $debtor]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Debtor  $debtor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Debtor $debtor)
    {
        $debtor->update($request->all());
        $debtor = Debtor::where('user_id', auth()->user()->id)->get();
        return view('debtor.index', ['debtor' => $debtor,'invalid'=>'']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Debtor  $debtor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Debtor $debtor)
    {
       $debtor_id = $debtor->id;
       $debits_situation = Debits::where('debtor_id', $debtor_id)->where('situation_id',1)->get();
        if(count($debits_situation) != 0 ){
            $invalid = "* $debtor->name com saldo pendente";
            $debtor = Debtor::where('user_id', auth()->user()->id)->get();
          return view('debtor.index', ['debtor' => $debtor, 'invalid'=>$invalid]);
        }else{
            $debits = Debits::where('debtor_id', $debtor_id)->delete();
            $debtor->delete();
            return $this->redirecionar('');
        }
    
    }

    public function redirecionar($invalid){
        $debtor = Debtor::where('user_id', auth()->user()->id)->get();
        return redirect()->route('debtor.index', ['debtor' => $debtor, 'invalid'=>$invalid]);
    }
}
