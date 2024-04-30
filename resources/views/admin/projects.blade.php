<x-admin-layout>
    <div class="m-6">
        <div class="flex flex-row justify-between items-center">
            <h2 class="flex flex-row text-3xl items-center">
                <x-icon.folder class="w-7 h-7 dark:fill-white" />
                <span class="ml-2 dark:text-white font-bold">Projects</span>
            </h2>
            <x-hex-button href="/admin/projects/create" class="w-36 h-10 text-white">
                <x-icon.plus class="w-5 h-5 mr-2 fill-white" />
                New Project
            </x-hex-button>
        </div>
        <hr class="mx-4 my-6 border-neutral-500" />

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($projects as $project)
                <div class="bg-neutral-200 dark:bg-neutral-700 rounded-md shadow-md overflow-hidden">
                    <div class="w-full aspect-video">
                        <section id="splide-proj-id" class="splide" aria-label="Image slider">

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
                        <h3 class="dark:text-white text-2xl font-bold">{{$project->title}}</h3>
                        <div class="flex flex-row flex-wrap gap-x-3 mt-2">
                            @foreach ($project->languages as $lang)
                                <x-hex-chip class="h-8">{{ $lang->name }}</x-hex-chip>
                            @endforeach
                        </div>
                        <p class="dark:text-white mt-2">{{explode(".", $project->description)[0]}}</p>
                        <x-hex-button href="/admin/projects/{{$project->id}}/edit" class="h-8 mt-4 text-white" variant="primary">Edit</x-hex-button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <script type="application/javascript">
        $(document).ready(function () {
            Splide.defaults = {
                type: 'loop',
                perPage: 1,
                pagination: true,
                arrows: true,
                drag: false,
                autoplay: false,
                wheel: false,
            };
            for (const slider of document.querySelectorAll('.splide')) {
                new Splide(slider).mount();
            }
        });
    </script>
</x-admin-layout>
