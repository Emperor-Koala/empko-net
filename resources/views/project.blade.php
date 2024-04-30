<x-guest-layout>
    <div class="md:absolute inset-0 mt-8 md:mt-0 flex items-center h-full">
        <div class="container md:max-w-2xl lg:max-w-4xl xl:max-w-6xl mx-auto">
            <h1 class="font-bold text-4xl dark:text-white">{{$project->title}}</h1>
            <div class="flex flex-col md:flex-row px-10 md:px-0 justify-center items-center">
                <div class="flex-1 w-full xl:p-16 max-w-sm md:max-w-none">
                    <div class="bg-neutral-200 dark:bg-neutral-700 rounded-md shadow-md overflow-hidden">
                        <div class="w-full aspect-video">
                            <section id="splide-{{$project->id}}" class="splide" aria-label="Image slider">

                                <div class="splide__arrows">
                                    <x-hex-button class="splide__arrow splide__arrow--prev !w-8 !h-auto !bg-transparent" vertical variant="link">
                                        <x-icon.chevron-right class="!w-6 !h-6 dark:fill-white" />
                                    </x-hex-button>
                                    <x-hex-button class="splide__arrow splide__arrow--next !w-8 !h-auto !bg-transparent" vertical variant="link">
                                        <x-icon.chevron-right class="!w-6 !h-6 dark:fill-white" />
                                    </x-hex-button>
                                </div>

                                <div class="splide__track">
                                    <ul class="splide__list">
                                        @foreach ($project->images as $image)
                                            <li class="splide__slide">
                                                <img src="{{ url('storage/' . $image->file->path) }}" alt="{{ $image->name }}" class="w-full h-full object-cover" />
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </section>
                        </div>
                        <div class="p-4">
                            <h4 class="underline text-xl dark:text-white font-bold">Languages</h4>
                            <div class="flex flex-row flex-wrap gap-x-3 mt-2">
                                @foreach ($project->languages as $lang)
                                    <x-hex-chip class="h-8">{{ $lang->name }}</x-hex-chip>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex-1 flex flex-col items-center xl:p-16 md:pl-10 lg:pl-16 mt-5 md:mt-0">
                    <p class="dark:text-white text-lg mt-1.5 opacity-85 mb-1.5">{{$project->description}}</p>
                    @foreach ($project->languages as $lang)
                        @if ($lang->repo_link)
                            <x-hex-button href="{{$lang->repo_link}}" class="w-full h-14 my-1.5 text-white text-xl" variant="github">
                                <x-icon.github class="w-6 h-6 mr-2 fill-white" />
                                {{$lang->name}}
                            </x-hex-button>
                        @endif
                        @if ($lang->demo_link)
                            <x-hex-button href="{{$lang->demo_link}}" class="w-full h-14 my-1.5 text-white text-xl" variant="primary">
                                <x-icon.desktop class="w-6 h-6 mr-2 fill-white" />
                                {{$lang->name}} - Demo
                            </x-hex-button>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <script type="application/javascript">
        $(document).ready(function () {
            new Splide('#splide-{{$project->id}}', {
                type: 'loop',
                perPage: 1,
                pagination: true,
                arrows: true,
                drag: false,
                autoplay: false,
                wheel: false,
            }).mount();
        });
    </script>
</x-guest-layout>
