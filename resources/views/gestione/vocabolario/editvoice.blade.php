<x-gestione-layout>

    <!-- component -->
    <div class="w-full bg-white px-6 py-8 rounded ">
        <x-header.header title="Voce vocabolario" urlCerca="" nomeBtnNuovo="Lista Vocabolari" urlNuovo="{{route('vocabolari')}}">
        </x-header.header>
        <div class="bg-gray-100 rounded shadow-lg p-4">
        <x-header.subheader title="Modifica voce del vocabolario '{{$voice->vocabulary['name']}}'" urlCerca="" nomeBtnNuovo=""
                            urlNuovo="">
        </x-header.subheader>

        <x-forms.modify-voice :voice="$voice"></x-forms.modify-voice>
        </div>
    </div>

</x-gestione-layout>
