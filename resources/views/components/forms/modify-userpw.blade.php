<main class="p-2 text-center">
    <div class="flex flex-row">
        <div class="w-10/12">
{{--            {{$id=$user['id']}};--}}
            {{--        {{$stati}}--}}

            <form class="bg-white p-3 rounded-lg shadow-lg w-full" method="POST"
                  action={{ route('modificapassword', ['id' => $user['id']]) }}>
                @csrf
                @method('PATCH')
                <input type="hidden" name="user_id" value={{$user['id']}}>
                <div class="flex flex-row">
                    <div class="w-1/2">
                        <label class="text-gray-800 font-semibold block my-1 text-md text-left pt-3"
                               for="username">Username</label>
                        <input class="w-full bg-gray-100 px-4 py-2 rounded-lg focus:outline-none"
                               type="text" name="username" id="username"
                               placeholder="digitare slug o lasciare vuoto per autocompletamento"
                               value="{{$user['username']}}" disabled/>
{{--                        @error('username')--}}
{{--                        <div class="text-red-500 text-left text-sm">{{ $message }}</div>--}}
{{--                        @enderror--}}
                    </div>
                    <div class="w-1/2 pl-2">
                        <label class="text-gray-800 font-semibold block my-1 text-md text-left pt-3"
                               for="email">Email</label>
                        <input class="w-full bg-gray-100 px-4 py-2 rounded-lg focus:outline-none"
                               type="text" name="email" id="email" placeholder="@email" value="{{$user['email']}}" disabled/>
{{--                        @error('email')--}}
{{--                        <div class="text-red-500 text-left text-sm">{{ $message }}</div>--}}
{{--                        @enderror--}}
                    </div>
                </div>
                <div class="flex flex-row">
                    <div class="w-1/2">
                        <label class="text-gray-800 font-semibold block my-1 text-md text-left pt-3"
                               for="password">Password</label>
                        <input class="w-full bg-gray-100 px-4 py-2 rounded-lg focus:outline-none" type="password"
                               name="password" id="password" placeholder="password"/>
                        @error('password')
                        <div class="text-red-500 text-left text-sm">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="w-1/2 pl-2">
                        <label class="text-gray-800 font-semibold block my-1 text-md text-left pt-3" for="confirm">Conferma
                            password</label>
                        <input class="w-full bg-gray-100 px-4 py-2 rounded-lg focus:outline-none" type="password"
                               name="password_confirmation" id="password_confirmation"
                               placeholder="digitare nuovamente la password"/>
                    </div>
                </div>
                <div class="flex justify-end items-center mt-3">
                    @if(session()->has('messaggio'))
                        <x-alert.salvato></x-alert.salvato>
                    @endif
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
        <x-sidebar.menuDxUser menDx="modificaPw" userid="{{$user->id}}"></x-sidebar.menuDxUser>
    </div>
</main>
