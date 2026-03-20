<main class="p-2 text-center">
    <div class="flex flex-row">
        <div class="w-10/12">
            <form class="bg-white p-3 rounded-lg shadow-lg w-full" method="POST">
                <input type="hidden" name="vocabolario_id" value={{$vocabolario['id']}}>
                <div class="flex flex-row">
                    <div class="w-1/2">
                        <label class="text-gray-800 font-semibold block my-1 text-md text-left pt-3"
                               for="name">Denominazione Vocabolario</label>
                        <input class="w-full bg-gray-100 px-4 py-2 rounded-lg focus:outline-none"
                               type="text" name="name" id="name" placeholder="denominazione vocabolario"
                               value="{{$vocabolario['name']}}" disabled/>
                    </div>
                    <div class="w-1/2 pl-2">

                    </div>
                </div>
                <div class="flex flex-row">
                    <div class="w-full pb-3">
                        <label class="text-gray-800 font-semibold block my-1 text-md text-left pt-3"
                               for="description">Descrizione</label>
                        <input class="w-full bg-gray-100 px-4 py-2 rounded-lg focus:outline-none"
                               type="text" name="description" id="description"
                               placeholder="descrizione vocabolario"
                               value="{{$vocabolario['description']}}" disabled/>
                    </div>
                </div>
            </form>
            {{--                <button class="w-1/3 mt-6 ml-2 bg-indigo-100 rounded-lg px-2 py-2 text-lg text-gray-800 tracking-wide font-semibold font-sans close-modal">Annulla</button>--}}

        </div>
        <x-sidebar.menuDxVocabolario menDx="showVocabolario" roleid="{{$vocabolario->id}}"></x-sidebar.menuDxVocabolario>
    </div>
</main>
