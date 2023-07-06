@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Adicionar Conta</div>
  
                <div class="card-body">
                      <form method="post" action="{{route('bill.store')}}">
                      @csrf
                      <input type="hidden" class="form-control" name="user_id" value="{{auth()->user()->id}}">
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Selecione a Situação</label>
                        <select name='situation_id' class="form-control">
                          <option selected>Selecione</option>
                         @foreach($situation as $key)
                            <option value="{{ $key->id}}">{{ $key->status}}</option>
                          @endforeach
                        </select>
                    </div>
                       <div class="mb-3">
                        <label class="form-label">Origem</label>
                        <input type="text" class="form-control" name="origin">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Valor</label>
                        <input type="number" step="any" class="form-control" name="value">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Vencimento</label>
                        <div class="input-group w-50 col-md-2">
                        <span class="input-group-text" id="basic-addon1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar" viewBox="0 0 16 16">
                   <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"></path>
                    </svg>
              </span>
              <input type="date" class="form-control" name="due">
              </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Periodo</label>
                        <input type="number" class="form-control" name="ano" placeholder="Informe o ano"><br>
                        <select name='mes' class="form-control">
                        <option selected>Mês</option>
                           @foreach($mes as $key=>$valor)
                            <option value="{{ $key}}">{{$valor}}</option>
                          @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Cadastrar</button>
                    </form>
                     </div>
                </div>
            </div>
     </div>
 @endsection
