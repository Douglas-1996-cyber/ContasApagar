<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Situation;
use Illuminate\Http\Request;

class BillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mes = $this->mes();
        
        $user_id = auth()->user()->id;
        $bill = Bill::where('user_id', $user_id)->get();
        return view('bill.index', ['bill'=>$bill,'invalid'=>'', 'mes'=>$mes]);
    }

    public function principal($invalid)
    {
        $mes = $this->mes();
        
        $user_id = auth()->user()->id;
        $bill = Bill::where('user_id', $user_id)->get();
        return view('bill.index', ['bill'=>$bill,'invalid'=>$invalid, 'mes'=>$mes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $situation = Situation::all();
        $mes = $this->mes();
        return view('bill.create',['situation' => $situation,'invalid'=>'','mes'=>$mes]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $debit = new Bill();
        $debit->create($request->all());
        return redirect()->route('bill.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bill  $bill
     * @return \Illuminate\Http\Response
     */
    public function show(Bill $bill)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bill  $bill
     * @return \Illuminate\Http\Response
     */
    public function edit(Bill $bill)
    {
        $mes = $this->mes();
        $situation = Situation::all();
        return view('bill.edit',['bill'=>$bill, 'situation'=>$situation,'mes'=>$mes]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bill  $bill
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bill $bill)
    {
        if($bill->user_id == $request->user_id){
            $bill->update($request->all());
        return redirect()->route('bill.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bill  $bill
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bill $bill)
    {
        if($bill->situation_id == 1){
            $invalid= "*Debito consta em aberto!";
            return $this->principal($invalid);
        }else if($bill->situation_id == 2){
        $bill->delete();
        return redirect()->route('bill.index'); 
         }
    }

    public function quitar(Bill $bill)
    {
        $mes = $this->mes();
        $user_id = auth()->user()->id;
        $invalid = '';
        if($bill->user_id == $user_id){
           
            if($bill->situation_id == 1)  {
                $bill->situation_id = 2;
                $bill->update();
                $bill = Bill::where('user_id', $user_id)->get();
                return view('bill.index', ['bill'=>$bill,'invalid'=>$invalid,'mes'=>$mes]);
            }else if($bill->situation_id == 2){
                $invalid = '*Debito já quitado';
               return $this->principal($invalid);
            }
        }else{
        $invalid = '*Usuario não permitido';
        return $this->principal($invalid);
        }
    }
  
    public function pesquisar(Request $request){
        $user_id = auth()->user()->id;
        $invalid = "Nenhum resultado encontrado";
        $mes = $this->mes();
        if($request->ano == null && $request->mes == 'Mês'){
            return $this->index();

        }
        else if($request->ano == null){

            $bill = Bill::where('mes', $request->mes)->where('user_id', $user_id)->get();
            if(sizeof($bill) == 0){
                return view('bill.index', ['bill'=>$bill,'invalid'=>$invalid, 'mes'=>$mes]);
            }else{
            return view('bill.index', ['bill'=>$bill,'invalid'=>'', 'mes'=>$mes]);
            }

        }
        else if($request->mes == 'Mês') {

        $bill = Bill::where('ano', $request->ano)->where('user_id', $user_id)->get();
        if(sizeof($bill) == 0){
            return view('bill.index', ['bill'=>$bill,'invalid'=>$invalid, 'mes'=>$mes]);
        }else{
        return view('bill.index', ['bill'=>$bill,'invalid'=>'', 'mes'=>$mes]);
        }

        } else{
            $bill = Bill::where('ano', $request->ano)->where('mes', $request->mes)->where('user_id', $user_id)->get();
            if(sizeof($bill) == 0){
                return view('bill.index', ['bill'=>$bill,'invalid'=>$invalid, 'mes'=>$mes]);
            }else{
            return view('bill.index', ['bill'=>$bill,'invalid'=>'', 'mes'=>$mes]);
            }
         }
        }
    public function mes(){
        $mes = [
            1 => 'Janeiro',
            2 => 'Fervereiro',
            3 => 'Março',
            4 => 'Abril',
            5 => 'Maio',
            6 => 'Junho',
            7 => 'Julho',
            8 => 'Agosto',
            9 => 'Setembro',
            10 => 'Outubro',
            11 => 'Novembro',
            12 => 'Dezembro'
        ];
        return $mes;
    }

}
