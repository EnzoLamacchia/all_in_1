<x-gestione-layout>

    <!-- component -->
    <div class="w-full bg-white px-6 py-8 rounded ">
        <x-header.header title="Stato Utenti" urlCerca="" nomeBtnNuovo="Lista Stati" urlNuovo="{{route('statiutente')}}">
        </x-header.header>
        <div class="bg-gray-100 rounded shadow-lg p-4">
        <x-header.subheader title="Creazione nuovo stato utente" urlCerca="" nomeBtnNuovo="Nuovo Stato" urlNuovo="{{route('creastato')}}">
        </x-header.subheader>

        <x-forms.newstato></x-forms.newstato>
        </div>
    </div>

</x-gestione-layout>
