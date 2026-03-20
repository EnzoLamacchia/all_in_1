<x-gestione-layout>

    <!-- component -->
    <div class="w-full bg-white px-6 py-8 rounded ">
        <x-header.header title="Utenti" urlCerca="" nomeBtnNuovo="Lista Utenti" urlNuovo="{{route('gestioneutenti')}}">
        </x-header.header>
        <div class="bg-gray-100 rounded shadow-lg p-4">
        <x-header.subheader title="Modifica ruoli utente" urlCerca="" nomeBtnNuovo="Nuovo Utente" urlNuovo="">
        </x-header.subheader>
            <div class="div bg-grey text-left py-2" id="perPage">risultati per pagina:
                <a class="@if (Session::get('perPage') == 5) bg-indigo-600 text-white @else bg-white text-dark @endif
                    w-8 h-8 p-2 border border-indigo-700 rounded cursor-pointer hover:bg-indigo-300">5</a>
                <a class="@if (Session::get('perPage') == 10) bg-indigo-600 text-white @else bg-white text-dark @endif
                    w-8 h-8 p-2 border border-indigo-700 rounded cursor-pointer hover:bg-indigo-300">10</a>
                <a class="@if (Session::get('perPage') == 15) bg-indigo-600 text-white @else bg-white text-dark @endif
                    w-8 h-8 p-2 border border-indigo-700 rounded cursor-pointer hover:bg-indigo-300">15</a>
                <a class="@if (Session::get('perPage') == 20) bg-indigo-600 text-white @else bg-white text-dark @endif
                    w-8 h-8 p-2 border border-indigo-700 rounded cursor-pointer hover:bg-indigo-300">20</a>
                <a class="@if (Session::get('perPage') == 25) bg-indigo-600 text-white @else bg-white text-dark @endif
                    w-8 h-8 p-2 border border-indigo-700 rounded cursor-pointer hover:bg-indigo-300">25</a>
            </div>
        <input hidden id="userid" value="{{$user['id']}}">
        <x-forms.modify-user-roles :user="$user" :ruoli="$ruoli" :userroles="$useroles"></x-forms.modify-user-roles>
        </div>
    </div>
    @vite([
    'resources/js/setPerPages.js',
    'resources/js/setRoles.js'])
{{--    <script src="/js/setPerPages.js"></script>--}}
{{--    <script src="/js/setRoles.js"></script>--}}
</x-gestione-layout>
