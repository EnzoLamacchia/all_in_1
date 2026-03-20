<div class="flex items-center justify-between pb-6">
    <div>
        <h2 class="text-2xl text-gray-900 font-bold">{{$title}}</h2>
    </div>
    <div class="flex items-center justify-between">
        @if ($urlCerca)
            <div class="flex bg-gray-50 items-center p-2 rounded-md">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20"
                 fill="currentColor">
                <path fill-rule="evenodd"
                      d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                      clip-rule="evenodd"/>
            </svg>
            <input class="bg-gray-100 ml-1 border-2 outline outline-2 mr-2" type="text" name="" id=""
                   placeholder="search...">
            <x-table.button class="bg-indigo-600 font-semibold" padxcerca="4" href="{{$urlCerca}}">Cerca</x-table.button>
        </div>
        @endif
        <div class="lg:ml-40 ml-10 space-x-8">
            @if ($urlNuovo)
                <x-table.button class="bg-indigo-600 font-semibold" href="{{$urlNuovo}}">{{$nomeBtnNuovo}} </x-table.button>
            @endif
        </div>
    </div>
</div>
