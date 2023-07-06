@extends('layouts.app')

@section('content')



<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
               <form  method="post" action=" {{ route('bill.pesquisar')}}">   
                             @csrf
               <div class="card-header">
                    <div class="row">
                        <div class="col-6 tamanho" >
                            Contas
                        </div>
                        <div class="col-6">
                          <div class="float-end input-group mb-2 float-start">
                            <a href="{{ route('bill.create') }}" class="mr-3 btn btn-success">Novo</a>
                            <button class="btn btn-outline-secondary " type="submit" >
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                            </svg>
                            </button>
                                <select name='mes' class="form-select">
                                   <option selected>Mês</option>
                                    @foreach($mes as $key=>$valor)
                                        <option value="{{ $key}}">{{$valor}}</option>
                                    @endforeach
                                </select>
                                   <input type="number" name="ano" class="form-control" placeholder="Ano" >
                                   
                         </div>  
                               
                    </div>
                </div>
                 </form>
                <div class="card-body">
                    <table class="table ">
                    <?php date_default_timezone_set('America/Sao_Paulo'); ?>
                        <thead>
                                <tr>
                                <th scope="col">Origem</th>
                                <th scope="col">Valor</th>
                                <th scope="col">Situação</th>
                                <th scope="col">Periodo</th>
                                <th scope="col">Vencido</th>
                                <th scope="col">Vencimento</th>
                                <th scope="col">Ação</th>
                              
                                </tr>
                            </thead>
                       <tbody>
                                @foreach($bill as $key)
                                  <form id="form_{{ $key->id}}" method="post" action=" {{ route('bill.destroy', ['bill' => $key->id])}}">
                                    @method('DELETE')
                                    @csrf
                                </form>
                                    <tr>
                                    <th scope="row">{{$key->origin}}</th>
                                  <td>R$ {{$key->value}}</td>
                                    @if($key->situation->id == 1)                               
                                    <td class="vermelho">{{$key->situation->status}}</td>
                                    @else
                                     <td class="verde">{{$key->situation->status}}</td>
                                     @endif 
                                     <td>{{$key->mes}}/{{$key->ano}} </td>  
                                    @if(strtotime($key->due) < strtotime(today())) 
                                     <td class="vermelho">SIM</td>
                                    @elseif(strtotime($key->due) >= strtotime(today())) 
                                    <td class="verde">NÃO</td>
                                    @endif
                                            
                                    <td>{{ date('d/m/Y', strtotime($key->due)) }}</td>
                                    <th><a class="btn btn-success" href="{{ route('bill.edit', $key->id)}}">Editar</a>
                                    <a class="btn btn-primary" href="{{ route('bill.quitar', $key->id)}}">Quitar</a>
                                    <a href="#" class="btn btn-danger" onclick="document.getElementById('form_{{ $key->id}}').submit()">Excluir</a>
                                    </th>
                                    </tr>
                                 
                                </tbody>
                                
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
