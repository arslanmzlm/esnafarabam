@extends('layouts.main')

@section('body')
    @if ($items->total())
        <div class="grid xl:grid-cols-1 xl:gap-6">
            <x-item.table :items="$items->items()" />
        </div>

        <div>
            {{ $items->links() }}
        </div>
    @else
        <div
            class="rounded-sm border border-stroke bg-white p-6 text-center shadow-sm dark:border-strokedark dark:bg-boxdark"
        >
            <div class="text-title-lg font-bold">İlan bulunamadı.</div>
            <div class="text-lg">
                Aradığınız kriterlere uygun ilan bulunamadı. Lütfen Kullandığınız filtreleri kontrol
                ediniz.
            </div>
        </div>
    @endif
@endsection
