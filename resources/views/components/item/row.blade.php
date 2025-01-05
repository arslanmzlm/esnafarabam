<tr>
    <td style="width: 150px">
        <a href="{{ route('item.detail', [$item->id, $item->slug]) }}">
            @if ($item->cover)
                <img
                    alt="{{ $item->title }}"
                    src="{{ $item->cover->src }}"
                    class="my-1px aspect-4/3 object-cover"
                />
            @endif
        </a>
    </td>
    <td style="width: 220px">
        <a href="{{ route('item.detail', [$item->id, $item->slug]) }}" class="link-overlay">
            {{ $item->vehicle->title }}
        </a>
    </td>
    <td>
        <a href="{{ route('item.detail', [$item->id, $item->slug]) }}" class="link-overlay">
            {{ $item->title }}
        </a>
    </td>
    <td style="width: 125px">
        <a href="{{ route('item.detail', [$item->id, $item->slug]) }}" class="link-overlay">
            {{ $item->vehicle->year }}
        </a>
    </td>
    <td style="width: 125px">
        <a href="{{ route('item.detail', [$item->id, $item->slug]) }}" class="link-overlay">
            {{ $item->kilometer_formatted }}
        </a>
    </td>
    <td style="width: 125px" class="item-row-price">
        <a href="{{ route('item.detail', [$item->id, $item->slug]) }}" class="link-overlay">
            {{ $item->price_formatted }}
        </a>
    </td>
    <td style="width: 125px">
        <a href="{{ route('item.detail', [$item->id, $item->slug]) }}" class="link-overlay">
            {{ $item->created_at->isoFormat('LL') }}
        </a>
    </td>

    <td style="width: 125px">
        <div>{{ $item->province->name }}</div>
        <div>{{ $item->district->name }}</div>
    </td>
</tr>
