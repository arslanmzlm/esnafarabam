@extends('layouts.main')

@section('body')
    <div class="space-y-6">
        <div class="flex justify-between gap-6">
            @foreach ($vehicleTypes->take(5) as $vehicleType)
                <a
                    href="{{ route('item.list', $vehicleType) }}"
                    class="group w-full rounded border border-slate-200 bg-white p-3 text-center font-medium shadow hover:bg-primary hover:text-white"
                >
                    <img
                        src="{{ $vehicleType->logo_src }}"
                        alt="{{ $vehicleType->name }}"
                        class="mx-auto h-10 group-hover:grayscale group-hover:invert"
                    />
                    {{ $vehicleType->name }}
                </a>
            @endforeach
        </div>

        <section id="home-page-slider" class="splide" aria-label="Anasayfa Slider">
            <div class="splide__track">
                <ul class="splide__list">
                    @foreach ($homePageSliders as $slide)
                        <li class="splide__slide">
                            @if (! empty($slide->link))
                                <a href="{{ $slide->link }}" class="block">
                                    <picture>
                                        <source
                                            media="(max-width: 1024px)"
                                            srcset="{{ $slide->mobile_image_src }}"
                                            class="w-full object-cover"
                                        />
                                        <img
                                            src="{{ $slide->image_src }}"
                                            alt="{{ $slide->alt ?? $slide->title }}"
                                            class="w-full object-cover"
                                        />
                                    </picture>
                                </a>
                            @else
                                <picture>
                                    <source
                                        media="(max-width: 1024px)"
                                        srcset="{{ $slide->mobile_image_src }}"
                                    />
                                    <img
                                        src="{{ $slide->image_src }}"
                                        alt="{{ $slide->alt ?? $slide->title }}"
                                    />
                                </picture>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </div>
        </section>

        <div class="grid xl:grid-cols-5 xl:gap-6">
            @foreach ($items as $item)
                <x-item.card :item="$item"></x-item.card>
            @endforeach
        </div>
    </div>
@endsection
