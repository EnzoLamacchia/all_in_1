<main class="p-2 text-center">
    <div class="flex flex-row">
        <div class="w-10/12">
        <form class="bg-white p-3 rounded-lg shadow-lg w-full" method="POST" action="{{route('aggiornavoce', ['idvoice'=>$voice['id']])}}">
            @csrf
            @method('PATCH')
            <input type="hidden" name="vocabulary_id" value={{$voice->vocabulary['id']}}>
            <input type="hidden" name="voice_id" value={{$voice['id']}}>
            <div class="flex flex-row">
                <div class="w-1/2">
                    <label class="text-gray-800 font-semibold block my-1 text-md text-left pt-3"
                           for="name">Denominazione Vocabolario</label>
                    <input class="w-full bg-gray-100 px-4 py-2 rounded-lg focus:outline-none"
                           type="text" name="vocabularyname" id="vocabularyname" value="{{$voice->vocabulary['name']}}" disabled />
                </div>
                <div class="w-1/2 pl-2">
                </div>
            </div>
            <div class="flex flex-row">
                <div class="w-1/2">
                    <label class="text-gray-800 font-semibold block my-1 text-md text-left pt-3"
                           for="name">Voce</label>
                    <input class="w-full bg-gray-100 px-4 py-2 rounded-lg focus:outline-none"
                           type="text" name="name" id="name" placeholder="denominazione voce di vocabolario"
                           value="{{$voice['name']}}"/>
                    @error('name')
                    <div class="text-red-500 text-left text-sm">{{ $message }}</div>
                    @enderror
                </div>
                <div class="w-1/2 pl-2">
                    <label class="text-gray-800 font-semibold block my-1 text-md text-left pt-3"
                           for="user_status">Sottovoce di...</label>
                    <div class="rounded-lg bg-gray-100 px-3">
                        <select class="w-full bg-gray-100 px-1 py-2 rounded-lg focus:outline-none"
                                id="father_id" name="father_id" type="text">
                            <option value=''>Selezionare l'eventuale voce di appartenenza</option>
                            @foreach($voice->vocabulary->voicesnotchildren as $item)
                                <option value="{{$item['id']}}" @if($item['id']==$voice['parent_id']) selected @endif>{{$item['name']}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="flex flex-row">
                <div class="w-full">
                    <label class="text-gray-800 font-semibold block my-1 text-md text-left pt-3"
                           for="description">Descrizione</label>
                    <input class="w-full bg-gray-100 px-4 py-2 rounded-lg focus:outline-none"
                           type="text" name="description" id="description"
                           placeholder="descrizione voce"
                           value="{{$voice['description']}}"/>
                    @error('description')
                    <div class="text-red-500 text-left text-sm">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="flex justify-end items-center mt-3">
                <button type="submit"
                        class="mt-6 bg-indigo-600 rounded-lg px-2 py-2 text-lg text-white tracking-normal font-semibold font-sans">
                    <div class="flex items-center">
                        <svg class="h-8 w-8 text-white pr-2" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                             stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/>
                            <polyline points="17 21 17 13 7 13 7 21"/>
                            <polyline points="7 3 7 8 15 8"/>
                        </svg>
                        Salva
                    </div>
                </button>
            </div>
        </form>
        {{--                <button class="w-1/3 mt-6 ml-2 bg-indigo-100 rounded-lg px-2 py-2 text-lg text-gray-800 tracking-wide font-semibold font-sans close-modal">Annulla</button>--}}
    </div>
        <x-sidebar.menuDxVocabolario menDx="modificaVocabolario" roleid="{{$voice->vocabulary['id']}}"></x-sidebar.menuDxVocabolario>

    </div>
</main>
