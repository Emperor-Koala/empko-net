<x-guest-layout>
    <div class="md:absolute inset-0 mt-8 md:mt-0 flex items-center h-full">
        <div class="container md:max-w-2xl lg:max-w-4xl xl:max-w-6xl mx-auto">
            <div class="flex flex-col md:flex-row px-10 md:px-0 justify-center items-center">
                <div class="flex-1 w-full xl:p-16 md:pr-10 lg:pr-16 mb-5 md:mb-0 max-w-sm md:max-w-none">
                    <x-headshot />
                </div>
                <div class="flex-1 flex flex-col items-center xl:p-16 md:pl-10 lg:pl-16 mt-5 md:mt-0">
                    <h3 class="dark:text-gray-200 text-center text-3xl font-bold">
                        Matthew<br />&quot;Emperor Koala&quot;<br />Christensen
                    </h3>
                    <span class="text-center dark:text-gray-200 text-xl font-bold mt-1.5 opacity-85">Professional Developer</span>
                    <span class="text-center dark:text-gray-200 text-xl font-bold mt-1.5 opacity-85 mb-3">Part-Time Tinkerer</span>
                    <x-hex-button href="/resume" class="w-full h-14 my-1.5 text-white text-xl">Résumé</x-hex-button>
                    <x-hex-button href="/projects" class="w-full h-14 my-1.5 text-white text-xl">Portfolio</x-hex-button>
                    <x-hex-button href="https://github.com/Emperor-Koala" class="w-full h-14 my-1.5 text-white text-xl" variant="github">
                        <x-icon.github class="w-6 h-6 mr-2 fill-white" />
                        GitHub
                    </x-hex-button>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
