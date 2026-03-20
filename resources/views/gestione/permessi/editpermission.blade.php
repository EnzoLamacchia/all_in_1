<x-gestione-layout>

    <!-- component -->
    <div class="w-full bg-white px-6 py-8 rounded ">
        <x-header.header title="Permessi" urlCerca="" nomeBtnNuovo="Lista Permessi" urlNuovo="{{route('gestionepermessi')}}">
        </x-header.header>
        <div class="bg-gray-100 rounded shadow-lg p-4">
        <x-header.subheader title="Modifica permesso" urlCerca="" nomeBtnNuovo="Nuovo Permesso" urlNuovo="{{route('creapermesso')}}">
        </x-header.subheader>
{{--{{dd($stati)}}--}}
        <x-forms.modify-permission :permesso="$permesso"></x-forms.modify-permission>
        </div>
    </div>

</x-gestione-layout>
