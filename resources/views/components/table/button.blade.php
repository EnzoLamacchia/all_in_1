{{-- recupero la varibile 'padxcerca' passata al componente button dal padre (componente header) --}}
{{-- occorrerà a stabilire il valore del padding orizzontale da utilizzare per il componente button --}}
@props(['padxcerca'=>'2'])

{{-- assegno la classe px-2 o px-4 alla variabile $padButtonX --}}
{{-- in funzione del valore passato alla variabile 'padxcerca' --}}
@php
    #  forma contratta dell' if-then-else'
           $padButtonX = [
                '2' => 'px-2',
                '4' => 'px-4'
            ][$padxcerca] ?? 'px-2';
@endphp

<a {{$attributes->merge(['class'=>"py-2 rounded-md text-white tracking-normal cursor-pointer ". $padButtonX ,'type'=>'button', 'passato'=>$padxcerca])}}>
    {{ $slot }}
</a>
