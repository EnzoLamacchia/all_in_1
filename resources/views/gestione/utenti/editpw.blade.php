<x-gestione-layout>

    <!-- component -->
    <div class="w-full bg-white px-6 py-8 rounded ">
        <x-header.header title="Utenti" urlCerca="" nomeBtnNuovo="Lista Utenti" urlNuovo="{{route('gestioneutenti')}}">
        </x-header.header>
        <div class="bg-gray-100 rounded shadow-lg p-4">
        <x-header.subheader title="Cambia password utente: {{$user['name']}} {{$user['surname']}}" urlCerca="" nomeBtnNuovo="Nuovo Utente" urlNuovo="{{route('creautente')}}">
        </x-header.subheader>
{{--{{dd($stati)}}--}}
        <x-forms.modify-userpw :user="$user"></x-forms.modify-userpw>
        </div>
    </div>

</x-gestione-layout>
