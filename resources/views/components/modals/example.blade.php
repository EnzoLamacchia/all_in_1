
<div x-data="{ showModal1: false, showModal2: false, showModal3: false }" :class="{'overflow-y-hidden': showModal1 || showModal2 || showModal3}">
    <div class="h-32 w-full flex flex-col sm:flex-row justify-end items-center">
        <button
            class="bg-red-600 font-semibold text-white p-2 w-32 rounded-full hover:bg-red-700 focus:outline-none focus:ring shadow-lg hover:shadow-none transition-all duration-300 m-2"
            onclick="showModal1 = true"
        >
            Click here
        </button>
        <button
            class="bg-green-600 font-semibold text-white p-2 w-32 rounded-full hover:bg-green-700 focus:outline-none focus:ring shadow-lg hover:shadow-none transition-all duration-300 m-2"
            @click="showModal2 = true"
        >
            Click here
        </button>
        <button
            class="bg-blue-600 font-semibold text-white p-2 w-32 rounded-full hover:bg-blue-700 focus:outline-none focus:ring shadow-lg hover:shadow-none transition-all duration-300 m-2"
            @click="showModal3 = true"
        >
            Click here
        </button>
    </div>

    <!-- Modal1 -->
    <div
        class="fixed inset-0 w-full h-full z-20 bg-black bg-opacity-50 duration-300 overflow-y-auto"
        x-show="showModal1"
        x-transition:enter="transition duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition duration-300"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
    >
        <div class="relative sm:w-3/4 md:w-1/2 lg:w-1/3 mx-2 sm:mx-auto my-10 opacity-100">
            <div
                class="relative bg-white shadow-lg rounded-md text-gray-900 z-20"
                @click.away="showModal1 = false"
                x-show="showModal1"
                x-transition:enter="transition transform duration-300"
                x-transition:enter-start="scale-0"
                x-transition:enter-end="scale-100"
                x-transition:leave="transition transform duration-300"
                x-transition:leave-start="scale-100"
                x-transition:leave-end="scale-0"
            >
                <header class="flex items-center justify-between p-2">
                    <h2 class="font-semibold">Header</h2>
                    <button class="focus:outline-none p-2" @click="showModal1 = false">
                        <svg class="fill-current" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                            <path
                                d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"
                            ></path>
                        </svg>
                    </button>
                </header>
                <main class="p-2 text-center">
                    <p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Veniam voluptatem, optio dolorem accusantium fuga
                        molestias nobis sequi autem ducimus laudantium beatae amet earum, quia reiciendis corporis animi modi
                        pariatur impedit!
                    </p>
                </main>
                <footer class="flex justify-center p-2">
                    <button
                        class="bg-red-600 font-semibold text-white p-2 w-32 rounded-full hover:bg-red-700 focus:outline-none focus:ring shadow-lg hover:shadow-none transition-all duration-300"
                        @click="showModal1 = false"
                    >
                        Go back
                    </button>
                </footer>
            </div>
        </div>
    </div>

    <!-- Modal2 -->
    <div
        class="fixed inset-0 w-full h-full z-20 bg-black bg-opacity-50 duration-300 overflow-y-auto"
        x-show="showModal2"
        x-transition:enter="transition duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition duration-300"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
    >
        <div class="relative sm:w-3/4 md:w-1/2 lg:w-1/3 mx-2 sm:mx-auto my-10 opacity-100">
            <div
                class="relative bg-white shadow-lg rounded-lg text-gray-900 z-20"
                @click.away="showModal2 = false"
                x-show="showModal2"
                x-transition:enter="transition transform duration-300"
                x-transition:enter-start="scale-0"
                x-transition:enter-end="scale-100"
                x-transition:leave="transition transform duration-300"
                x-transition:leave-start="scale-100"
                x-transition:leave-end="scale-0"
            >
                <header class="flex flex-col justify-center items-center p-3 text-green-600">
                    <div class="flex justify-center w-28 h-28 border-4 border-green-600 rounded-full mb-4">
                        <svg class="fill-current w-20" viewBox="0 0 20 20">
                            <path
                                d="M7.629,14.566c0.125,0.125,0.291,0.188,0.456,0.188c0.164,0,0.329-0.062,0.456-0.188l8.219-8.221c0.252-0.252,0.252-0.659,0-0.911c-0.252-0.252-0.659-0.252-0.911,0l-7.764,7.763L4.152,9.267c-0.252-0.251-0.66-0.251-0.911,0c-0.252,0.252-0.252,0.66,0,0.911L7.629,14.566z"
                            ></path>
                        </svg>
                    </div>
                    <h2 class="font-semibold text-2xl">Success</h2>
                </header>
                <main class="p-3 text-center">
                    <p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Veniam voluptatem, optio dolorem accusantium fuga
                        molestias nobis sequi autem ducimus laudantium beatae amet earum, quia reiciendis corporis animi modi
                        pariatur impedit!
                    </p>
                </main>
                <footer class="flex justify-center bg-transparent">
                    <button
                        class="bg-green-600 font-semibold text-white py-3 w-full rounded-b-md hover:bg-green-700 focus:outline-none focus:ring shadow-lg hover:shadow-none transition-all duration-300"
                        @click="showModal2 = false"
                    >
                        Confirm
                    </button>
                </footer>
            </div>
        </div>
    </div>

    <!-- Modal3 -->
    <div
        class="fixed inset-0 w-full h-full z-20 bg-black bg-opacity-50 duration-300 overflow-y-auto"
        x-show="showModal3"
        x-transition:enter="transition duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition duration-300"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
    >
        <div class="relative sm:w-3/4 md:w-1/2 lg:w-1/3 mx-2 sm:mx-auto mt-10 mb-24 opacity-100">
            <div
                class="relative bg-white shadow-lg rounded-lg text-gray-900 z-20"
                @click.away="showModal3 = false"
                x-show="showModal3"
                x-transition:enter="transition transform duration-300"
                x-transition:enter-start="scale-0"
                x-transition:enter-end="scale-100"
                x-transition:leave="transition transform duration-300"
                x-transition:leave-start="scale-100"
                x-transition:leave-end="scale-0"
            >
                <header class="flex flex-col justify-center items-center p-3 text-blue-600">
                    <h2 class="font-semibold text-xl">Nuovo Utente</h2>
                </header>
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
                            <div class="items-center"   >
                            <button type="submit" class="w-1/2 mt-6 bg-indigo-600 rounded-lg px-4 py-2 text-lg text-white tracking-wide font-semibold font-sans">Registra</button>
                            <button @click="showModal3 = false" class="w-1/2 mt-6 mb-3 bg-indigo-100 rounded-lg px-4 py-2 text-lg text-gray-800 tracking-wide font-semibold font-sans">Annulla</button>
                            </div>
                        </form>
                    </div>
                </main>
{{--                <footer class="flex justify-center bg-transparent">--}}
{{--                    <button--}}
{{--                        class="bg-blue-600 font-semibold text-white py-3 w-full rounded-b-md hover:bg-blue-700 focus:outline-none focus:ring shadow-lg hover:shadow-none transition-all duration-300"--}}
{{--                        @click="showModal3 = false"--}}
{{--                    >--}}
{{--                        Confirm--}}
{{--                    </button>--}}
{{--                </footer>--}}
            </div>
        </div>
    </div>
</div>

