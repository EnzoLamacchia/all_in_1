<x-gestione-layout>
    <div class="w-full bg-white px-6 py-8 rounded-md ">
        <x-header.header title="Permessi" urlCerca="{{route('gestioneruoli')}}" nomeBtnNuovo="Nuovo Permesso" urlNuovo="{{route('creapermesso')}}">
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
       ['NomCol'=>'Permesso','LarghCol'=>'w-3/12'],['NomCol'=>'Descrizione','LarghCol'=>'w-6/12'],
       ['NomCol'=>'','LarghCol'=>'w-2/12']]" idTable="permissionTable">
           @foreach ($permissions as $permission)
               <tr class="border-b">
                   <x-table.td class="font-medium">{{$permission->id}}</x-table.td>
                   <x-table.td class="font-bold">{{$permission->name}}</x-table.td>
                   <x-table.td class="font-medium">{{$permission->description}}</x-table.td>
                   <x-table.td class="text-right">
                       <x-table.button class="bg-green-500 hover:bg-green-600" href="{{route('editpermesso', ['id'=> $permission->id])}}">
                           <svg  class="h-6 w-6 text-white" width="24"  height="24"  viewBox="0 0 24 24"  xmlns="http://www.w3.org/2000/svg"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">
                               <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                               <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z" />
                           </svg>
                       </x-table.button>
{{--                       Cancella--}}
                       <x-table.button class="bg-red-500 hover:bg-red-600" title="delete">
                           <svg class="h-6 w-6 text-white"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  <path stroke="none" d="M0 0h24v24H0z"/>  <line x1="4" y1="7" x2="20" y2="7" />  <line x1="10" y1="11" x2="10" y2="17" />  <line x1="14" y1="11" x2="14" y2="17" />  <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />  <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                       </x-table.button>
{{--                       Assegna--}}
                       <x-table.button class="bg-yellow-500 hover:bg-yellow-600" href="{{route('utenti2permesso',['id'=> $permission->id])}}">
                           <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" stroke-width="2" viewBox="0 0 16 16"><path d="M6 .994c-1.653 0-3 1.347-3 3v2c0 .935.439 1.76 1.111 2.31a5.681 5.681 0 0 0-3.765 5.173c0 .261.238.5.5.5l10.312.03a5.56 5.56 0 0 1-1.406-1l-8.281-.03c.336-2.243 2.174-3.967 4.474-3.989.019 0 .036.006.055.006.05 0 .098-.013.148-.015.884.03 1.7.32 2.385.779a21.47 21.47 0 0 1-.031-1.156 6.704 6.704 0 0 0-.643-.274A2.983 2.983 0 0 0 9 5.994v-2c0-1.653-1.347-3-3-3zm0 1c1.117 0 2 .883 2 2v2c0 1.06-.799 1.898-1.834 1.983h-.008c-.09-.003-.18.004-.27.005A1.978 1.978 0 0 1 4 5.994v-2c0-1.117.883-2 2-2zm6.477 4.031-.278.21c-.857.646-1.856 1.287-2.742 1.353l-.463.033v.465c0 1.69.07 2.852.559 3.795.489.943 1.376 1.54 2.746 2.094l.195.078.192-.084c1.32-.57 2.21-1.078 2.722-2 .513-.922.604-2.105.604-3.992v-.43l-.424-.063c-1.045-.16-1.818-.63-2.818-1.271l-.293-.188zm.078 1.172c.753.475 1.53.846 2.418 1.07-.02 1.575-.117 2.638-.44 3.217-.325.585-.988.964-2.078 1.452-1.096-.472-1.696-.899-2.016-1.514-.31-.598-.38-1.623-.4-2.996.95-.214 1.8-.699 2.516-1.229z" color="#000" font-family="sans-serif" font-weight="400" overflow="visible" style="line-height:normal;text-indent:0;text-align:start;text-decoration-line:none;text-decoration-style:solid;text-decoration-color:#000;text-transform:none;block-progression:tb;white-space:normal;isolation:auto;mix-blend-mode:normal;solid-color:#000;solid-opacity:1" fill="#fff" class="color000 svgShape"/></svg>
                       </x-table.button>
                   </x-table.td>
               </tr>
           @endforeach
               <tr id="paginazione">
                   <td colspan="7">
                       <div class="d-flex justify-content-center pt-2">
                           {{$permissions->links('vendor.pagination.tailwind')}}
                       </div>
                   </td>
               </tr>
       </x-table.table>
    </div>
    @vite([
    'resources/js/sweet-alert.js',
    'resources/js/setPerPages.js',
    'resources/css/sweet-alert.css',
    'resources/js/delPermission.js'])
{{--    <script src="/js/sweet-alert.js"></script>--}}
{{--    <link rel="stylesheet" href="/css/sweet-alert.css">--}}
{{--    <script src="/js/setPerPages.js"></script>--}}
{{--    <script src="/js/delPermission.js"></script>--}}
</x-gestione-layout>

