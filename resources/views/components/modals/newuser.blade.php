<!-- component -->
<button class="bg-blue-600 hover:bg-blue-700 px-3 py-1 rounded text-white m-5 crea-utente">Nuovo Utente</button>

<div class="modal h-screen w-full fixed left-0 top-0 flex justify-center items-center bg-black bg-opacity-50 hidden">
    <!-- modal -->
    <div class="bg-white rounded shadow-lg w-10/12 md:w-1/3">
        <!-- modal header -->
        <div class="border-b px-4 py-2 flex justify-between items-center p-3 ">
            <h3 class="font-semibold text-lg text-indigo-600">Crea nuovo utente</h3>
            <button class="text-black close-modal">&cross;</button>
        </div>
        <!-- modal body -->

        <main class="p-2 text-center">
            <div >
                <form class="bg-white p-3 rounded-lg shadow-lg w-full">
                    <div>
                        <label class="text-gray-800 font-semibold block my-1 text-md text-left pt-3" for="username">Username</label>
                        <input class="w-full bg-gray-100 px-4 py-2 rounded-lg focus:outline-none" type="text" name="username" id="username" placeholder="username" />
                    </div>
                    <div>
                        <label class="text-gray-800 font-semibold block my-1 text-md text-left pt-3" for="email">Email</label>
                        <input class="w-full bg-gray-100 px-4 py-2 rounded-lg focus:outline-none" type="text" name="email" id="email" placeholder="@email" />
                    </div>
                    <div>
                        <label class="text-gray-800 font-semibold block my-1 text-md text-left pt-3" for="password">Password</label>
                        <input class="w-full bg-gray-100 px-4 py-2 rounded-lg focus:outline-none" type="text" name="password" id="password" placeholder="password" />
                    </div>
                    <div>
                        <label class="text-gray-800 font-semibold block my-1 text-md text-left pt-3" for="confirm">Conferma password</label>
                        <input class="w-full bg-gray-100 px-4 py-2 rounded-lg focus:outline-none" type="text" name="confirm" id="confirm" placeholder="confirm password" />
                    </div>
                    <div class="flex justify-end items-center mt-3"   >
                        <button type="submit" class="w-1/3 mt-6 bg-indigo-600 rounded-lg px-2 py-2 text-lg text-white tracking-wide font-semibold font-sans">Salva</button>
                        </div>
                </form>
{{--                <button class="w-1/3 mt-6 ml-2 bg-indigo-100 rounded-lg px-2 py-2 text-lg text-gray-800 tracking-wide font-semibold font-sans close-modal">Annulla</button>--}}

            </div>
        </main>
{{--        <div class="flex justify-end items-center w-100 border-t p-3">--}}
{{--            <button class="bg-red-600 hover:bg-red-700 px-3 py-1 rounded text-white mr-1 close-modal">Cancel</button>--}}
{{--            <button class="bg-blue-600 hover:bg-blue-700 px-3 py-1 rounded text-white">Oke</button>--}}
{{--        </div>--}}
    </div>
</div>

<script>
    const modal = document.querySelector('.modal');
    // window.onload = function() {
    //     if (modal.classList.contains(hidden)){
    //         modal.classList.remove('hidden')
    //     }
    //     else
    //     {
    //         modal.classList.add('hidden')
    //     }
    // };

    const showModal = document.querySelector('.crea-utente');
    const closeModal = document.querySelectorAll('.close-modal');

    showModal.addEventListener('click', function (){
        modal.classList.remove('hidden')
    });

    closeModal.forEach(close => {
        close.addEventListener('click', function (){
            modal.classList.add('hidden')
        });
    });
</script>
