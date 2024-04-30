<x-admin-layout>
    <div class="m-6">
        <h2 class="flex flex-row text-3xl items-center">
            <x-icon.file class="w-7 h-7 dark:fill-white" />
            <span class="ml-2 dark:text-white font-bold">Resume</span>
        </h2>
        <hr class="mx-4 my-6 border-neutral-500" />
        <!-- Personal Info -->
        <div class="mx-4">
            <h3 class="dark:text-white text-xl font-medium">Personal Info</h3>
            <form id="profile-form" class="my-4 p-2 flex flex-col gap-y-4" action="/profile">
                @csrf
                <div>
                    <x-input-label for="email" value="Email" />
                    <x-text-input id="email" class="block mt-1 w-full dark:!bg-neutral-700 dark:!border-neutral-600 dark:focus:!border-primary" type="email" name="email" :value="$profileInfo['email']" required />
                </div>
                <div>
                    <x-input-label for="phone" value="Phone" />
                    <x-text-input id="phone" class="block mt-1 w-full dark:!bg-neutral-700 dark:!border-neutral-600 dark:focus:!border-primary" type="text" name="phone" :value="$profileInfo['phone']" required />
                </div>
                <div>
                    <x-input-label for="location" value="Location" />
                    <x-text-input id="location" class="block mt-1 w-full dark:!bg-neutral-700 dark:!border-neutral-600 dark:focus:!border-primary" type="text" name="location" :value="$profileInfo['location']" required />
                </div>
                <div>
                    <x-input-label for="title" value="Title" />
                    <x-text-input id="title" class="block mt-1 w-full dark:!bg-neutral-700 dark:!border-neutral-600 dark:focus:!border-primary" type="text" name="title" :value="$profileInfo['title']" required />
                </div>
                <div class="flex flex-row items-center gap-x-4 mt-2">
                    <x-hex-button class="w-24 h-8 text-white !text-base" type="submit" form="profile-form">
                        Save
                    </x-hex-button>
                    <div id="submit-status"></div>
                </div>
            </form>
            <script type="application/javascript">
                $("#profile-form").submit(function (event) {
                    event.preventDefault();
                    $("#submit-status").html(`<div class="border-4 border-neutral-500/50 border-t-primary rounded-full w-8 h-8 animate-spin"></div>`);
                    $.ajax({
                        type: "PATCH",
                        url: $(this).attr('action'),
                        data: $(this).serialize(),
                        success: function (data) {
                            console.log("success");
                            $("#submit-status").html(`<x-icon.circle-check class="inline w-6 h-6 fill-green-500" /><span class="ml-1 text-green-500 align-middle">Saved!</span>`);
                        },
                        error: function (data) {
                            console.log(data);
                            data = JSON.parse(data);
                            $("#submit-status").html(`<x-icon.error class="inline w-6 h-6 fill-red-500" /><span class="ml-1 text-red-500 align-middle">${data.email ?? data.phone ?? data.location ?? data.title ?? "Something went wrong, please try again later"}</span>`);
                        }
                    });
                });
            </script>
            <hr class="my-6 border-neutral-500" />
            <!-- Languages -->
            <h3 class="dark:text-white text-xl font-medium">Languages</h3>
            <x-input-label for="lang-proficient" value="Proficient" class="!text-lg ml-2 mt-2" />
            <div id="lang-proficient-list" class="flex flex-row flex-wrap ml-4 mb-2 gap-x-2 gap-y-2">
                @foreach ($languages['proficient'] as $language)
                <x-hex-chip data-id="{{ $language->id }}" class="h-8" with-delete>{{ $language->name }}</x-hex-chip>
                @endforeach
            </div>
            <div class="w-full pl-4 mt-1">
                <x-text-input id="lang-proficient" class="block w-full dark:!bg-neutral-700 dark:!border-neutral-600 dark:focus:!border-primary" type="text" name="lang-proficient" />
            </div>
            <x-input-label for="lang-familiar" value="Familiar" class="!text-lg ml-2 mt-4" />
            <div id="lang-familiar-list" class="flex flex-row flex-wrap ml-4 mb-2 gap-x-2 gap-y-2">
                @foreach ($languages['familiar'] as $language)
                <x-hex-chip data-id="{{ $language->id }}" class="h-8" with-delete>{{ $language->name }}</x-hex-chip>
                @endforeach
            </div>
            <div class="w-full pl-4 mt-1">
                <x-text-input id="lang-familiar" class="block w-full dark:!bg-neutral-700 dark:!border-neutral-600 dark:focus:!border-primary" type="text" name="lang-familiar" />
            </div>
            <script type="application/javascript">
                function addLanguageChip(list, input, level) {
                    $.ajax({
                        type: "POST",
                        url: "/languages",
                        data: {
                            name: input.val(),
                            _token: "{{ csrf_token() }}",
                            level: level,
                        },
                        success: function (data) {
                            if (data.name) {
                                list.append(`<x-hex-chip data-id="${data.id}" class="h-8" with-delete>${data.name}</x-hex-chip>`);
                            }
                            input.val("");
                        },
                        error: function (data) {
                            console.log(data);
                            // TODO show error
                        }
                    });
                }

                $("#lang-proficient").on("keypress", function (event) {
                    if (event.key === "Enter") {
                        addLanguageChip($("#lang-proficient-list"), $(this), "proficient");
                    }
                });

                $("#lang-familiar").on("keypress", function (event) {
                    if (event.key === "Enter") {
                        addLanguageChip($("#lang-familiar-list"), $(this), "familiar");
                    }
                });

                function deleteLang(chip) {
                    $.ajax({
                        type: "DELETE",
                        url: `/languages/${chip.data("id")}`,
                        data: {
                            _token: "{{ csrf_token() }}",
                        },
                        success: function (data) {
                            console.log(data);
                            chip.remove();
                        },
                        error: function (data) {
                            console.log(data);
                            // TODO show error
                        }
                    });
                }

                $("#lang-proficient-list").on("click", ".delete-btn", function () {
                    deleteLang($(this).parent().parent());
                });

                $("#lang-familiar-list").on("click", ".delete-btn", function () {
                    deleteLang($(this).parent().parent());
                });
            </script>
            <hr class="my-6 border-neutral-500" />
            <!-- Software -->
            <h3 class="dark:text-white text-xl font-medium">Software</h3>
            <x-input-label for="soft-platforms" value="Platform" class="!text-lg ml-2 mt-2" />
            <div id="soft-platform-list" class="flex flex-row flex-wrap ml-4 mb-2 gap-x-2 gap-y-2">
                @foreach ($software['platforms'] as $soft)
                <x-hex-chip data-id="{{ $soft->id }}" class="h-8" with-delete>{{ $soft->name }}</x-hex-chip>
                @endforeach
            </div>
            <div class="w-full pl-4 mt-1">
                <x-text-input id="soft-platforms" class="block w-full dark:!bg-neutral-700 dark:!border-neutral-600 dark:focus:!border-primary" type="text" name="soft-platforms" />
            </div>
            <x-input-label for="soft-programs" value="Programs" class="!text-lg ml-2 mt-4" />
            <div id="soft-program-list" class="flex flex-row flex-wrap ml-4 mb-2 gap-x-2 gap-y-2">
                @foreach ($software['programs'] as $soft)
                <x-hex-chip data-id="{{ $soft->id }}" class="h-8" with-delete>{{ $soft->name }}</x-hex-chip>
                @endforeach
            </div>
            <div class="w-full pl-4 mt-1">
                <x-text-input id="soft-programs" class="block w-full dark:!bg-neutral-700 dark:!border-neutral-600 dark:focus:!border-primary" type="text" name="soft-programs" />
            </div>
            <script type="application/javascript">
                function addSoftwareChip(list, input, type) {
                    $.ajax({
                        type: "POST",
                        url: "/software",
                        data: {
                            name: input.val(),
                            _token: "{{ csrf_token() }}",
                            type: type,
                        },
                        success: function (data) {
                            if (data.name) {
                                list.append(`<x-hex-chip data-id="${data.id}" class="h-8" with-delete>${data.name}</x-hex-chip>`);
                            }
                            input.val("");
                        },
                        error: function (data) {
                            console.log(data);
                            // TODO show error
                        }
                    });
                }

                $("#soft-platforms").on("keypress", function (event) {
                    if (event.key === "Enter") {
                        addSoftwareChip($("#soft-platform-list"), $(this), "platform");
                    }
                });

                $("#soft-programs").on("keypress", function (event) {
                    if (event.key === "Enter") {
                        addSoftwareChip($("#soft-program-list"), $(this), "program");
                    }
                });

                function deleteSoftware(chip) {
                    $.ajax({
                        type: "DELETE",
                        url: `/software/${chip.data("id")}`,
                        data: {
                            _token: "{{ csrf_token() }}",
                        },
                        success: function (data) {
                            console.log(data);
                            chip.remove();
                        },
                        error: function (data) {
                            console.log(data);
                            // TODO show error
                        }
                    });
                }

                $("#soft-platform-list").on("click", ".delete-btn", function () {
                    deleteSoftware($(this).parent().parent());
                });

                $("#soft-program-list").on("click", ".delete-btn", function () {
                    deleteSoftware($(this).parent().parent());
                });
            </script>
            <hr class="my-6 border-neutral-500" />
            <!-- Experience -->
            <div class="flex flex-row gap-x-2">
                <h3 class="dark:text-white text-xl font-medium">Experience</h3>
                <x-hex-button id="new-experience" class="w-44 h-8 dark:text-white">
                    <x-icon.plus class="w-4 h-4 dark:fill-white mr-1" />
                    New Experience
                </x-hex-button>
            </div>
            <div id="experience-list" class="flex flex-col mt-2">
                <script type="application/javascript">let experiences = {};</script>
                @foreach ($experience as $exp)
                <div class="exp-wrapper" data-id="{{$exp->id}}">
                    <hr class="mx-4 my-2 border-neutral-500" />
                    <div class="flex flex-row mx-4 gap-x-4">
                        <div>
                            <p class="dark:text-white text-lg font-medium">{{ $exp->company }}</p>
                            <p class="dark:text-white">{{ $exp->title }}</p>
                            <p class="dark:text-white text-sm">{{ $exp->start_date->format('F Y') }} - {{$exp->end_date?->format('F Y') ?? 'Present'}}</p>
                        </div>
                        <div>
                            <x-hex-button class="w-10 h-8 dark:text-white my-1 edit-btn" data-id="{{ $exp->id }}" >
                                <x-icon.edit class="w-4 h-4 dark:fill-white" />
                            </x-hex-button>
                            <x-hex-button class="w-10 h-8 dark:text-white my-1 delete-btn" data-id="{{$exp->id}}">
                                <x-icon.trash class="w-4 h-4 dark:fill-white" />
                            </x-hex-button>
                        </div>
                    </div>
                </div>
                <script type="application/javascript">experiences[{{$exp->id}}] = {{ Js::from($exp->toArray()) }};</script>
                @endforeach
            </div>
            <script type="application/javascript">
                $("#new-experience").on("click", function () {
                    let modal = $("#experience-modal");
                    let form = $("#experience-form");
                    form.attr("action", "/experience");
                    form.attr("method", "POST");
                    form.trigger("reset");
                    modal.show();
                });

                $("#experience-list").on('click', ".edit-btn", function () {
                    let modal = $("#experience-modal");
                    let id = $(this).data("id");
                    let data = experiences[id];
                    let form = $("#experience-form");
                    form.attr("action", `/experience/${data.id}`);
                    form.attr("method", "PATCH");
                    form.trigger("reset");
                    $("#exp-company").val(data.company);
                    $("#exp-title").val(data.title);
                    $("#exp-start-date").val(new Date(data.start_date).toISOString().slice(0, 10));
                    if (data.end_date)
                        $("#exp-end-date").val(new Date(data.end_date).toISOString().slice(0, 10));
                    $("#exp-description").val(data.description);
                    modal.show();
                });

                $("#experience-list").on('click', ".delete-btn", function () {
                    let id = $(this).data("id");
                    $.ajax({
                        type: "DELETE",
                        url: `/experience/${id}`,
                        data: {
                            _token: "{{ csrf_token() }}",
                        },
                        success: function (data) {
                            $(`.exp-wrapper[data-id=${id}]`).remove();
                        },
                        error: function (data) {
                            console.log(data);
                            // TODO show error
                        }
                    });
                });
            </script>
            <hr class="my-6 border-neutral-500" />
            <!-- Education -->
            <div class="flex flex-row gap-x-2">
                <h3 class="dark:text-white text-xl font-medium">Education</h3>
                <x-hex-button id="new-school" class="w-44 h-8 dark:text-white">
                    <x-icon.plus class="w-4 h-4 dark:fill-white mr-1" />
                    New School
                </x-hex-button>
            </div>
            <div id="education-list" class="flex flex-col mt-2">
                <script type="application/javascript">let schools = {};</script>
                @foreach ($education as $school)
                <div class="edu-wrapper" data-id="{{$school->id}}">
                    <hr class="mx-4 my-2 border-neutral-500" />
                    <div class="flex flex-row mx-4 gap-x-4">
                        <div>
                            <p class="dark:text-white text-lg font-medium">{{ $school->school }}</p>
                            <p class="dark:text-white">{{ $school->major }} - {{ $school->gpa }}</p>
                            <p class="dark:text-white text-sm">{{ $school->start_date->format('F Y') }} - {{$school->end_date?->format('F Y') ?? 'Present'}}</p>
                        </div>
                        <div>
                            <x-hex-button class="w-10 h-8 dark:text-white my-1 edit-btn" data-id="{{ $school->id }}" >
                                <x-icon.edit class="w-4 h-4 dark:fill-white" />
                            </x-hex-button>
                            <x-hex-button class="w-10 h-8 dark:text-white my-1 delete-btn" data-id="{{$school->id}}">
                                <x-icon.trash class="w-4 h-4 dark:fill-white" />
                            </x-hex-button>
                        </div>
                    </div>
                </div>
                <script type="application/javascript">schools[{{$school->id}}] = {{ Js::from($school->toArray()) }};</script>
                @endforeach
            </div>
            <script type="application/javascript">
                $("#new-school").on("click", function () {
                    let modal = $("#education-modal");
                    let form = $("#education-form");
                    form.attr("action", "/schools");
                    form.attr("method", "POST");
                    form.trigger("reset");
                    modal.show();
                });

                $("#education-list").on('click', ".edit-btn", function () {
                    let modal = $("#education-modal");
                    let id = $(this).data("id");
                    let data = schools[id];
                    let form = $("#education-form");
                    form.attr("action", `/schools/${data.id}`);
                    form.attr("method", "PATCH");
                    form.trigger("reset");
                    $("#edu-school").val(data.school);
                    $("#edu-major").val(data.major);
                    $("#edu-gpa").val(data.gpa);
                    $("#edu-start-date").val(new Date(data.start_date).toISOString().slice(0, 10));
                    if (data.end_date)
                        $("#edu-end-date").val(new Date(data.end_date).toISOString().slice(0, 10));
                    modal.show();
                });

                $("#education-list").on('click', ".delete-btn", function () {
                    let id = $(this).data("id");
                    $.ajax({
                        type: "DELETE",
                        url: `/schools/${id}`,
                        data: {
                            _token: "{{ csrf_token() }}",
                        },
                        success: function (data) {
                            $(`.edu-wrapper[data-id=${id}]`).remove();
                        },
                        error: function (data) {
                            console.log(data);
                            // TODO show error
                        }
                    });
                });
            </script>
        </div>
    </div>

    <div id="experience-modal" class="hidden fixed bg-neutral-500/50 inset-0">
        <div class="absolute left-2/4 top-2/4 -translate-x-2/4 -translate-y-2/4 w-2/4">
            <form id="experience-form" class="p-6 bg-white dark:bg-neutral-800 rounded-lg shadow-xl w-full">
                @csrf
                <div class="my-2">
                    <x-input-label for="exp-company" value="Company" />
                    <x-text-input id="exp-company" class="block mt-1 w-full dark:!bg-neutral-700 dark:!border-neutral-600 dark:focus:!border-primary" type="text" name="company" required />
                </div>
                <div class="my-2">
                    <x-input-label for="exp-title" value="Title" />
                    <x-text-input id="exp-title" class="block mt-1 w-full dark:!bg-neutral-700 dark:!border-neutral-600 dark:focus:!border-primary" type="text" name="title" required />
                </div>
                <div class="flex flex-row flex-wrap gap-x-4 gap-y-2 my-2">
                    <div class="flex-1">
                        <x-input-label for="exp-start-date" value="Start Date" />
                        <x-text-input id="exp-start-date" class="block mt-1 w-full dark:!bg-neutral-700 dark:!border-neutral-600 dark:focus:!border-primary" type="date" name="start_date" required />
                    </div>
                    <div class="flex-1">
                        <x-input-label for="exp-end-date" value="End Date" />
                        <x-text-input id="exp-end-date" class="block mt-1 w-full dark:!bg-neutral-700 dark:!border-neutral-600 dark:focus:!border-primary" type="date" name="end_date" />
                    </div>
                </div>
                <div class="my-2">
                    <x-input-label for="exp-description" value="Description" />
                    <x-text-area id="exp-description" class="block mt-1 w-full dark:!bg-neutral-700 dark:!border-neutral-600 dark:focus:!border-primary" name="description" required></x-text-area>
                </div>
                <x-hex-button class="w-24 h-8 text-white mt-2 !text-base" type="submit" form="experience-form">
                    Save
                </x-hex-button>
            </form>
        </div>
        <script type="application/javascript">
            function closeExperienceModal() {
                $("#experience-modal").hide();
                $("#experience-form").trigger("reset");
                $("#experience-form").attr("method", "");
                $("#experience-form").attr("action", "");
            }
            $("#experience-form").submit(function (event) {
                event.preventDefault();
                console.log($(this).serialize());
                $.ajax({
                    type: $(this).attr('method'),
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    success: function (data) {
                        console.log(data);
                        let formatter = new Intl.DateTimeFormat('en-US', {
                            month: "long",
                            year: "numeric",
                            timeZone: "UTC"
                        });
                        console.log(data.start_date);
                        let start_date = new Date(data.start_date);
                        let end_date = data.end_date ? new Date(data.end_date) : null;
                        experiences[data.id] = data;
                        if ($(`.exp-wrapper[data-id=${data.id}]`).length) {
                            $(`.exp-wrapper[data-id=${data.id}]`).remove();
                        }
                        $("#experience-list").append(`
                        <div class="exp-wrapper" data-id="${data.id}">
                            <hr class="mx-4 my-2 border-neutral-500" />
                            <div class="flex flex-row mx-4 gap-x-4">
                                <div>
                                    <p class="dark:text-white text-lg font-medium">${data.company}</p>
                                    <p class="dark:text-white">${data.title}</p>
                                    <p class="dark:text-white text-sm">${formatter.format(start_date)} - ${end_date ? formatter.format(end_date) : 'Present'}</p>
                                </div>
                                <div>
                                    <x-hex-button class="w-10 h-8 dark:text-white my-1 edit-btn" data-id="${data.id}" >
                                        <x-icon.edit class="w-4 h-4 dark:fill-white" />
                                    </x-hex-button>
                                    <x-hex-button class="w-10 h-8 dark:text-white my-1 delete-btn" data-id="${data.id}">
                                        <x-icon.trash class="w-4 h-4 dark:fill-white" />
                                    </x-hex-button>
                                </div>
                            </div>
                        </div>
                        `)
                        closeExperienceModal();
                    },
                    error: function (data) {
                        console.log(data);
                        // TODO
                    }
                });
            });

            $("#experience-modal").on("click", function (event) {
                if (event.target === this) {
                    closeExperienceModal();
                }
            });
        </script>
    </div>

    <div id="education-modal" class="hidden fixed bg-neutral-500/50 inset-0">
        <div class="absolute left-2/4 top-2/4 -translate-x-2/4 -translate-y-2/4 w-2/4">
            <form id="education-form" class="p-6 bg-white dark:bg-neutral-800 rounded-lg shadow-xl w-full">
                @csrf
                <div class="my-2">
                    <x-input-label for="edu-school" value="School" />
                    <x-text-input id="edu-school" class="block mt-1 w-full dark:!bg-neutral-700 dark:!border-neutral-600 dark:focus:!border-primary" type="text" name="school" required />
                </div>
                <div class="flex flex-row flex-wrap gap-x-4 gap-y-2 my-2">
                    <div class="flex-1">
                        <x-input-label for="edu-majpr" value="Degree" />
                        <x-text-input id="edu-major" class="block mt-1 w-full dark:!bg-neutral-700 dark:!border-neutral-600 dark:focus:!border-primary" type="text" name="major" required />
                    </div>
                    <div>
                        <x-input-label for="edu-gpa" value="GPA" />
                        <x-text-input id="edu-gpa" class="block mt-1 w-full dark:!bg-neutral-700 dark:!border-neutral-600 dark:focus:!border-primary" type="text" name="gpa" required />
                    </div>
                </div>
                <div class="flex flex-row flex-wrap gap-x-4 gap-y-2 my-2">
                    <div class="flex-1">
                        <x-input-label for="edu-start-date" value="Start Date" />
                        <x-text-input id="edu-start-date" class="block mt-1 w-full dark:!bg-neutral-700 dark:!border-neutral-600 dark:focus:!border-primary" type="date" name="start_date" required />
                    </div>
                    <div class="flex-1">
                        <x-input-label for="edu-end-date" value="End Date" />
                        <x-text-input id="edu-end-date" class="block mt-1 w-full dark:!bg-neutral-700 dark:!border-neutral-600 dark:focus:!border-primary" type="date" name="end_date" />
                    </div>
                </div>
                <x-hex-button class="w-24 h-8 text-white mt-2 !text-base" type="submit" form="education-form">
                    Save
                </x-hex-button>
            </form>
        </div>
        <script type="application/javascript">
            function closeSchoolModal() {
                $("#education-modal").hide();
                $("#education-form").trigger("reset");
                $("#education-form").attr("method", "");
                $("#education-form").attr("action", "");
            }
            $("#education-form").submit(function (event) {
                event.preventDefault();
                console.log($(this).serialize());
                $.ajax({
                    type: $(this).attr('method'),
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    success: function (data) {
                        console.log(data);
                        let formatter = new Intl.DateTimeFormat('en-US', {
                            month: "long",
                            year: "numeric",
                            timeZone: "UTC"
                        });
                        console.log(data.start_date);
                        let start_date = new Date(data.start_date);
                        let end_date = data.end_date ? new Date(data.end_date) : null;
                        schools[data.id] = data;
                        if ($(`.edu-wrapper[data-id=${data.id}]`).length) {
                            $(`.edu-wrapper[data-id=${data.id}]`).remove();
                        }
                        $("#education-list").append(`
                        <div class="edu-wrapper" data-id="${data.id}">
                            <hr class="mx-4 my-2 border-neutral-500" />
                            <div class="flex flex-row mx-4 gap-x-4">
                                <div>
                                    <p class="dark:text-white text-lg font-medium">${data.school}</p>
                                    <p class="dark:text-white">${data.major}</p>
                                    <p class="dark:text-white text-sm">${formatter.format(start_date)} - ${end_date ? formatter.format(end_date) : 'Present'}</p>
                                </div>
                                <div>
                                    <x-hex-button class="w-10 h-8 dark:text-white my-1 edit-btn" data-id="${data.id}" >
                                        <x-icon.edit class="w-4 h-4 dark:fill-white" />
                                    </x-hex-button>
                                    <x-hex-button class="w-10 h-8 dark:text-white my-1 delete-btn" data-id="${data.id}">
                                        <x-icon.trash class="w-4 h-4 dark:fill-white" />
                                    </x-hex-button>
                                </div>
                            </div>
                        </div>
                        `)
                        closeSchoolModal();
                    },
                    error: function (data) {
                        console.log(data);
                        // TODO
                    }
                });
            });

            $("#education-modal").on("click", function (event) {
                if (event.target === this) {
                    closeSchoolModal();
                }
            });
        </script>
    </div>
</x-admin-layout>
