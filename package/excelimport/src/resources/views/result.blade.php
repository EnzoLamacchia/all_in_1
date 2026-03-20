@extends('layouts.app2')

@section('content')
    <div class="container">
        <h2>Risultati dell'importazione</h2>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <table class="table">
            <thead>
            <tr>
                @foreach($columns as $column)
                    <th>{{ $column }}</th>
                @endforeach
                <th>Azioni</th>
            </tr>
            </thead>
            <tbody>
            @foreach($importedData as $data)
                <tr>
                    @foreach($columns as $column)
                        <td>{{ $data->$column }}</td>
                    @endforeach
                    <td>
                        <a href="{{ route('excel-import.tables.edit', ['tableName' => $tableName, 'id' => $data->id]) }}" class="btn btn-sm btn-primary">Modifica</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection

