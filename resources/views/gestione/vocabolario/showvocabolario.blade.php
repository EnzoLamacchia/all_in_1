<x-gestione-layout>

    <!-- component -->
    <div class="w-full bg-white px-6 py-8 rounded ">
        <x-header.header title="Vocabolari" urlCerca="" nomeBtnNuovo="Lista Vocabolari"
                         urlNuovo="{{route('vocabolari')}}">
        </x-header.header>
        <div class="bg-gray-100 rounded shadow-lg p-4">
            <x-header.subheader title="Dettagli Vocabolario" urlCerca="" nomeBtnNuovo="" urlNuovo="">
            </x-header.subheader>
            {{--{{dd($stati)}}--}}
            <x-forms.show-vocabolario :vocabolario="$vocabolario"></x-forms.show-vocabolario>
            <div class="flex flex-row px-2">
                <div
                    class="w-10/12 text-xl text-center text-gray-900 font-bold mt-5 py-2 px-2 border rounded bg-gray-200">
                    Elenco voci del vocabolario "{{$vocabolario['name']}}"
                </div>
                <div class="w-2/12"></div>
            </div>
            <div class="flex flex-row px-2">
                <div class="w-10/12">
                    <x-table.table :intestazioni="[['NomCol'=>'Voci vocabolario','LarghCol'=>'w-6/12'],
                    ['NomCol'=>'Sottovoci vocabolario','LarghCol'=>'w-6/12']]" idTable="FormTable" class="border">
                        @if (count($vocabolario->voices)>0)
                            @foreach($vocabolario->voicesnotchildren as $voice)
                                <tr class="border-b">
                                    <x-table.td class="border bg-white text-left text-md font-semibold">
                                        {{$voice['id']}} - {{$voice['name']}}&nbsp;
                                        <span class="inline-block align-middle">
                                            <x-table.roundbutton class="bg-green-500 hover:bg-green-600" title="edit"
                                                                 href="{{route('editvoce',['idvoice'=>$voice->id])}}">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24"
                                                     height="24"><path
                                                            d="M19.4 7.34 16.66 4.6A2 2 0 0 0 14 4.53l-9 9a2 2 0 0 0-.57 1.21L4 18.91a1 1 0 0 0 .29.8A1 1 0 0 0 5 20h.09l4.17-.38a2 2 0 0 0 1.21-.57l9-9a1.92 1.92 0 0 0-.07-2.71zM9.08 17.62l-3 .28.27-3L12 9.32l2.7 2.7zM16 10.68 13.32 8l1.95-2L18 8.73z"
                                                            data-name="edit" fill="#ffffff"
                                                            class="color000 svgShape"></path></svg>
                                           </x-table.roundbutton>
                                           <x-table.roundbutton class="bg-red-500 hover:bg-red-600" title="deletevoice" id="{{$voice['id']}}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                                         viewBox="0 0 24 24" stroke="white"><path stroke-linecap="round"
                                                                                                  stroke-linejoin="round"
                                                                                                  stroke-width="2"
                                                                                                  d="M6 18L18 6M6 6l12 12"/></svg>
                                           </x-table.roundbutton>
                                        </span>
                                    </x-table.td>
                                    <x-table.td class="bg-white text-left text-md font-semibold">
                                        @foreach($voice->children as $item)
                                            {{$item['id']}} - {{$item['name']}}&nbsp;
                                            <span class="inline-block align-middle">
                                                <x-table.roundbutton class="bg-green-500 hover:bg-green-600" title="edit"
                                                                     href="{{route('editvoce',['idvoice'=>$item->id])}}">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24"
                                                     height="24"><path
                                                            d="M19.4 7.34 16.66 4.6A2 2 0 0 0 14 4.53l-9 9a2 2 0 0 0-.57 1.21L4 18.91a1 1 0 0 0 .29.8A1 1 0 0 0 5 20h.09l4.17-.38a2 2 0 0 0 1.21-.57l9-9a1.92 1.92 0 0 0-.07-2.71zM9.08 17.62l-3 .28.27-3L12 9.32l2.7 2.7zM16 10.68 13.32 8l1.95-2L18 8.73z"
                                                            data-name="edit" fill="#ffffff"
                                                            class="color000 svgShape"></path></svg>
                                           </x-table.roundbutton>
                                           <x-table.roundbutton class="bg-red-500 hover:bg-red-600" title="deletevoice" id="{{$item['id']}}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                                         viewBox="0 0 24 24" stroke="white"><path stroke-linecap="round"
                                                                                                  stroke-linejoin="round"
                                                                                                  stroke-width="2"
                                                                                                  d="M6 18L18 6M6 6l12 12"/></svg>
                                           </x-table.roundbutton>
                                        </span>
                                            </br>
                                        @endforeach
                                    </x-table.td>
                                </tr>
                            @endforeach
                        @else
                            <x-table.td class="border bg-white text-left text-md font-semibold ">&nbsp;</x-table.td>
                            <x-table.td class="bg-white text-left text-md font-semibold"></x-table.td>
                        @endif
                    </x-table.table>
                    <div></div>
                </div>
            </div>
        </div>
    </div>

    @vite([
    'resources/js/sweet-alert.js',
    'resources/css/sweet-alert.css',
    'resources/js/manageFormTable.js'])
</x-gestione-layout>
