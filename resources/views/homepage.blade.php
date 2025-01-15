@extends('layouts.main')

@section('body')
    <div class="space-y-6">
        <div class="hidden grid-cols-5 justify-between gap-6 lg:grid">
            @foreach ($vehicleTypes->take(5) as $vehicleType)
                <a
                    href="{{ route('item.list', $vehicleType) }}"
                    class="group col-span-1 rounded border border-slate-200 bg-white p-3 text-center font-medium shadow hover:bg-primary hover:text-white"
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

        @if ($homePageSliders->count())
            <section id="home-page-slider" class="splide" aria-label="Anasayfa Slider">
                <div class="splide__track">
                    <ul class="splide__list">
                        @foreach ($homePageSliders as $slide)
                            <li class="splide__slide">
                                @if (! empty($slide->link))
                                    <a href="{{ $slide->link }}" class="block">
                                        <picture>
                                            @if ($slide->mobile_image)
                                                <source
                                                    media="(max-width: 1024px)"
                                                    srcset="{{ $slide->mobile_image_src }}"
                                                    class="w-full"
                                                />
                                            @endif

                                            <img
                                                src="{{ $slide->image_src }}"
                                                alt="{{ $slide->alt ?? $slide->title }}"
                                                class="w-full"
                                            />
                                        </picture>
                                    </a>
                                @else
                                    <picture>
                                        @if ($slide->mobile_image)
                                            <source
                                                media="(max-width: 1024px)"
                                                srcset="{{ $slide->mobile_image_src }}"
                                                class="w-full"
                                            />
                                        @endif

                                        <img
                                            src="{{ $slide->image_src }}"
                                            alt="{{ $slide->alt ?? $slide->title }}"
                                            class="w-full"
                                        />
                                    </picture>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </div>
            </section>
        @endif

        <div class="grid grid-cols-2 gap-4 lg:grid-cols-5 lg:gap-6">
            @foreach ($items as $item)
                <x-item.card :item="$item"></x-item.card>
            @endforeach
        </div>
    </div>
@endsection
