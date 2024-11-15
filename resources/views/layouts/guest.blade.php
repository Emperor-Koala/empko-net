<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        {{-- <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=ubuntu:300,300i,400,400i,500,500i,700,700i&display=swap" rel="stylesheet" /> --}}

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

        <script type="application/javascript">
            const toggleMenu = (e) => {
                const target = $(e.target);
                const navMenu = $('#nav__menu');
                const navBurger = $('#nav__burger');
                const navClose = $('#nav__close');

                if ((target !== navBurger && !$.contains(navMenu, target)) &&
                    (target !== navClose && !$.contains(navClose, target)) &&
                    (target !== navMenu && $.contains(navMenu, target))) {
                    return;
                }

                navBurger.toggleClass(['opacity-0', 'rotate-90']);
                navClose.toggleClass(['opacity-0', 'rotate-90']);
                navMenu.toggleClass(['opacity-0', 'pointer-events-none', 'top-16', 'top-14']);
            };

            const toggleTheme = () => {
                if (localStorage.theme === 'dark') {
                    localStorage.theme = 'light';
                    $(document.documentElement).removeClass('dark');
                } else {
                    localStorage.theme = 'dark';
                    $(document.documentElement).addClass('dark');
                }
            };

            $(document).ready(function () {
                $("#nav__toggle").click(toggleMenu);
                $("#nav__menu").click(toggleMenu);
                $(".theme__toggle").click(toggleTheme);

                if (!('theme' in localStorage)) {
                    if (window.matchMedia('(prefers-color-scheme: dark)').matches) {
                        localStorage.theme = 'dark';
                        $(document.documentElement).addClass('dark');
                        return;
                    } else {
                        localStorage.theme = 'light';
                        return;
                    }
                } else if (localStorage.theme === 'dark') {
                    $(document.documentElement).addClass('dark');
                }
                setTimeout(() => {
                    $('body').addClass('transition-colors');
                    $('header').addClass('transition-colors');
                }, 200);
            });
        </script>

<script src=" https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js "></script>
<link href=" https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css " rel="stylesheet">
<style>
    .splide__arrow svg {
        width: unset;
        height: unset;
    }
</style>
    </head>
    <body class="font-sans text-gray-900 antialiased bg-neutral-100 dark:bg-neutral-800">
        <div class="min-h-screen flex flex-col">
            <header class="h-16 bg-neutral-200 dark:bg-neutral-700 shadow-md shadow-black/20 fixed left-0 top-0 w-full z-50 select-none">
                <nav class="h-16 md:flex justify-between md:max-w-2xl lg:max-w-4xl xl:max-w-6xl md:mx-auto">
                    <div class="h-full flex flex-row justify-between items-center px-16 md:px-0">
                        <img class="h-8" src="{{ asset('storage/images/logo_with_text.svg') }}" />

                        <div class="flex md:hidden flex-row gap-x-3 items-center justofy-center">
                            <div id="nav__toggle" class="relative w-6 h-6 cursor-pointer">
                                <x-icon.burger id="nav__burger" class="absolute w-max h-max inset-0 m-auto transition-[opacity,transform] fill-gray-900 dark:fill-white" />
                                <x-icon.close id="nav__close" class="absolute w-max h-max inset-0 m-auto transition-[opacity,transform] opacity-0 fill-gray-900 dark:fill-white" />
                            </div>
                            <x-hex-button class="theme__toggle w-10 h-8" variant="link">
                                <x-icon.theme class="w-5 h-5" />
                            </x-hex-button>
                        </div>
                    </div>
                    <div id="nav__menu" class="absolute left-0 top-14 w-full h-[calc(100vh-4rem)] overflow-auto pointer-events-none opacity-0 transition-[opacity,top] md:static md:w-min md:h-auto md:!pointer-events-auto md:!opacity-100 md:!transition-none md:my-auto">
                        <ul class="bg-neutral-300 dark:bg-neutral-600 md:!bg-transparent md:flex md:flex-row md:h-9 md:gap-x-4 items-center">
                            <li class="flex-1 md:w-20 md:h-full">
                                <x-hex-button href="/" class="hidden md:flex h-full dark:text-white text-xl" variant="link">Home</x-hex-button>
                                <a href="/" class="md:hidden dark:text-white hover:bg-black/20 active:bg-black/40 dark:hover:bg-white/20 dark:active:bg-white/40 px-3 py-2 flex flex-row items-center justify-between transition-colors cursor-pointer">Home</a>
                            </li>
                            <li class="flex-1 md:w-28 md:h-full">
                                <x-hex-button href="/resume" class="hidden md:flex h-full dark:text-white text-xl" variant="link">Résumé</x-hex-button>
                                <a href="/resume" class="md:hidden dark:text-white hover:bg-black/20 active:bg-black/40 dark:hover:bg-white/20 dark:active:bg-white/40 px-3 py-2 flex flex-row items-center justify-between transition-colors cursor-pointer">Résumé</a>
                            </li>
                            <li class="flex-1 md:w-28 md:h-full">
                                <x-hex-button href="/projects" class="hidden md:flex h-full dark:text-white text-xl" variant="link">Projects</x-hex-button>
                                <a href="/projects" class="md:hidden dark:text-white hover:bg-black/20 active:bg-black/40 dark:hover:bg-white/20 dark:active:bg-white/40 px-3 py-2 flex flex-row items-center justify-between transition-colors cursor-pointer">Projects</a>
                            </li>
                            <li class="hidden md:inline md:w-10 md:h-full">
                                <x-hex-button class="theme__toggle h-full w-full" variant="link">
                                    <x-icon.theme class="w-5 h-5" />
                                </x-hex-button>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>

            <main class="flex-1 mt-16">
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
