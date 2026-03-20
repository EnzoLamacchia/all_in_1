<x-gestione-layout>
{{--    <x-slot name="header">--}}
{{--        <h2 class="font-semibold text-xl text-gray-800 leading-tight"> prova--}}
{{--            --}}{{--            {{ __('DashboardController') }}--}}
{{--        </h2>--}}
{{--    </x-slot>--}}

    <!-- component -->
{{--    @csrf--}}
    <div class="w-full bg-white px-6 py-8 rounded-md ">
        <x-header.header title="Utenti" urlCerca="#" nomeBtnNuovo="Nuovo Utente" urlNuovo="{{route('creautente')}}">
        </x-header.header>
        <div class="div bg-grey text-left py-2" id="perPage">risultati per pagina:
            <a class="@if (Session::get('perPage') == 5) bg-indigo-600 text-white @else bg-white text-dark @endif
                w-8 h-8 p-2 border border-indigo-700 rounded cursor-pointer hover:bg-indigo-300">5</a>
            <a class="@if (Route::current()->controller->perPage == 10) bg-indigo-600 text-white @else bg-white text-dark @endif
                w-8 h-8 p-2 border border-indigo-700 rounded cursor-pointer hover:bg-indigo-300">10</a>
            <a class="@if (Route::current()->controller->perPage == 15) bg-indigo-600 text-white @else bg-white text-dark @endif
                w-8 h-8 p-2 border border-indigo-700 rounded cursor-pointer hover:bg-indigo-300">15</a>
            <a class="@if (Route::current()->controller->perPage == 20) bg-indigo-600 text-white @else bg-white text-dark @endif
                w-8 h-8 p-2 border border-indigo-700 rounded cursor-pointer hover:bg-indigo-300">20</a>
            <a class="@if (Route::current()->controller->perPage == 25) bg-indigo-600 text-white @else bg-white text-dark @endif
                w-8 h-8 p-2 border border-indigo-700 rounded cursor-pointer hover:bg-indigo-300">25</a>
        </div>

{{--        modal example--}}
    <!-- component -->


{{--        <x-modals.3modalsbutton></x-modals.3modalsbutton>--}}
{{--        <x-modals.example></x-modals.example>--}}
{{--        <x-modals.newuser></x-modals.newuser>--}}
{{--        <x-modals.provamodal></x-modals.provamodal>--}}
{{--        end modal example--}}


        <x-table.table :intestazioni="[['NomCol'=>'ID','LarghCol'=>'w-1/12'],
        ['NomCol'=>'Nome','LarghCol'=>'w-3/12'],['NomCol'=>'Email','LarghCol'=>'w-4/12'],
        ['NomCol'=>'Stato','LarghCol'=>'w-1/12'],['NomCol'=>'','LarghCol'=>'w-3/12']]" idTable="userTable">
            @foreach ($users as $user)
                <tr class="border-b">
                    <x-table.td class="font-medium">{{$user->id}}</x-table.td>
                    <x-table.td class="font-bold">
                        <div class="flex items-center">
                            <div class="mr-3 flex-shrink-0 w-10 h-10">
                                <img class="w-full h-full rounded-full"
                                     @if ( $user->profile_photo_path != null)
                                     src="{{ $user->profile_photo_url }}"
                                     @else
                                     src="/storage/profile-photos/av.jpg"
                                    @endif
                                >
                                {{--                                        <img class="w-full h-full rounded-full"--}}
                                {{--                                             src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2.2&w=160&h=160&q=80"--}}
                                {{--                                             alt="" />--}}
                            </div>
                            {{$user->name}} {{$user->surname}}
                        </div>
                    </x-table.td>
                    <x-table.td class="font-medium">{{$user->email}}</x-table.td>
                    <x-table.td class="font-medium">{{$user->UserStatus}}</x-table.td>
                    <x-table.td class="text-right">
                        <x-table.button class="bg-green-500 hover:bg-green-600" href="{{route('editutente',['id'=>$user->id])}}">
                            <svg  class="h-6 w-6 text-white" width="24"  height="24"  viewBox="0 0 24 24"  xmlns="http://www.w3.org/2000/svg"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">
                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z" />
                            </svg>
                            </x-table.button>
                        <x-table.button class="bg-yellow-500 hover:bg-yellow-600" title="onoff"> {{--//href gestito via ajax in delUser.js--}}
                            @if ($user->UserStatus == 'attivo')
                                <svg class="h-6 w-6 text-black"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">  <rect x="1" y="5" width="22" height="14" rx="7" ry="7" />  <circle cx="8" cy="12" r="3" /></svg>
                            @else
                                <svg class="h-6 w-6 text-white"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">  <rect x="1" y="5" width="22" height="14" rx="7" ry="7" />  <circle cx="16" cy="12" r="3" /></svg>
                            @endif
                        </x-table.button>
                        <x-table.button class="bg-red-500 hover:bg-red-600"  title="delete" > {{--//href gestito via ajax in delUser.js--}}
                            <svg class="h-6 w-6 text-white"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  <path stroke="none" d="M0 0h24v24H0z"/>  <line x1="4" y1="7" x2="20" y2="7" />  <line x1="10" y1="11" x2="10" y2="17" />  <line x1="14" y1="11" x2="14" y2="17" />  <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />  <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                        </x-table.button>
                        {{--                        Ruoli --}}
                        <x-table.button class="bg-indigo-500 hover:bg-indigo-600" href="{{route('editaruoli',['id'=>$user->id])}}">
                            <svg class="h-6 w-6 text-white"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  <path stroke="none" d="M0 0h24v24H0z"/>  <path d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />  <circle cx="12" cy="12" r="3" /></svg>
                        </x-table.button>
                        {{--                        Permessi --}}
                        <x-table.button class="bg-gray-500 hover:bg-gray-600" href="{{route('editapermessi',['id'=>$user->id])}}">
                            <svg class="h-6 w-6 text-white"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">  <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" /></svg>
                        </x-table.button>
                    </x-table.td>
                </tr>
            @endforeach
                <tr id="paginazione">
                    <td colspan="7">
                        <div class="d-flex justify-content-center pt-2">
                            {{$users->links('vendor.pagination.tailwind')}}
                        </div>
                    </td>
                </tr>
        </x-table.table>
    </div>
    @vite([
    'resources/js/sweet-alert.js',
    'resources/js/setPerPages.js',
    'resources/css/sweet-alert.css',
    'resources/js/delUser.js'])
{{--    <script src="/resources/js/sweet-alert.js"></script>--}}
{{--    <link rel="stylesheet" href="/resources/css/sweet-alert.css">--}}
{{--    <script src="/resources/js/setPerPages.js"></script>--}}
{{--    <script src="/resources/js/delUser.js"></script>--}}
</x-gestione-layout>
