<x-gestione-layout>
    <div class="w-full bg-white px-6 py-8 rounded-md ">
        <x-header.header title="Ruoli" urlCerca="#" nomeBtnNuovo="Nuovo Ruolo" urlNuovo="{{route('crearuolo')}}">
        </x-header.header>
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
        <x-table.table :intestazioni="[['NomCol'=>'ID','LarghCol'=>'w-1/12'],
        ['NomCol'=>'Ruolo','LarghCol'=>'w-3/12'],['NomCol'=>'Descrizione','LarghCol'=>'w-5/12'],
        ['NomCol'=>'','LarghCol'=>'w-3/12']]" idTable="roleTable">
            @foreach ($roles as $role)
                <tr class="border-b">
                    <x-table.td class="font-medium">{{$role->id}}</x-table.td>
                    <x-table.td class="font-bold">{{$role->name}}</x-table.td>
                    <x-table.td class="font-medium">{{$role->description}}</x-table.td>
                    <x-table.td class="text-right">
                        <x-table.button class="bg-green-500 hover:bg-green-600" href="{{route('editruolo', ['id'=> $role->id])}}">
                            <svg  class="h-6 w-6 text-white" width="24"  height="24"  viewBox="0 0 24 24"  xmlns="http://www.w3.org/2000/svg"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">
                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z" />
                            </svg>
                        </x-table.button>
                        <x-table.button class="bg-red-500 hover:bg-red-600" title="delete">
                            <svg class="h-6 w-6 text-white"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  <path stroke="none" d="M0 0h24v24H0z"/>  <line x1="4" y1="7" x2="20" y2="7" />  <line x1="10" y1="11" x2="10" y2="17" />  <line x1="14" y1="11" x2="14" y2="17" />  <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />  <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                        </x-table.button>
                        <x-table.button class="bg-yellow-500 hover:bg-yellow-600" href="{{route('utenti2ruolo',['id'=> $role->id])}}">
                            <svg class="h-6 w-6 text-white"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  <path stroke="none" d="M0 0h24v24H0z"/>  <circle cx="9" cy="7" r="4" />  <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />  <path d="M16 11l2 2l4 -4" /></svg>
                        </x-table.button>
                        <x-table.button class="bg-gray-500 hover:bg-gray-600" href="{{route('permessi2ruolo',['id'=> $role->id])}}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path style="text-indent:0;text-align:start;line-height:normal;text-transform:none;block-progression:tb;marker:none;-inkscape-font-specification:Sans" fill="#fff" d="M13.219 1a.5.5 0 0 0-.344.5v2.594c-1.079.28-2.098.723-3.063 1.281L7.97 3.531a.5.5 0 0 0-.719 0L3.531 7.25a.5.5 0 0 0 0 .688L5.375 9.78a12.407 12.407 0 0 0-1.25 3.063H1.5a.5.5 0 0 0-.5.5v5.281a.5.5 0 0 0 .5.5h2.625c.278 1.06.703 2.081 1.25 3.031l-1.844 1.875a.5.5 0 0 0 0 .688l3.719 3.75a.5.5 0 0 0 .719 0l1.843-1.875c.963.56 1.985.997 3.063 1.281V30.5a.5.5 0 0 0 .5.5h5.25a.5.5 0 0 0 .5-.5v-2.625a12.303 12.303 0 0 0 3.063-1.281l1.843 1.875a.5.5 0 0 0 .719 0l3.719-3.75a.5.5 0 0 0 0-.688l-1.844-1.843c.56-.963.967-1.986 1.25-3.063H30.5a.5.5 0 0 0 .5-.5v-5.281a.5.5 0 0 0-.5-.5h-2.625a12.4 12.4 0 0 0-1.25-3.031l1.844-1.876a.5.5 0 0 0 0-.687L24.75 3.531a.5.5 0 0 0-.719 0l-1.843 1.844a12.306 12.306 0 0 0-3.063-1.281V1.5a.5.5 0 0 0-.5-.5h-5.25a.5.5 0 0 0-.156 0zm.656 1h4.25v2.438a.5.5 0 0 0 .406.468c1.242.283 2.421.792 3.5 1.469a.5.5 0 0 0 .625-.063l1.719-1.75 3.031 3.032-1.718 1.718a.5.5 0 0 0-.063.626 11.43 11.43 0 0 1 1.438 3.53.5.5 0 0 0 .5.376H30v4.281h-2.438a.5.5 0 0 0-.5.375 11.435 11.435 0 0 1-1.437 3.531.5.5 0 0 0 .063.625l1.718 1.719-3.031 3.031-1.719-1.718a.5.5 0 0 0-.593-.094 11.502 11.502 0 0 1-3.532 1.468.5.5 0 0 0-.406.47V30h-4.25v-2.469a.5.5 0 0 0-.406-.468 11.337 11.337 0 0 1-3.5-1.47.5.5 0 0 0-.625.063l-1.719 1.719-3.031-3 1.718-1.719a.5.5 0 0 0 .063-.625A11.43 11.43 0 0 1 4.937 18.5a.5.5 0 0 0-.5-.375H2v-4.281h2.438a.5.5 0 0 0 .5-.375c.283-1.243.76-2.452 1.437-3.531a.5.5 0 0 0-.063-.626L4.595 7.595l3.031-3.032 1.719 1.75a.5.5 0 0 0 .594.063 11.431 11.431 0 0 1 3.53-1.438.5.5 0 0 0 .407-.5V2zm1.969 6a.5.5 0 0 0-.031.031c-1.772.656-4.51 1.75-6.813 1.75a.5.5 0 0 0-.5.5c0 8.54 3.644 12.467 7.25 14.625a.5.5 0 0 0 .5 0c3.567-2.135 7.25-6.107 7.25-14.625a.5.5 0 0 0-.5-.5c-3.055 0-5.234-1.144-6.813-1.75A.5.5 0 0 0 15.845 8zM16 9.031c1.38.548 3.573 1.521 6.469 1.656-.122 7.703-3.252 11.186-6.469 13.188-3.256-2.023-6.349-5.461-6.469-13.188C11.912 10.55 14.376 9.64 16 9.031zm1.719 5.406-2.407 2.313-1.03-1-.688.719 1.375 1.312.344.313.343-.313 2.75-2.593-.687-.75z" class="color000 svgShape" color="#000" enable-background="accumulate" font-family="Sans" font-weight="400" overflow="visible"/></svg>
                        </x-table.button>
                        </x-table.td>
                </tr>
            @endforeach
                <tr id="paginazione">
                    <td colspan="7">
                        <div class="d-flex justify-content-center pt-2">
                            {{$roles->links('vendor.pagination.tailwind')}}
                        </div>
                    </td>
                </tr>
        </x-table.table>
    </div>
    @vite([
    'resources/js/sweet-alert.js',
    'resources/js/setPerPages.js',
    'resources/css/sweet-alert.css',
    'resources/js/delRole.js'])
{{--    <script src="/js/sweet-alert.js"></script>--}}
{{--    <link rel="stylesheet" href="/css/sweet-alert.css">--}}
{{--    <script src="/js/setPerPages.js"></script>--}}
{{--    <script src="/js/delRole.js"></script>--}}
</x-gestione-layout>
