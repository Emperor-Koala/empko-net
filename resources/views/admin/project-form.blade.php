<x-admin-layout>
    <div class="m-6">
        <div class="flex flex-col gap-y-4">
            <h1 class="text-3xl font-bold dark:text-white">@if($project['id']) Edit Project @else New Project @endif</h1>
            <form id="project-form" class="flex flex-col gap-y-4" method="POST"  @if ($project['id']) action="/admin/projects/{{$project['id']}}" @else action="/admin/projects" @endif>
                @if ($project['id']) @method('PATCH') @endif
                @csrf
                <div class="flex flex-col gap-y-2">
                    <x-input-label for="title" class="font-bold text-base">Title</x-input-label>
                    <x-text-input type="text" name="title" id="title" value="{{$project['title']}}" class="block mt-1 w-full dark:!bg-neutral-700 dark:!border-neutral-600 dark:focus:!border-primary" />
                </div>

                <div class="flex flex-col gap-y-2">
                    <div class="flex flex-row gap-x-2 items-center">
                        <x-input-label for="image" class="font-bold text-base">Images</x-input-label>
                        <x-hex-button id="file-upload-button" class="w-24 h-8 text-white">Add</x-hex-button>
                        <input type="file" id="file-upload" class="hidden" accept="image/*" />
                    </div>
                    <div id="image-list-wrapper" class="flex flex-row flex-wrap items-stretch gap-x-3 gap-y-2 py-2">
                        @foreach ($project['images'] as $image)
                            <div class="relative h-24 project-image">
                                <img src="{{ url('storage/' . $image['file']['path']) }}" alt="Screenshot" class="w-full h-full object-cover" />
                                <x-hex-button class="absolute -top-1 -right-2 w-8 h-6 img-delete-button" variant="danger">
                                    <x-icon.close class="fill-white h-4"></x-icon.close>
                                </x-hex-button>
                            </div>
                            <input type="hidden" name="file_ids[]" value="{{$image['id']}}" />
                        @endforeach
                    </div>
                </div>

                <div class="flex flex-col gap-y-2">
                    <x-input-label for="description" class="font-bold text-base">Description</x-input-label>
                    <x-text-area name="description" id="description" class="block mt-1 w-full dark:!bg-neutral-700 dark:!border-neutral-600 dark:focus:!border-primary">{{$project['description']}}</x-text-area>
                </div>

                <div class="flex flex-col gap-y-2">
                    <div class="flex flex-row gap-x-3 items-center">
                        <x-input-label class="font-bold text-base">Languages</x-input-label>
                        <x-hex-button id="add-language" class="w-24 h-8 text-white">Add</x-hex-button>
                    </div>
                    <div id="languages-wrapper" class="flex flex-col gap-y-2">
                        @foreach ($project['languages'] as $index => $lang)
                        <div class="flex flex-row gap-x-2">
                            <input type="hidden" name="languages[{{$index}}][id]" value="{{$lang->id}}" />
                            <x-text-input placeholder="Language" name="languages[{{$index}}][name]" value="{{$lang->name}}" class="block flex-1 dark:!bg-neutral-700 dark:!border-neutral-600 dark:focus:!border-primary" />
                            <x-text-input placeholder="Repo Link" name="languages[{{$index}}][repo_link]" value="{{$lang->repo_link}}" class="block flex-1 dark:!bg-neutral-700 dark:!border-neutral-600 dark:focus:!border-primary" />
                            <x-text-input placeholder="Demo Link" name="languages[{{$index}}][demo_link]" value="{{$lang->demo_link}}" class="block flex-1 dark:!bg-neutral-700 dark:!border-neutral-600 dark:focus:!border-primary" />
                            <x-hex-button class="w-10 h-8 text-white delete-language" variant="danger">
                                <x-icon.close class="fill-white h-4"></x-icon.close>
                            </x-hex-button>
                        </div>
                        @endforeach
                    </div>
                </div>

                <x-hex-button class="w-24 h-10 text-white" type="submit">Save</x-hex-button>
            </form>
        </div>
    </div>
    <script type="application/javascript">
        $('#file-upload-button').on('click', function() {
            $('#file-upload').click();
        });

        $('#file-upload').on('change', function() {
            let formData = new FormData();
            formData.append('_token', '{{ csrf_token() }}');
            formData.append('file', $(this).prop('files')[0]);
            $.ajax({
                url: '/admin/files',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(data) {
                    $('#image-list-wrapper').append(`
                        <div class="relative h-24 project-image" data-file-id="${data.id}">
                            <img src="/storage/${data.path}" alt="Screenshot" class="w-full h-full object-cover" />
                            <x-hex-button class="absolute -top-1 -right-2 w-8 h-6 img-delete-button" variant="danger">
                                <x-icon.close class="fill-white h-4"></x-icon.close>
                            </x-hex-button>
                        </div>
                        <input type="hidden" name="file_ids[]" value="${data.id}" />
                    `);
                }
                // TODO show error
            });

        });

        $('#image-list-wrapper').on('click', '.img-delete-button', function() {
            console.log("delete image");
            let fileId = $(this).parent().data('file-id');
            let confirmDelete = confirm("Are you sure you want to delete this image? This cannot be undone.");
            if (confirmDelete) {
                $.ajax({
                    url: `/admin/files/${fileId}`,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function() {
                        $(this).parent().remove();
                    }
                    // TODO show error
                });
            }
        });

        $('#add-language').on('click', function() {
            $("#languages-wrapper").append(`
                <div class="flex flex-row gap-x-2 items-center">
                    <x-text-input placeholder="Language" class="block flex-1 dark:!bg-neutral-700 dark:!border-neutral-600 dark:focus:!border-primary" />
                    <x-text-input placeholder="Repo Link" class="block flex-1 dark:!bg-neutral-700 dark:!border-neutral-600 dark:focus:!border-primary" />
                    <x-text-input placeholder="Demo Link" class="block flex-1 dark:!bg-neutral-700 dark:!border-neutral-600 dark:focus:!border-primary" />
                    <x-hex-button class="w-10 h-8 text-white delete-language" variant="danger">
                        <x-icon.close class="fill-white h-4"></x-icon.close>
                    </x-hex-button>
                </div>
            `);
            $("#languages-wrapper").children().each(function(index) {
                $(this).find('input').eq(0).attr('name', `languages[${index}][name]`);
                $(this).find('input').eq(1).attr('name', `languages[${index}][repo_link]`);
                $(this).find('input').eq(2).attr('name', `languages[${index}][demo_link]`);
            });
        });

        $('#languages-wrapper').on('click', '.delete-language', function() {
            let wrapper = $(this).parent().parent();
            $(this).parent().remove();

            wrapper.children().each(function(index) {
                $(this).find('input').eq(0).attr('name', `languages[${index}][name]`);
                $(this).find('input').eq(1).attr('name', `languages[${index}][repo_link]`);
                $(this).find('input').eq(2).attr('name', `languages[${index}][demo_link]`);
            });
        });
    </script>
</x-admin-layout>
