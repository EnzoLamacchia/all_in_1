<x-gestione-layout>

    <!-- component -->
    <div class="w-full bg-white px-6 py-8 rounded ">
        <x-header.header title="Ruoli" urlCerca="" nomeBtnNuovo="Lista Ruoli" urlNuovo="{{route('gestioneruoli')}}">
        </x-header.header>
        <div class="bg-gray-100 rounded shadow-lg p-4">
        <x-header.subheader title="Creazione nuovo ruolo" urlCerca="" nomeBtnNuovo="Nuovo Ruolo" urlNuovo="{{route('crearuolo')}}">
        </x-header.subheader>

        <x-forms.newrole></x-forms.newrole>
        </div>
    </div>

</x-gestione-layout>
