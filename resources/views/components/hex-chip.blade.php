@props(['withDelete' => false])
<div {{ $attributes->class(['flex', 'flex-row', 'chip', "justify-stretch"]) }}>
    <svg class="h-full" preserveAspectRatio="xMinYMin" viewBox="0 0 32.8675 100">
        <path class="stroke-primary stroke-[.5rem] fill-neutral-100 dark:fill-neutral-700" d="M 32.8675 0 L 4 50 L 32.8675 100" />
    </svg>
    <div class="text-sm flex-1 w-full h-full flex items-center justify-center bg-neutral-100 dark:bg-neutral-700 border-primary border-t-[3px] border-b-[3px] text-neutral-900 dark:text-white">
        {{ $slot }}
        @if ($withDelete)
        <button class="cursor-pointer delete-btn">
            <x-icon.close class="w-4 h-4 ml-2 fill-neutral-900 dark:fill-white" />
        </button>
        @endif
    </div>
    <svg class="h-full" preserveAspectRatio="xMinYMin" viewBox="0 0 32.8675 100">
        <path class="stroke-primary stroke-[.5rem] fill-neutral-100 dark:fill-neutral-700" d="M 0 0 L 28.8675 50 L 0 100" />
    </svg>
</div>
