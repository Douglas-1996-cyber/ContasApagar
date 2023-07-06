@extends('layouts.app')

@section('content')



<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
               
               <div class="card-header">
                    <div class="row">
                        <div class="col-6 tamanho" >
                            Contas dos Devedores
                        </div>
                        <div class="col-6">
                            <div class="float-end">
                            <a href="{{ route('debit.create') }}" class="mr-3 btn btn-success">Novo</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table ">
                    <?php date_default_timezone_set('America/Sao_Paulo'); ?>
                        <thead>
                                <tr>
                                <th scope="col">Nome</th>
                                <th scope="col">Valor</th>
                                <th scope="col">Situação</th>
                                <th scope="col">Vencido</th>
                                <th scope="col">Vencimento</th>
                                <th scope="col">Ação</th>
                              
                                </tr>
                            </thead>
                       <tbody>
                                @foreach($debtors as $debtor)
                                @foreach($debtor->debits as $key )
                                  <form id="form_{{ $key->id}}" method="post" action=" {{ route('debit.destroy', ['debits' => $key->id])}}">
                                    @method('DELETE')
                                    @csrf
                                </form>
                                    <tr>
                                    <th scope="row">{{$debtor->name}}</th>
                                  <td>R$ {{$key->value}}</td>
                                    @if($key->situation->id == 1)                               
                                    <td class="vermelho">{{$key->situation->status}}</td>
                                    @else
                                     <td class="verde">{{$key->situation->status}}</td>
                                     @endif   
                                    @if(strtotime($key->due) < strtotime(today())) 
                                     <td class="vermelho">SIM</td>
                                    @elseif(strtotime($key->due) >= strtotime(today())) 
                                    <td class="verde">NÃO</td>
                                    @endif
                                            
                                    <td>{{ date('d/m/Y', strtotime($key->due)) }}</td>
                                    <th><a class="btn btn-success" href="{{ route('debit.edit', $key->id)}}">Editar</a>
                                    <a href="#" class="btn btn-danger" onclick="document.getElementById('form_{{ $key->id}}').submit()">Excluir</a>
                                    </th>
                                    </tr>
                                 
                                </tbody>
                                @endforeach
                                @endforeach
                              
                        </table>
                            <div class="col-6 vermelho">
                            {{$invalid}}
                            </div> 
                           
                 </div>
                </div>
            </div>
     </div>
 @endsection
