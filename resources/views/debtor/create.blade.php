@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Adicionar Devedor</div>
  
                <div class="card-body">
                      <form method="post" action="{{route('debtor.store')}}">
                      @csrf
                    <div class="form-group">
                    <input type="hidden" name="user_id" value="{{ auth()->user()->id}}">
                    <label class="form-label">Nome</label>
                    <input type="text" class="form-control" name="name">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" name="email">
                    </div>
                    <button type="submit" class="btn btn-primary">Cadastrar</button>
                    </form>
                     </div>
                </div>
            </div>
     </div>
 @endsection
