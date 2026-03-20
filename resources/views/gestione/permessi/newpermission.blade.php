<x-gestione-layout>

    <!-- component -->
    <div class="w-full bg-white px-6 py-8 rounded ">
        <x-header.header title="Permessi" urlCerca="" nomeBtnNuovo="Lista Permessi" urlNuovo="{{route('gestionepermessi')}}">
        </x-header.header>
        <div class="bg-gray-100 rounded shadow-lg p-4">
        <x-header.subheader title="Creazione nuovo permesso" urlCerca="" nomeBtnNuovo="Nuovo permesso" urlNuovo="{{route('creapermesso')}}">
        </x-header.subheader>

        <x-forms.newpermission></x-forms.newpermission>
        </div>
    </div>

</x-gestione-layout>
