@extends('layouts.app2')

@section('content')
<div class="container">
    <h2>Conferma sovrascrittura</h2>
    <p>Esiste già una tabella con la stessa struttura. Vuoi sovrascrivere i dati esistenti?</p>
    <form action="{{ route('excelimport.confirm-overwrite') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="table_name" value="{{ $tableName }}">
        <input type="hidden" name="schema" value="{{ json_encode($schema) }}">
        <input type="file" name="excel_file" style="display: none;">
        <button type="submit" class="btn btn-warning">Conferma sovrascrittura</button>
        <a href="{{ route('excelimport.form') }}" class="btn btn-secondary">Annulla</a>
    </form>
</div>
@endsection
