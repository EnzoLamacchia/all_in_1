<x-gestione-layout>

    <!-- component -->
    <div class="w-full bg-white px-6 py-8 rounded ">
        <x-header.header title="Stati Utente" urlCerca="" nomeBtnNuovo="Lista Stati Utente" urlNuovo="{{route('statiutente')}}">
        </x-header.header>
        <div class="bg-gray-100 rounded shadow-lg p-4">
        <x-header.subheader title="Modifica Stato Utente" urlCerca="" nomeBtnNuovo="Nuovo Stato Utente" urlNuovo="{{route('creastato')}}">
        </x-header.subheader>
{{--{{dd($stati)}}--}}
        <x-forms.modify-stato :stato="$stato"></x-forms.modify-stato>
        </div>
    </div>

</x-gestione-layout>
