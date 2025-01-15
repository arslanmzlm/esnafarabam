<a href="{{ route('item.detail', [$item->id, $item->slug]) }}" class="flex gap-2 bg-white p-2">
    @if ($item->cover)
        <div class="w-30 shrink-0">
            <img
                alt="{{ $item->title }}"
                src="{{ $item->cover->src }}"
                class="aspect-4/3 w-full object-cover"
            />
        </div>
    @endif

    <div class="flex grow flex-col justify-between">
        <h2 class="text-sm font-medium">{{ $item->title }}</h2>

        <div class="flex items-center justify-between text-xs">
            <div class="flex">
                <svg
                    class="size-4"
                    viewBox="0 0 24 24"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                        d="M12 21C15.5 17.4 19 14.1764 19 10.2C19 6.22355 15.866 3 12 3C8.13401 3 5 6.22355 5 10.2C5 14.1764 8.5 17.4 12 21Z"
                        class="stroke-current"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    />
                    <path
                        d="M12 13C13.6569 13 15 11.6569 15 10C15 8.34315 13.6569 7 12 7C10.3431 7 9 8.34315 9 10C9 11.6569 10.3431 13 12 13Z"
                        class="stroke-current"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    />
                </svg>

                {{ $item->province->name }}, {{ $item->district->name }}
            </div>

            <div class="shrink-0 text-nowrap font-bold text-primary">
                {{ $item->price_formatted }}
            </div>
        </div>
    </div>
</a>
