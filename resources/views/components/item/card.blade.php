<a
    href="{{ route('item.detail', [$item->id, $item->slug]) }}"
    class="item-card group col-span-1 rounded border border-stroke bg-white shadow-sm"
>
    <div class="item-card-cover overflow-hidden rounded">
        @if ($item->cover)
            <img
                alt="{{ $item->title }}"
                src="{{ $item->cover->src }}"
                class="aspect-4/3 w-full rounded object-cover transition-transform duration-300 group-hover:scale-110"
            />
        @endif
    </div>

    <div class="space-y-1 rounded-b p-3">
        <div class="item-card-province-name text-sm text-graydark">
            {{ $item->province->name }}
        </div>
        <div
            title="{{ $item->vehicle->title }}"
            class="item-card-vehicle-title line-clamp-1 font-medium text-black"
        >
            {{ $item->vehicle->title }}
        </div>
        <div class="item-card-vehicle-attributes flex flex-wrap gap-2 text-sm text-graydark">
            <span class="item-card-vehicle-year">
                {{ $item->vehicle->year }}
            </span>
            <span class="item-card-vehicle-fuel">
                {{ $item->vehicle->fuel_label }}
            </span>
            <span class="item-card-vehicle-gear">
                {{ $item->vehicle->gear_label }}
            </span>
        </div>
        <div class="item-card-price font-bold text-primary">{{ $item->price_formatted }}</div>
    </div>
</a>
