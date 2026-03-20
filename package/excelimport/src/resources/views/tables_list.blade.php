@extends('layouts.app2')

@section('content')
    <div class="container">
        <h2>Tabelle importate</h2>
        <table class="table">
            <thead>
            <tr>
                <th>Nome Tabella</th>
                <th>Data Creazione</th>
                <th>Azioni</th>
            </tr>
            </thead>
            <tbody>
            @foreach($tables as $table)
                <tr>
                    <td>{{ $table->table_name }}</td>
                    <td>{{ $table->created_at }}</td>
                    <td>
                        <a href="{{ route('excel-import.result', ['table' => $table->table_name]) }}" class="btn btn-sm btn-info">Visualizza</a>
                        <form action="{{ route('excel-import.tables.destroy', $table->table_name) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Sei sicuro di voler eliminare questa tabella?')">Elimina</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
