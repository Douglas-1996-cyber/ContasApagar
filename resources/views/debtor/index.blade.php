@extends('layouts.app')

@section('content')



<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
               
               <div class="card-header">
                    <div class="row">
                        <div class="col-6 tamanho" >
                            Devedores
                        </div>
                        <div class="col-6">
                            <div class="float-end">
                            <a href="{{ route('debtor.create') }}" class="mr-3 btn btn-success">Novo</a>
                        </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table ">
                
                        <thead>
                                <tr>
                                <th scope="col">Nome</th>
                                <th scope="col">Email</th>
                                <th scope="col">Ação</th>
                              
                                </tr>
                               
                            </thead>
                                <tbody>
                                
                                @foreach($debtor as $key =>$t)
                                  <form id="form_{{ $t['id']}}" method="post" action=" {{ route('debtor.destroy', ['debtor' => $t['id']])}}">
                                    @method('DELETE')
                                    @csrf
                                </form>
                                    <tr>
                                    <th scope="row">{{$t->name}}</th>  
                                    <td>{{$t->email}}</td>
                                    <th><a class="btn btn-success" href="{{ route('debtor.edit', $t['id'])}}">Editar</a>
                                    <a href="#" class="btn btn-danger" onclick="document.getElementById('form_{{ $t['id']}}').submit()">Excluir</a>
                                    
                                    </th>
                                    </tr>
                                       <div class="col-6">
                        </div> 
                                @endforeach
                                </tbody>
                                   
                        </table>
                      <div class="vermelho"> 
                       {{$invalid}}
                      <div>   
                 </div>
                </div>
            </div>
     </div>
 @endsection
