@props(['variant' => 'primary', 'href' => false, 'vertical' => false, "type" => "button"])

@php
    switch ($variant) {
        case 'primary':
            $svgClasses = '!fill-primary group-hover:!fill-primary-400 group-active:!fill-primary-600';
            $middleClasses = 'bg-primary group-hover:bg-primary-400 group-active:bg-primary-600';
            break;
        case 'github':
            $svgClasses = '!fill-github group-hover:!fill-github-400 group-active:!fill-github-600';
            $middleClasses = 'bg-github group-hover:bg-github-400 group-active:bg-github-600';
            break;
        case 'link':
            $svgClasses = '!fill-transparent group-hover:!fill-black/20 group-active:!fill-black/40 dark:group-hover:!fill-white/20 dark:group-active:!fill-white/40';
            $middleClasses = 'bg-transparent group-hover:bg-black/20 group-active:bg-black/40 dark:group-hover:bg-white/20 dark:group-active:bg-white/40';
            break;
        case 'danger':
            $svgClasses = '!fill-red-500 group-hover:!fill-red-400 group-active:!fill-red-600';
            $middleClasses = 'bg-red-500 group-hover:bg-red-400 group-active:bg-red-600';
            break;
        default:
            $svgClasses = '!fill-primary group-hover:!fill-primary-400 group-active:!fill-primary-600';
            $middleClasses = 'bg-primary group-hover:bg-primary-400 group-active:bg-primary-600';
            break;
    }

    if ($vertical) {
        $wrapperClasses = ['flex', 'flex-col', 'group', 'cursor-pointer'];
    } else {
        $wrapperClasses = ['flex', 'flex-row', 'group', 'cursor-pointer'];
    }
@endphp

@if ($href)
<a href="{{ $href }}" {{ $attributes->twMerge($wrapperClasses) }}>
@else
<button {{ $attributes->twMerge($wrapperClasses) }} type="{{$type}}">
@endif
    @if ($vertical)
    <svg class="{{$svgClasses}} transition-colors" preserveAspectRatio="xMinYMin" viewBox="0 0 100 28.8675">
        <polygon stroke-width="2px" points="50 0 0 28.8675 100 28.8675" />
    </svg>
    @else
    <svg class="{{$svgClasses}} transition-colors" preserveAspectRatio="xMinYMin" viewBox="0 0 28.8675 100">
        <polygon stroke-width="2px" points="0 50 28.8675 0 28.8675 100" />
    </svg>
    @endif
    <div class="flex-1 w-full h-full flex items-center justify-center {{$middleClasses}} transition-colors">
        {{ $slot }}
    </div>

    @if ($vertical)
    <svg class="{{$svgClasses}} transition-colors" preserveAspectRatio="xMinYMin" viewBox="0 0 100 28.8675">
        <polygon stroke-width="2px" points="0 0 100 0 50 28.8675" />
    </svg>
    @else
    <svg class="{{$svgClasses}} transition-colors" preserveAspectRatio="xMinYMin" viewBox="0 0 28.8675 100">
        <polygon stroke-width="2px" points="28.8675 50 0 0 0 100" />
    </svg>
    @endif
@if ($href)
</a>
@else
</button>
@endif
