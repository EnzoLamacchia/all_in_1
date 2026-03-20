<main class="p-2 text-center">
    <div class="flex flex-row">
        <div class="w-10/12">
            <div class="bg-white p-3 rounded-lg shadow-lg w full" >
                <div class="flex flex-row">
                    <div class="w-full mx-2 py-2 text-center text-xl text-center text-gray-900 font-bold rounded border bg-gray-200">
                            {{$ruolo['name']}}
                    </div>
                </div>
                <div class="flex flex-row" id="ruoli">
                    <div class="w-6/12 px-2">
                        <x-table.table :intestazioni="[['NomCol'=>'ID','LarghCol'=>'w-1/12'],
        ['NomCol'=>'Utenti disponibili','LarghCol'=>'w-9/12'],['NomCol'=>'','LarghCol'=>'w-2/12']]" idTable="sxTable"
                                       class="border">
                            @foreach ($usersWithout as $userNO)
                                <tr class="border-b">
                                    <x-table.td class="text-left font-medium">{{$userNO['id']}}</x-table.td>
                                    <x-table.td
                                        class="text-left font-medium">{{$userNO['name']}} {{$userNO['surname']}}</x-table.td>
                                    <x-table.td class="text-right">
                                        <x-table.button class="bg-green-500 hover:bg-green-600" title="assegna"
                                                        action="setuser2role"
                                                        href="{{route('assegnautenti2ruolo',['uid'=>$userNO->id, 'rid'=>$ruolo->id])}}"> {{--//href gestito via ajax in delUser.js--}}
                                            <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24"
                                                 stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                                            </svg>
                                        </x-table.button>
                                    </x-table.td>
                                </tr>
                            @endforeach
                        </x-table.table>

                    </div>
                    <div class="w-6/12 px-2">
                        <x-table.table :intestazioni="[['NomCol'=>'ID','LarghCol'=>'w-2/12'],
        ['NomCol'=>'Utenti assegnati','LarghCol'=>'w-8/12'],['NomCol'=>'','LarghCol'=>'w-2/12']]" idTable="dxTable"
                                       class="border">
                            @foreach ($usersWithActualRole as $userYES)
                                <tr class="border-b">
                                    <x-table.td class="text-left font-medium">{{$userYES->id}}</x-table.td>
                                    <x-table.td
                                        class="text-left font-medium">{{$userYES->name}} {{$userYES->surname}}</x-table.td>
                                    <x-table.td class="text-right">
                                        <x-table.button class="bg-red-500 hover:bg-red-600" title="rimuovi"
                                                        action="deluserfromrole"
                                                        href="{{route('rimuoviutentidaruolo',['uid'=>$userYES->id, 'rid'=>$ruolo->id])}}"> {{--//href gestito via ajax in delUser.js--}}
                                            <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24"
                                                 stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                                            </svg>
                                        </x-table.button>
                                    </x-table.td>
                                </tr>
                            @endforeach
                        </x-table.table>

                    </div>
                </div>
                <div class="flex flex-row">
                    <div class="w-6/12 px-2">
                        {{ $usersWithout->appends(['uYes'=>$usersWithActualRole->currentPage()])->links() }}
                    </div>
                    <div class="w-6/12 px-2">
                        {{ $usersWithActualRole->appends(['uNo'=>$usersWithout->currentPage()])->links() }}
                    </div>
                </div>
            </div>
        </div>
        <x-sidebar.menuDxRole menDx="assegnaUtenti" roleid="{{$ruolo->id}}"></x-sidebar.menuDxRole>
    </div>
</main>
