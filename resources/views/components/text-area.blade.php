@props(['disabled' => false])

<textarea {{ $disabled ? 'disabled' : '' }} {{ $attributes->twMerge(['border-neutral-300 dark:border-neutral-700 dark:bg-neutral-800 dark:text-gray-300 focus:border-primary dark:focus:border-primary focus:ring-primary rounded-md shadow-sm']) }}>{{$slot}}</textarea>
