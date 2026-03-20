<x-gestione-layout>

    <!-- component -->
    <div class="w-full bg-white px-6 py-8 rounded ">
        <x-header.header title="Utenti" urlCerca="" nomeBtnNuovo="Lista Utenti" urlNuovo="{{route('gestioneutenti')}}">
        </x-header.header>
        <div class="bg-gray-100 rounded shadow-lg p-4">
        <x-header.subheader title="Creazione nuovo utente" urlCerca="" nomeBtnNuovo="Nuovo Utente" urlNuovo="{{route('creautente')}}">
        </x-header.subheader>

        <x-forms.newuser></x-forms.newuser>
        </div>
    </div>

</x-gestione-layout>
