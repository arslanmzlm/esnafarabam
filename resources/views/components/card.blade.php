<div
    {{ $attributes->merge(['class' => 'rounded-sm border border-stroke bg-white shadow-sm dark:border-strokedark dark:bg-boxdark']) }}
>
    @if ($title)
        <div class="border-b border-stroke px-6 py-4 dark:border-strokedark">
            <div class="text-title-sm font-bold text-black dark:text-white">
                {{ $title }}
            </div>
        </div>
    @endif

    <div class="space-y-5 p-6">
        {{ $slot }}
    </div>
</div>
