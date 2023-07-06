@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Alterar Debitos</div>
  

                 <div class="card-body">
                      <form method="post" action="{{route('debit.update',['debits'=>$debits->id])}}">
                      @csrf
                      @method('PUT')
                      <input type="hidden" class="form-control" name="debtor_id" value="{{$debits->debtor_id}}">
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Devedor</label>
                        <select name='debtor_id' class="form-control" disabled>
                          <option selected>{{$debits->debtor->name}}</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Selecione a Situação</label>
                        <select name='situation_id' class="form-control">
                          <option selected>Selecione</option>
                         @foreach($situation as $key)
                            <option value="{{ $key->id}}" {{$key->id == $debits->situation_id ? 'selected' : ''}}>{{ $key->status}}</option>
                          @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Valor</label>
                        <input type="number" class="form-control" name="value" value="{{ $debits->value}}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Vencimento</label>
                        <input type="date" class="form-control" name="due" value="{{$debits->due}}">
                    </div>
                    <button type="submit" class="btn btn-primary">Alterar</button>
                    </form>
                     </div>
                </div>
            </div>

     </div>
 @endsection
