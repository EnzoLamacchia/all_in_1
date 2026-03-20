@extends('layouts.app2')

@section('content')
    <div class="container">
        <h2>Importa Excel</h2>
        <form action="{{ route('excelimport.import') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="excel_file">Seleziona file Excel:</label>
                <input type="file" name="excel_file" class="form-control-file" id="excel_file" required>
            </div>
            <button type="submit" type="button" class="relative -ml-px inline-flex items-center bg-white px-3 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-10">Importa</button>
        </form>
    </div>
@endsection

