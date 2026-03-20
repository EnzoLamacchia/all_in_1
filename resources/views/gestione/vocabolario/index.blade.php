<x-gestione-layout>
    <div class="w-full bg-white px-6 py-8 rounded-md ">
        <x-header.header title="Vocabolario" urlCerca="#" nomeBtnNuovo="Nuovo Vocabolario" urlNuovo="{{route('creavocabolario')}}">
        </x-header.header>
        <x-table.table :intestazioni="[['NomCol'=>'ID','LarghCol'=>'w-1/12'],
        ['NomCol'=>'Vocabolario','LarghCol'=>'w-3/12'],['NomCol'=>'Descrizione','LarghCol'=>'w-6/12'],
        ['NomCol'=>'','LarghCol'=>'w-2/12']]" idTable="Table">
            @foreach ($vocabolari as $vocabolario)
                <tr class="border-b">
                    <x-table.td class="font-medium">{{$vocabolario->id}}</x-table.td>
                    <x-table.td class="font-bold">{{$vocabolario->name}}</x-table.td>
                    <x-table.td class="font-bold">{{$vocabolario->description}}</x-table.td>
                    <x-table.td class="text-right">
                        <x-table.button class="bg-gray-500 hover:bg-gray-600" href="{{route('showvocabolario',['id'=>$vocabolario->id])}}" title="mostra">
                            <svg id="SvgjsSvg1065" width="24" height="24" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" ><defs id="SvgjsDefs1066"></defs><g id="SvgjsG1067">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><g data-name="Layer 2" fill="#ffffff" class="color000 svgShape"><g data-name="eye" fill="#ffffff" class="color000 svgShape"><rect width="24" height="24" opacity="0" fill="#ffffff" class="color000 svgShape"></rect><path d="M21.87 11.5c-.64-1.11-4.16-6.68-10.14-6.5-5.53.14-8.73 5-9.6 6.5a1 1 0 0 0 0 1c.63 1.09 4 6.5 9.89 6.5h.25c5.53-.14 8.74-5 9.6-6.5a1 1 0 0 0 0-1zM12.22 17c-4.31.1-7.12-3.59-8-5 1-1.61 3.61-4.9 7.61-5 4.29-.11 7.11 3.59 8 5-1.03 1.61-3.61 4.9-7.61 5z" fill="#ffffff" class="color000 svgShape"></path><path d="M12 8.5a3.5 3.5 0 1 0 3.5 3.5A3.5 3.5 0 0 0 12 8.5zm0 5a1.5 1.5 0 1 1 1.5-1.5 1.5 1.5 0 0 1-1.5 1.5z" fill="#ffffff" class="color000 svgShape"></path></g></g></svg></g>
                            </svg>
                        </x-table.button>
                        <x-table.button class="bg-green-500 hover:bg-green-600" href="{{route('editvocabolario',['id'=>$vocabolario->id])}}">
                            <svg  class="h-6 w-6 text-white" width="24"  height="24"  viewBox="0 0 24 24"  xmlns="http://www.w3.org/2000/svg"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">
                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z" />
                            </svg>
                        </x-table.button>
                        <x-table.button class="bg-yellow-500 hover:bg-yellow-600"
                                        href="{{route('creavoce',['id'=>$vocabolario->id])}}" title="nuova voce">
                            <svg class="h-6 w-6 text-white" stroke-width="6" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 107.07 122.88" style="enable-background:new 0 0 107.07 122.88" xml:space="preserve"><g><path d="M31.54,86.95c-1.74,0-3.16-1.43-3.16-3.19c0-1.76,1.41-3.19,3.16-3.19h20.5c1.74,0,3.16,1.43,3.16,3.19 c0,1.76-1.41,3.19-3.16,3.19H31.54L31.54,86.95z M31.54,42.27c-1.74,0-3.15-1.41-3.15-3.15c0-1.74,1.41-3.15,3.15-3.15h41.61 c1.74,0,3.15,1.41,3.15,3.15c0,1.74-1.41,3.15-3.15,3.15H31.54L31.54,42.27z M56.85,116.58c1.74,0,3.15,1.41,3.15,3.15 c0,1.74-1.41,3.15-3.15,3.15H7.33c-2.02,0-3.85-0.82-5.18-2.15C0.82,119.4,0,117.57,0,115.55V7.33c0-2.02,0.82-3.85,2.15-5.18 C3.48,0.82,5.31,0,7.33,0h90.02c2.02,0,3.85,0.82,5.18,2.15c1.33,1.33,2.15,3.16,2.15,5.18V72.6c0,1.74-1.41,3.15-3.15,3.15 s-3.15-1.41-3.15-3.15V7.33c0-0.28-0.12-0.54-0.3-0.73c-0.19-0.19-0.45-0.3-0.73-0.3H7.33c-0.28,0-0.54,0.12-0.73,0.3 C6.42,6.8,6.3,7.05,6.3,7.33v108.21c0,0.28,0.12,0.54,0.3,0.73c0.19,0.19,0.45,0.3,0.73,0.3H56.85L56.85,116.58z M83.35,83.7 c0-1.73,1.41-3.14,3.14-3.14c1.73,0,3.14,1.41,3.14,3.14l-0.04,14.36l14.34,0.04c1.73,0,3.14,1.41,3.14,3.14s-1.41,3.14-3.14,3.14 l-14.35-0.04l-0.04,14.34c0,1.73-1.41,3.14-3.14,3.14c-1.73,0-3.14-1.41-3.14-3.14l0.04-14.35l-14.34-0.04 c-1.73,0-3.14-1.41-3.14-3.14c0-1.73,1.41-3.14,3.14-3.14l14.36,0.04L83.35,83.7L83.35,83.7z M31.54,64.59 c-1.74,0-3.15-1.41-3.15-3.15c0-1.74,1.41-3.15,3.15-3.15h41.61c1.74,0,3.15,1.41,3.15,3.15c0,1.74-1.41,3.15-3.15,3.15H31.54 L31.54,64.59z"/></g>
                            </svg>
                        </x-table.button>
                        <x-table.button class="bg-red-500 hover:bg-red-600"  title="delete" > {{--//href gestito via ajax in delUser.js--}}
                            <svg class="h-6 w-6 text-white"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"/><line x1="4" y1="7" x2="20" y2="7" />  <line x1="10" y1="11" x2="10" y2="17" /><line x1="14" y1="11" x2="14" y2="17" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
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
