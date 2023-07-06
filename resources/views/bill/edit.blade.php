@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Alterar Conta</div>
  
                <div class="card-body">
                     <form method="post" action="{{route('bill.update',['bill'=>$bill->id])}}">
                      @csrf
                      @method('PUT')
                      <input type="hidden" class="form-control" name="user_id" value="{{auth()->user()->id}}">
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Selecione a Situação</label>
                          <select name='situation_id' class="form-control">
                          <option selected>Selecione</option>
                         @foreach($situation as $key)
                            <option value="{{ $key->id}}" {{$key->id == $bill->situation_id ? 'selected' : ''}}>{{ $key->status}}</option>
                          @endforeach
                        </select>
                    </div>
                       <div class="mb-3">
                        <label class="form-label">Origem</label>
                        <input type="text" class="form-control" name="origin" value="{{$bill->origin}}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Valor</label>
                        <input type="number" step="any"  class="form-control" name="value" value="{{$bill->value}}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Vencimento</label>
                        <input type="date" class="form-control" name="due" value="{{$bill->due}}">
                    </div>
                     <div class="mb-3">
                        <label class="form-label">Periodo</label>
                        <input type="number" class="form-control" name="ano" value="{{$bill->ano}}"><br>
                        <select name='mes' class="form-control">
                        <option selected>Mês</option>
                           @foreach($mes as $key=>$valor)
                            <option value="{{$key}}" {{$key == $bill->mes ? 'selected' : ''}} >{{ $valor}}</option>
                          @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Alterar</button>
                    </form>
                     </div>
                </div>
            </div>
     </div>
 @endsection
