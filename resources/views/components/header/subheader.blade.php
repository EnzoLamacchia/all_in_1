<div class="flex items-center justify-between pb-3">
    <div>
        <h2 class="text-xl text-gray-900 font-bold">{{$title}}</h2>
    </div>
    <div class="flex items-center justify-between">

        <div class="lg:ml-40 ml-10 space-x-8">
            @if ($urlNuovo)
                <x-table.button class="bg-indigo-600 font-semibold" href="{{$urlNuovo}}">{{$nomeBtnNuovo}} </x-table.button>
            @endif
        </div>
    </div>
</div>
