@extends('layouts.app2')

@section('content')
    <div class="container">
        <h2>Modifica Record</h2>
        <form action="{{ route('excel-import.tables.update', ['tableName' => $tableName, 'id' => $id]) }}" method="POST">
            @csrf
            @method('PUT')
            @foreach($columns as $column)
                @if(!in_array($column, ['id', 'created_at', 'updated_at']))
                    <div class="form-group">
                        <label for="{{ $column }}">{{ $column }}</label>
                        <input type="text" class="form-control" id="{{ $column }}" name="{{ $column }}" value="{{ $record->$column }}">
                    </div>
                @endif
            @endforeach
            <button type="submit" class="btn btn-primary">Aggiorna</button>
        </form>
    </div>
@endsection
