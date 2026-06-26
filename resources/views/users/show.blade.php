@extends('layouts.app')

@section('page-title')
    Visualizar Usuário
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $user->name }}</h5>
            <p class="card-text"><strong>Email:</strong> {{ $user->email }}</p>
        </div>
    </div>
@endsection
