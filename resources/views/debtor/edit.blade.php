@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Alterar Devedor</div>
  
                <div class="card-body">
                      <form method="post" action="{{route('debtor.update',['debtor'=>$debtor->id])}}">
                      @csrf
                      @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">Nome</label>
                        <input type="text" class="form-control" name="name" value="{{ $debtor->name}}">
                    </div>
                      <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" value="{{ $debtor->email}}">
                    </div>
                    <button type="submit" class="btn btn-primary">Alterar</button>
                    </form>
                     </div>
                </div>
            </div>
     </div>
 @endsection
