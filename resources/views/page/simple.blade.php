@extends('layouts.main')

@section('body')
    <div class="grid grid-cols-5 gap-6">
        <div class="col-span-1 space-y-6">
            <div
                class="other-page-links rounded-sm border border-stroke bg-white shadow-sm dark:border-strokedark dark:bg-boxdark"
            >
                <div class="other-page-links-title font-bold">Kurumsal</div>
                <nav class="flex flex-col">
                    @foreach (\App\Services\PageService::getByCategory(\App\Enums\PageCategory::COMMERCIAL) as $otherPage)
                        <a
                            href="{{ route('page.detail', $otherPage->slug) }}"
                            class="{{ $page->id === $otherPage->id ? 'active' : '' }}"
                        >
                            {{ $otherPage->title }}
                        </a>
                    @endforeach
                </nav>
            </div>

            <div
                class="other-page-links rounded-sm border border-stroke bg-white shadow-sm dark:border-strokedark dark:bg-boxdark"
            >
                <div class="other-page-links-title font-bold">Hizmetlerimiz</div>
                <nav class="flex flex-col">
                    @foreach (\App\Services\PageService::getByCategory(\App\Enums\PageCategory::SERVICE) as $otherPage)
                        <a
                            href="{{ route('page.detail', $otherPage->slug) }}"
                            class="{{ $page->id === $otherPage->id ? 'active' : '' }}"
                        >
                            {{ $otherPage->title }}
                        </a>
                    @endforeach
                </nav>
            </div>

            <div
                class="other-page-links rounded-sm border border-stroke bg-white shadow-sm dark:border-strokedark dark:bg-boxdark"
            >
                <div class="other-page-links-title font-bold">Gizlilik ve Kullanım</div>
                <nav class="flex flex-col">
                    @foreach (\App\Services\PageService::getByCategory(\App\Enums\PageCategory::PRIVACY) as $otherPage)
                        <a
                            href="{{ route('page.detail', $otherPage->slug) }}"
                            class="{{ $page->id === $otherPage->id ? 'active' : '' }}"
                        >
                            {{ $otherPage->title }}
                        </a>
                    @endforeach
                </nav>
            </div>
        </div>
        <div class="col-span-4">
            <x-card class="content">
                <h1>{{ $page->title }}</h1>
                {!! $page->body !!}
            </x-card>
        </div>
    </div>
@endsection
