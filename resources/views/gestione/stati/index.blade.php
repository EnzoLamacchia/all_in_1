<x-gestione-layout>
    <div class="w-full bg-white px-6 py-8 rounded-md ">
        <x-header.header title="Stato Utenti" urlCerca="#" nomeBtnNuovo="Nuovo Stato" urlNuovo="{{route('creastato')}}">
        </x-header.header>
        <x-table.table :intestazioni="[['NomCol'=>'ID','LarghCol'=>'w-1/12'],
        ['NomCol'=>'Stato','LarghCol'=>'w-3/12'],['NomCol'=>'Descrizione','LarghCol'=>'w-6/12'],
        ['NomCol'=>'','LarghCol'=>'w-2/12']]" idTable="Table">
            @foreach ($stati as $stato)
                <tr class="border-b">
                    <x-table.td class="font-medium">{{$stato->id}}</x-table.td>
                    <x-table.td class="font-bold">{{$stato->user_status}}</x-table.td>
                    <x-table.td class="font-bold">{{$stato->description}}</x-table.td>
                    <x-table.td class="text-right">
                        <x-table.button class="bg-green-500 hover:bg-green-600" href="{{route('editstato',['id'=>$stato->id])}}">
                            <svg  class="h-6 w-6 text-white" width="24"  height="24"  viewBox="0 0 24 24"  xmlns="http://www.w3.org/2000/svg"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">
                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z" />
                            </svg>
                        </x-table.button>
                        <x-table.button class="bg-red-500 hover:bg-red-600"  title="delete" > {{--//href gestito via ajax in delUser.js--}}
                            <svg class="h-6 w-6 text-white"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  <path stroke="none" d="M0 0h24v24H0z"/>  <line x1="4" y1="7" x2="20" y2="7" />  <line x1="10" y1="11" x2="10" y2="17" />  <line x1="14" y1="11" x2="14" y2="17" />  <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />  <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                        </x-table.button>
                    </x-table.td>
                </tr>
            @endforeach
        </x-table.table>
    </div>
    @vite([
    'resources/js/sweet-alert.js',
    'resources/css/sweet-alert.css',
    'resources/js/manageTable.js'])
</x-gestione-layout>
