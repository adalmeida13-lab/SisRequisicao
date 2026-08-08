@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Detalhes da Requisição de Serviço</h1>

        <div class="form-group">
            <label for="requester">Solicitante:</label>
            <input type="text" class="form-control" id="requester" name="requester" value="{{ $serviceRequest->requester }}" disabled>
        </div>

        <div class="form-group">
            <label for="department">Departamento:</label>
            <input type="text" class="form-control" id="department" name="department" value="{{ $serviceRequest->department->name }}" disabled>
        </div>

        <div class="form-group">
            <label for="request_date">Data de Solicitação:</label>
            <input type="text" class="form-control" id="request_date" name="request_date" value="{{ $serviceRequest->request_date }}" disabled>
        </div>

        <div class="form-group">
            <label for="status">Status:</label>
            <input type="text" class="form-control" id="status" name="status" value="{{ $serviceRequest->status }}" disabled>
        </div>

        <a href="{{ route('servicerequest.index') }}" class="btn btn-secondary">Voltar</a>
    </div>
@endsection 
