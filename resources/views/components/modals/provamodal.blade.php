<!-- component -->
<button class="bg-indigo-600 text-white rounded-md px-4 py-2 hover:bg-indigo-800 " onclick="openModal('modal')">Crea nuovo utente</button>

<div id="modal" class="fixed hidden overflow-y-auto h-screen w-full fixed left-0 top-0 flex justify-center items-center bg-black bg-opacity-50 modal">
    <div class="relative top-40 mx-auto mt-10 shadow-xl rounded-md bg-white max-w-md">

        <!-- Modal header -->
        <div class="flex justify-between items-center bg-indigo-600 text-white text-xl rounded-t-md px-4 py-2">
            <h3>Nuovo Utente</h3>
            <button class="text-white font-semibold" onclick="closeModal('modal')">&cross;</button>
        </div>

        <!-- Modal body -->
        <form action="{{ route('creautente') }}" method="POST">
            @csrf
        <main class="p-2 text-center">
            <div class="bg-white p-3 rounded-lg shadow-lg w-full">
                    <div>
                        <label class="text-gray-800 font-semibold block my-1 text-md text-left pt-3" for="username">Username</label>
                        <input class="w-full bg-gray-100 px-4 py-2 rounded-lg focus:outline-none" type="text" name="username" placeholder="username" />
                        @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label class="text-gray-800 font-semibold block my-1 text-md text-left pt-3" for="email">Email</label>
                        <input class="w-full bg-gray-100 px-4 py-2 rounded-lg focus:outline-none" type="text" name="email" placeholder="@email" />
                        @error('title')
                        <div class="alert alert-danger">{{ $email }}</div>
                        @enderror
                    </div>
                    <div>
                        <label class="text-gray-800 font-semibold block my-1 text-md text-left pt-3" for="password">Password</label>
                        <input class="w-full bg-gray-100 px-4 py-2 rounded-lg focus:outline-none" type="password" name="password" placeholder="password" />
                        @error('title')
                        <div class="alert alert-danger">{{ $password }}</div>
                        @enderror
                    </div>
                    <div>
                        <label class="text-gray-800 font-semibold block my-1 text-md text-left pt-3" for="confirm">Conferma password</label>
                        <input class="w-full bg-gray-100 px-4 py-2 rounded-lg focus:outline-none" type="password" name="password_confirmation" placeholder="confirm password" />
                    </div>
                    <div class="flex justify-end items-center mt-3"   >
                        <button type="submit" class="w-1/3 mt-6 bg-indigo-600 hover:bg-indigo-700 rounded-lg px-2 py-2 text-lg text-white tracking-wide font-semibold font-sans">Salva</button>
                        <button type="button" class="w-1/3 ml-2 mt-6 bg-red-600 hover:bg-red-700 rounded-lg px-2 py-2 text-lg text-white tracking-wide font-semibold font-sans" onclick="closeModal('modal')">Annulla (ESC)</button>
                    </div>

                {{--                <button class="w-1/3 mt-6 ml-2 bg-indigo-100 rounded-lg px-2 py-2 text-lg text-gray-800 tracking-wide font-semibold font-sans close-modal">Annulla</button>--}}

            </div>
        </main>
    </form>
        <!-- Modal footer -->
{{--        <div class="px-4 py-2 border-t border-t-gray-500 flex justify-end items-center space-x-4">--}}
{{--            <button class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition" onclick="closeModal('modal')">Close (ESC)</button>--}}
{{--        </div>--}}
    </div>
</div>

<script type="text/javascript">
    window.openModal = function(modalId) {
        document.getElementById(modalId).style.display = 'block'
        document.getElementsByTagName('body')[0].classList.add('overflow-y-hidden')
    }

    window.closeModal = function(modalId) {
        document.getElementById(modalId).style.display = 'none'
        document.getElementsByTagName('body')[0].classList.remove('overflow-y-hidden')
    }

    // Close all modals when press ESC
    document.onkeydown = function(event) {
        event = event || window.event;
        if (event.keyCode === 27) {
            document.getElementsByTagName('body')[0].classList.remove('overflow-y-hidden')
            let modals = document.getElementsByClassName('modal');
            Array.prototype.slice.call(modals).forEach(i => {
                i.style.display = 'none'
            })
        }
    };
</script>
