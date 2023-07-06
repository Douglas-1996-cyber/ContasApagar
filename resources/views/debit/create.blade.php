@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Adicionar Devedor</div>
  
                <div class="card-body">
                      <form method="post" action="{{route('debit.store')}}">
                      @csrf
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Selecione o Devedor</label>
                        <select name='debtor_id' class="form-control">
                          <option selected>Selecione</option>
                         @foreach($debtor as $key =>$t)
                            <option value="{{ $t->id}}">{{ $t->name}}</option>
                          @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Valor</label>
                        <input type="number" class="form-control" name="value">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Vencimento</label>
                        <input type="date" class="form-control" name="due">
                    </div>
                    <button type="submit" class="btn btn-primary">Cadastrar</button>
                    </form>
                     </div>
                </div>
            </div>
     </div>
 @endsection
