<div x-data="{ showModal1: false}" :class="{'overflow-y-hidden': showModal1 }">
    <div class="h-32 w-full flex flex-col sm:flex-row justify-center items-center">
        <x-modals.example></x-modals.example>
        <button
            class="bg-red-600 font-semibold text-white p-2 w-32 rounded-full hover:bg-red-700 focus:outline-none focus:ring shadow-lg hover:shadow-none transition-all duration-300 m-2"
            @click="showModal1 = true"
        >
            Click here
        </button>
    </div>
{{--    <div--}}
{{--        class="fixed inset-0 w-full h-full z-20 bg-black bg-opacity-50 duration-300 overflow-y-auto"--}}
{{--        x-show="showModal1"--}}
{{--        x-transition:enter="transition duration-300"--}}
{{--        x-transition:enter-start="opacity-0"--}}
{{--        x-transition:enter-end="opacity-100"--}}
{{--        x-transition:leave="transition duration-300"--}}
{{--        x-transition:leave-start="opacity-100"--}}
{{--        x-transition:leave-end="opacity-0"--}}
{{--    >--}}
{{--        <div class="relative sm:w-3/4 md:w-1/2 lg:w-1/3 mx-2 sm:mx-auto my-10 opacity-100">--}}
{{--            <div--}}
{{--                class="relative bg-white shadow-lg rounded-md text-gray-900 z-20"--}}
{{--                @click.away="showModal1 = false"--}}
{{--                x-show="showModal1"--}}
{{--                x-transition:enter="transition transform duration-300"--}}
{{--                x-transition:enter-start="scale-0"--}}
{{--                x-transition:enter-end="scale-100"--}}
{{--                x-transition:leave="transition transform duration-300"--}}
{{--                x-transition:leave-start="scale-100"--}}
{{--                x-transition:leave-end="scale-0"--}}
{{--            >--}}
{{--                <header class="flex items-center justify-between p-2">--}}
{{--                    <h2 class="font-semibold">Header</h2>--}}
{{--                    <button class="focus:outline-none p-2" @click="showModal1 = false">--}}
{{--                        <svg class="fill-current" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">--}}
{{--                            <path--}}
{{--                                d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"--}}
{{--                            ></path>--}}
{{--                        </svg>--}}
{{--                    </button>--}}
{{--                </header>--}}
{{--                <main class="p-2 text-center">--}}
{{--                    <div class="lg:w-2/5 md:w-1/2 w-2/3">--}}
{{--                        <form class="bg-white p-10 rounded-lg shadow-lg min-w-full">--}}
{{--                            <h1 class="text-center text-2xl mb-6 text-gray-600 font-bold font-sans">Formregister</h1>--}}
{{--                            <div>--}}
{{--                                <label class="text-gray-800 font-semibold block my-3 text-md" for="username">Username</label>--}}
{{--                                <input class="w-full bg-gray-100 px-4 py-2 rounded-lg focus:outline-none" type="text" name="username" id="username" placeholder="username" />--}}
{{--                            </div>--}}
{{--                            <div>--}}
{{--                                <label class="text-gray-800 font-semibold block my-3 text-md" for="email">Email</label>--}}
{{--                                <input class="w-full bg-gray-100 px-4 py-2 rounded-lg focus:outline-none" type="text" name="email" id="email" placeholder="@email" />--}}
{{--                            </div>--}}
{{--                            <div>--}}
{{--                                <label class="text-gray-800 font-semibold block my-3 text-md" for="password">Password</label>--}}
{{--                                <input class="w-full bg-gray-100 px-4 py-2 rounded-lg focus:outline-none" type="text" name="password" id="password" placeholder="password" />--}}
{{--                            </div>--}}
{{--                            <div>--}}
{{--                                <label class="text-gray-800 font-semibold block my-3 text-md" for="confirm">Confirm password</label>--}}
{{--                                <input class="w-full bg-gray-100 px-4 py-2 rounded-lg focus:outline-none" type="text" name="confirm" id="confirm" placeholder="confirm password" />--}}
{{--                            </div>--}}
{{--                            <button type="submit" class="w-full mt-6 bg-indigo-600 rounded-lg px-4 py-2 text-lg text-white tracking-wide font-semibold font-sans">Register</button>--}}
{{--                            <button type="submit" class="w-full mt-6 mb-3 bg-indigo-100 rounded-lg px-4 py-2 text-lg text-gray-800 tracking-wide font-semibold font-sans">Login</button>--}}
{{--                        </form>--}}
{{--                    </div>--}}
{{--                </main>--}}
{{--                <footer class="flex justify-center p-2">--}}
{{--                    <button--}}
{{--                        class="bg-red-600 font-semibold text-white p-2 w-32 rounded-full hover:bg-red-700 focus:outline-none focus:ring shadow-lg hover:shadow-none transition-all duration-300"--}}
{{--                        @click="showModal1 = false"--}}
{{--                    >--}}
{{--                        Go back--}}
{{--                    </button>--}}
{{--                </footer>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
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

</div>
