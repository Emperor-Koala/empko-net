<x-guest-layout>
    <div class="container mx-auto px-8 mt-8 flex flex-col justify-stretch mb-8">
        <div class="flex flex-row justify-end">
            <x-hex-button id="download-btn" class="w-40 h-8 text-white !text-base">
                <x-icon.download class="w-5 h-5 mr-2 fill-white" />
                Download
            </x-hex-button>
        </div>
        <div class="grid md:grid-cols-2 md:grid-rows-4">
            <h1 class="col-start-1 row-start-1 md:row-span-3 text-5xl font-bold text-gray-800 dark:text-gray-100">
                Matthew<br />Christensen
                <hr class="border-t-4 my-2 border-gray-800 dark:border-gray-100" />
            </h1>
            <h3 class="col-start-1 md:row-start-4 text-2xl font-semibold text-gray-700 dark:text-gray-300">{{-- $profileInfo['title'] --}}Software Developer</h3>
            <p class="md:col-start-2 md:row-start-2 md:justify-self-end dark:text-gray-300 pr-3 mt-2 md:mt-0">{{$profileInfo['location']}}</p>
            <x-hex-button href="/" variant="link" class="md:col-start-2 md:row-start-3 md:justify-self-end text-primary !text-base h-8 w-36 -ml-3 md:ml-0">www.empko.net</x-hex-button>
            <x-hex-button variant="link" class="md:col-start-2 md:row-start-4 md:justify-self-end text-primary !text-base h-8 w-[17rem] -ml-3 md:ml-0">{{$profileInfo['email']}}</x-hex-button>
        </div>
        <hr class="mt-6 mb-4 border-neutral-500" />

        <section class="flex flex-col md:flex-row gap-x-2 gap-y-4 text-gray-600 dark:text-gray-300">
            <h2 class="md:flex-1 text-3xl font-bold text-gray-750 dark:text-gray-200">Computer <span class="w-8 hidden md:max-lg:block"></span>Skills</h2>
            <div class="md:flex-2 flex flex-col justify-end gap-y-4">
                <h4 class="text-xl font-bold">Languages</h4>
                <div class="flex flex-row gap-x-4 ml-2">
                    <p class="mt-1">Proficient</p>
                    <div class="flex-1 flex flex-row flex-wrap gap-x-2 gap-y-2">
                        @foreach ($languages['proficient'] as $lang)
                            <x-hex-chip class="h-8">{{ $lang }}</x-hex-chip>
                        @endforeach
                    </div>
                </div>
                <div class="flex flex-row gap-x-4 ml-2">
                    <p class="mt-1">Familiar</p>
                    <div class="flex-1 flex flex-row flex-wrap gap-x-2 gap-y-2">
                        @foreach ($languages['familiar'] as $lang)
                            <x-hex-chip class="h-8">{{ $lang }}</x-hex-chip>
                        @endforeach
                    </div>
                </div>
                <h4 class="text-xl font-bold">Software</h4>
                <div class="flex flex-row gap-x-4 ml-2">
                    <p class="mt-1">Platforms</p>
                    <div class="flex-1 flex flex-row flex-wrap gap-x-2 gap-y-2">
                        @foreach ($software['platforms'] as $soft)
                            <x-hex-chip class="h-8">{{ $soft }}</x-hex-chip>
                        @endforeach
                    </div>
                </div>
                <div class="flex flex-row gap-x-4 ml-2">
                    <p class="mt-1">Programs</p>
                    <div class="flex-1 flex flex-row flex-wrap gap-x-2 gap-y-2">
                        @foreach ($software['programs'] as $soft)
                            <x-hex-chip class="h-8">{{ $soft }}</x-hex-chip>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        <hr class="mt-6 mb-4 border-neutral-500" />

        <section class="flex flex-col md:flex-row gap-x-2 gap-y-4 text-gray-600 dark:text-gray-300">
            <h2 class="md:flex-1 text-3xl font-bold text-gray-750 dark:text-gray-200">Experience</h2>
            <div class="md:flex-2 flex flex-col justify-end gap-y-4">
                @foreach ($experience as $job)
                    <div class="grid grid-cols-2 gap-y-2">
                        <h3 class="text-xl font-bold">{{ $job['company'] }}</h3>
                        <h4 class="text-lg font-bold justify-self-end">{{ $job['start_date']->format('F Y') }} - {{ $job['end_date']?->format('F Y') ?? 'Present' }}</h4>
                        <p class="italic">{{ $job['title'] }}</p>
                        <div class="col-start-1 col-span-2 markdown">
                            <ul>
                                @foreach (explode('*', $job['description']) as $point)
                                    @if (trim($point) === '') @continue @endif
                                    <li>{{ trim($point) }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

        <hr class="mt-6 mb-4 border-neutral-500" />

        <section class="flex flex-col md:flex-row gap-x-2 gap-y-4 text-gray-600 dark:text-gray-300">
            <h2 class="md:flex-1 text-3xl font-bold text-gray-750 dark:text-gray-200">Education</h2>
            <div class="md:flex-2 flex flex-col justify-end gap-y-4">
                @foreach ($education as $school)
                    <div class="grid grid-cols-2 gap-y-2">
                        <h3 class="text-xl font-bold ">{{ $school['school'] }}</h3>
                        <h4 class="text-lg font-bold justify-self-end">{{ $school['start_date']->format('F Y') }} - {{ $school['end_date']?->format('F Y') ?? 'Present' }}</h4>
                        <p class="italic">{{ $school['major'] }}</p>
                        <h4 class="text-lg font-bold justify-self-end">{{ $school['gpa'] }} GPA</h4>
                    </div>
                @endforeach
            </div>
        </section>

    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.9/pdfmake.min.js" integrity="sha512-5wC3oH3tojdOtHBV6B4TXjlGc0E2uk3YViSrWnv1VUmmVlQDAs1lcupsqqpwjh8jIuodzADYK5xCL5Dkg/ving==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="application/javascript">
        // playground requires you to assign document definition to a variable called dd

        const pdfDocDefinition = {
            content: [
                {
                    columns: [
                        [
                            {text: "Matthew\nChristensen", style: "h1"},
                            {canvas: [{type: 'line', x1: 0, y1: 5, x2: 250, y2: 5, lineWidth: 1.5, color: "#1f2937"}]},
                            {text: "{{ $profileInfo['title'] }}", marginTop: 8, style: "h3"},
                        ],
                        [
                            {text: "{{$profileInfo['location']}}", style: "right", marginTop: 27},
                            {text: "www.empko.net", style: ["right", "link"], link: "https://www.empko.net", margin: [0, 12]},
                            {text: "{{$profileInfo['email']}}", style: ["right", "link"], link: "mailto:{{ $profileInfo['email'] }}"},
                        ]
                    ]
                },
                {canvas: [{type: 'line', x1: 0, y1: 16, x2: 515, y2: 16, lineWidth: 1}]},
                {
                    marginTop: 8,
                    columns: [
                        {width: "40%", text: "Computer Skills", style: "h2"},
                        [
                            {text: "Languages", margin: [0, 4], bold: true},
                            {
                                margin: [8, 0, 0, 4],
                                columnGap: 4,
                                columns: [
                                    {width: "auto", text: "Proficient:", bold: true},
                                    {text: "{{ implode(', ', $languages['proficient']) }}"}
                                ]
                            },
                            {
                                margin: [8, 0, 0, 4],
                                columnGap: 4,
                                columns: [
                                    {width: "auto", text: "Familiar:", bold: true},
                                    {text: "{{ implode(', ', $languages['familiar']) }}"}
                                ]
                            },
                            {text: "Software", bold: true, margin: [0, 4]},
                            {
                                margin: [8, 0, 0, 4],
                                columnGap: 4,
                                columns: [
                                    {width: "auto", text: "Platforms:", bold: true},
                                    {text: "{{ implode(', ', $software['platforms']) }}"}
                                ]
                            },
                            {
                                margin: [8, 0, 0, 4],
                                columnGap: 4,
                                columns: [
                                    {width: "auto", text: "Programs:", bold: true},
                                    {text: "{{ implode(', ', $software['programs']) }}"}
                                ]
                            }
                        ]
                    ]
                },
                {canvas: [{type: 'line', x1: 0, y1: 16, x2: 515, y2: 16, lineWidth: 1}]},
                {
                    marginTop: 8,
                    columns: [
                        {width: "40%", text: "Experience", style: "h2"},
                        [
                            @foreach ($experience as $job)
                            {
                                @if (!$loop->first)
                                marginTop: 8,
                                @endif
                                columns: [
                                    {text: "{{$job['company']}}", bold: true},
                                    {text: "{{ $job['start_date']->format('F Y') }} - {{ $job['end_date']?->format('F Y') ?? 'Present' }}", alignment: "right", bold: true},
                                ],
                            },
                            {text: "{{$job['title']}}", italics: true, marginTop: 4, marginBottom: 4},
                            {
                                ul: [
                                    @foreach (explode('*', $job['description']) as $point)
                                    @if (trim($point) === '') @continue @endif
                                    "{{ trim($point) }}",
                                    @endforeach
                                ]
                            }
                            @endforeach
                        ]
                    ]
                },
                {canvas: [{type: 'line', x1: 0, y1: 16, x2: 515, y2: 16, lineWidth: 1}]},
                {
                    marginTop: 8,
                    columns: [
                        {width: "40%", text: "Education", style: "h2"},
                        [
                            @foreach ($education as $school)
                            {
                                @if (!$loop->first)
                                marginTop: 8,
                                @endif
                                columns: [
                                    [
                                        {text: "{{$school['school']}}", bold: true},
                                        {text: "{{$school['major']}}", italics: true, marginTop: 6},
                                    ],
                                    [
                                        {text: "{{ $school['start_date']->format('F Y') }} - {{ $school['end_date']?->format('F Y') ?? 'Present' }}", alignment: "right", bold: true},
                                        {text: "{{$school['gpa']}} GPA", alignment: "right", bold: true, marginTop: 6},
                                    ]
                                ]
                            },
                            @endforeach
                        ]
                    ]
                }
            ],
            defaultStyle: {font: "Ubuntu", fontSize: 10, color: "#1f2937"},
            styles: {
                h1: {fontSize: 28, bold: true, color: "#1f2937"},
                h2: {fontSize: 16, bold: true, color: "#2b3545"},
                h3: {fontSize: 14, bold: true, color: "#374151"},
                link: {color: "#1095c1"},
                italics: {italics: true},
                right: {alignment: "right"}
            }
        }

        pdfMake.fonts = {
            Ubuntu: {
                normal: "{{ Vite::asset('resources/fonts/ubuntu/Ubuntu-Regular.ttf') }}",
                bold: "{{ Vite::asset('resources/fonts/ubuntu/Ubuntu-Bold.ttf') }}",
                italics: "{{ Vite::asset('resources/fonts/ubuntu/Ubuntu-Italic.ttf') }}",
            }
        }

        $("#download-btn").click(function () {
            pdfMake.createPdf(pdfDocDefinition).download('Matthew_Christensen_Resume.pdf');
        });
    </script>
</x-guest-layout>
