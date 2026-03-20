<x-gestione-layout>

    <!-- component -->
    <div class="w-full bg-white px-6 py-8 rounded ">
        <x-header.header title="Utenti" urlCerca="" nomeBtnNuovo="Lista Utenti" urlNuovo="{{route('gestioneutenti')}}">
        </x-header.header>
        <div class="bg-gray-100 rounded shadow-lg p-4">
            <x-header.subheader title="Modifica permessi utente" urlCerca="" nomeBtnNuovo="Nuovo Utente" urlNuovo="">
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
            <x-forms.modify-user-permissions :user="$user" :permessiNO="$permessiNO"
                                             :permessiSI="$permessiSI"></x-forms.modify-user-permissions>
            <div class="flex flex-row px-2">
                <div class="w-10/12 text-xl text-center text-gray-900 font-bold mt-5 py-2 px-2 border rounded bg-gray-200">
                    Permessi assegnati via Ruolo a {{$user['name']}} {{$user['surname']}}</div>
                <div class="w-2/12"></div>
            </div>
            <div class="flex flex-row px-2">
                <div class="w-10/12">
                <x-table.table :intestazioni="[['NomCol'=>'Ruolo assunto','LarghCol'=>'w-6/12'],
        ['NomCol'=>'Permessi assegnati','LarghCol'=>'w-6/12']]" idTable="PermTable"
                               class="border">
{{--                    {{dd($userRoles)}}--}}
                @if (count($userRoles)>0)
                    @foreach($userRoles as $userRole)
                    <tr class="border-b">
                        <x-table.td class="border bg-white text-left text-md font-semibold ">{{$userRole['id']}} - {{$userRole['name']}}</x-table.td>
                        <x-table.td class="bg-white text-left text-md font-semibold">
                            @foreach($userRole['permViaRole'] as $item) {{$item['id']}} - {{$item['name']}} </br> @endforeach
                        </x-table.td>
                        </td>
                    </tr>

                @endforeach
                    @else
                        <x-table.td class="border bg-white text-left text-md font-semibold ">&nbsp;</x-table.td>
                        <x-table.td class="bg-white text-left text-md font-semibold"></x-table.td>
                    @endif
                </x-table.table>
                <div></div></div>
            </div>
        </div>
    </div>
    </div>
    </div>
    @vite([
    'resources/js/setPerPages.js',
    'resources/js/setPermissions.js'])
{{--    <script src="/js/setPerPages.js"></script>--}}
{{--    <script src="/js/setPermissions.js"></script>--}}
</x-gestione-layout>
