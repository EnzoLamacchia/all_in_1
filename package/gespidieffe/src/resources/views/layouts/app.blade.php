<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="/assets/img/brainOrange.png" />
    <title>GesPidieffe – {{ config('app.name', 'NAPP') }}</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
    <link rel="stylesheet" href="https://unpkg.com/tailwindcss@2.2.19/dist/tailwind.min.css"/>

    @vite('resources/js/app.js')
    @stack('styles')
</head>
<body class="font-sans antialiased bg-gray-50 min-h-screen flex flex-col">

    {{-- ── Top navbar ──────────────────────────────────────────── --}}
    <nav class="bg-white border-b border-gray-200 shadow-sm flex-shrink-0">
        <div class="flex items-center justify-between px-6 py-3">

            {{-- Sinistra: logo + titolo --}}
            <div class="flex items-center gap-3">
                <a href="{{ route('gespidieffe.home') }}" class="flex items-center gap-2 group">
                    <img src="/vendor/dedir/assets/materialDashboard/img/devEL-logo120trasp.png" alt="devEL" class="w-16 h-16 flex-shrink-0">
                    <span class="text-lg font-bold text-gray-800 group-hover:text-red-600 transition-colors">GesPidieffe</span>
                </a>

                {{-- Breadcrumb --}}
                @isset($breadcrumb)
                    <span class="text-gray-300 mx-1">›</span>
                    <span class="text-sm text-gray-500">{{ $breadcrumb }}</span>
                @endisset
            </div>

            {{-- Destra: dropdown funzioni + utente + torna alla dashboard --}}
            <div class="flex items-center gap-4">

                {{-- Dropdown "Cambia funzione" --}}
                <div class="relative mr-6" x-data="{ open: false }" @click.outside="open = false">
                    <button @click="open = !open"
                            class="flex items-center gap-1.5 text-sm font-medium text-gray-600
                                   hover:text-gray-900 border border-gray-200 rounded-lg px-3 py-1.5
                                   bg-white hover:bg-gray-50 transition-colors shadow-sm">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>
                        Funzioni
                        <svg class="w-3.5 h-3.5 transition-transform" :class="open ? 'rotate-180' : ''"
                             fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                        </svg>
                    </button>

                    <div x-show="open"
                         x-transition:enter="transition ease-out duration-100"
                         x-transition:enter-start="opacity-0 scale-95"
                         x-transition:enter-end="opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-75"
                         x-transition:leave-start="opacity-100 scale-100"
                         x-transition:leave-end="opacity-0 scale-95"
                         class="absolute right-0 mt-2 w-52 bg-white border border-gray-200 rounded-xl
                                shadow-lg z-50 py-1 origin-top-right">

                        <a href="{{ route('gespidieffe.censura') }}"
                           class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700
                                  hover:bg-red-50 hover:text-red-700 transition-colors">
                            <span class="w-2 h-2 rounded-full bg-red-500 flex-shrink-0"></span>
                            Censura PDF
                        </a>
                        <a href="{{ route('gespidieffe.merge') }}"
                           class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700
                                  hover:bg-blue-50 hover:text-blue-700 transition-colors">
                            <span class="w-2 h-2 rounded-full bg-blue-500 flex-shrink-0"></span>
                            Merge PDF
                        </a>
                        <a href="{{ route('gespidieffe.split') }}"
                           class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700
                                  hover:bg-purple-50 hover:text-purple-700 transition-colors">
                            <span class="w-2 h-2 rounded-full bg-purple-500 flex-shrink-0"></span>
                            Split PDF
                        </a>
                        <a href="{{ route('gespidieffe.organizza') }}"
                           class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700
                                  hover:bg-yellow-50 hover:text-yellow-700 transition-colors">
                            <span class="w-2 h-2 rounded-full bg-yellow-500 flex-shrink-0"></span>
                            Organizza pagine
                        </a>
                        <a href="{{ route('gespidieffe.ruota') }}"
                           class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700
                                  hover:bg-green-50 hover:text-green-700 transition-colors">
                            <span class="w-2 h-2 rounded-full bg-green-500 flex-shrink-0"></span>
                            Ruota pagine
                        </a>
                        <a href="{{ route('gespidieffe.numera') }}"
                           class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700
                                  hover:bg-indigo-50 hover:text-indigo-700 transition-colors">
                            <span class="w-2 h-2 rounded-full bg-indigo-500 flex-shrink-0"></span>
                            Numera pagine
                        </a>
                        <a href="{{ route('gespidieffe.unisciorganizza') }}"
                           class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700
                                  hover:bg-orange-50 hover:text-orange-700 transition-colors">
                            <span class="w-2 h-2 rounded-full flex-shrink-0" style="background:#f97316"></span>
                            Unisci e Organizza
                        </a>
                        <a href="{{ route('gespidieffe.pdf2word') }}"
                           class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 transition-colors"
                           onmouseenter="this.style.background='#f0fdfa'; this.style.color='#0f766e'"
                           onmouseleave="this.style.background=''; this.style.color=''">
                            <span class="w-2 h-2 rounded-full flex-shrink-0" style="background:#0d9488"></span>
                            PDF to Word
                        </a>
                        @auth
                            @if (auth()->user()->can('usa gespidieffe'))
                                <div class="border-t border-gray-100 my-1"></div>
                                <a href="{{ route('gespidieffe.statistiche') }}"
                                   class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700
                                          hover:bg-gray-50 hover:text-gray-900 transition-colors">
                                    <span class="w-2 h-2 rounded-full bg-gray-400 flex-shrink-0"></span>
                                    Statistiche utilizzo
                                </a>
                            @endif
                        @endauth
                    </div>
                </div>

                @auth
                    <span class="text-sm text-gray-500 hidden sm:inline">
                        {{ auth()->user()->name }} {{ auth()->user()->surname ?? '' }}
                    </span>
                @else
                    <span class="text-sm text-gray-500 hidden sm:inline">Guest</span>
                @endauth
                <a href="{{ auth()->check() ? route('dashboard') : url('/') }}"
                   class="flex items-center gap-1.5 text-sm text-gray-500 hover:text-gray-800 transition-colors">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/>
                    </svg>
                    Home
                </a>
            </div>

        </div>
    </nav>

    {{-- ── Contenuto pagina ────────────────────────────────────── --}}
    <main class="flex-1 flex flex-col">
        {{ $slot }}
    </main>

    @stack('scripts')
</body>
</html>
