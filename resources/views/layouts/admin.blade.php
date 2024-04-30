<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=ubuntu:300,300i,400,400i,500,500i,700,700i&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

        <!-- TinyMDE -->
        <script src="https://unpkg.com/tiny-markdown-editor/dist/tiny-mde.min.js"></script>
        <link
            rel="stylesheet"
            type="text/css"
            href="https://unpkg.com/tiny-markdown-editor/dist/tiny-mde.min.css"
        />

        <script type="application/javascript">
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
        <div class="min-h-screen flex flex-row">
            <header class="w-16 bg-neutral-200 dark:bg-neutral-700 shadow-md shadow-black/20 fixed left-0 top-0 h-full z-50 select-none flex flex-col items-center justify-between py-4">
                <nav class="flex flex-col gap-y-4">
                    <img src="{{ asset('storage/images/logo.svg') }}" alt="Logo" class="w-12" />
                    <div class="w-12">
                        <x-hex-button href="/admin/projects" class="w-full" vertical variant="link">
                            <x-icon.folder class="w-8 h-8 dark:fill-white" />
                        </x-hex-button>
                    </div>
                    <div class="w-12">
                        <x-hex-button href="/admin/resume" class="w-full" vertical variant="link">
                            <x-icon.file class="h-8 dark:fill-white" />
                        </x-hex-button>
                    </div>
                </nav>
                <div class="w-12">
                    <x-hex-button class="theme__toggle h-full w-full" vertical variant="link">
                        <x-icon.theme class="h-8 w-8" />
                    </x-hex-button>
                </div>
            </header>

            <main class="flex-1 ml-16">
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
