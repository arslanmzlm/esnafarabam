@extends('layouts.main')

@section('body')
    <div class="item-detail-page grid gap-4 lg:grid-cols-4">
        <div class="group col-span-2 rounded border border-stroke bg-white shadow-sm">
            <div id="item-photo-carousel" class="splide">
                <div class="splide__track">
                    <ul class="splide__list">
                        @foreach ($item->approvedPhotos as $photo)
                            <li class="splide__slide">
                                <img alt="{{ $item->title }}" src="{{ $photo->src }}" />
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="relative">
                <div id="item-thumbnail-carousel" class="splide">
                    <div class="splide__track">
                        <ul class="splide__list">
                            @foreach ($item->photos as $photo)
                                <li class="splide__slide">
                                    <button class="block" type="button">
                                        <img alt="{{ $item->title }}" src="{{ $photo->src }}" />
                                    </button>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-span-1 space-y-2 rounded border border-stroke bg-white pb-3 shadow-sm">
            <div class="rounded-t bg-primary p-4 text-center text-title-sm font-bold text-white">
                {{ $item->price_formatted }}
            </div>
            <div class="item-page-vehicle-attributes text-sm">
                <div class="flex justify-between gap-2 border-b border-stroke p-3">
                    <span><b>İlan No</b></span>
                    <span>{{ $item->id }}</span>
                </div>
                <div class="flex justify-between gap-2 border-b border-stroke p-3">
                    <span><b>İlan Tarihi</b></span>
                    <span>{{ $item->updated_at->isoFormat('LL') }}</span>
                </div>
                <div class="flex justify-between gap-2 border-b border-stroke p-3">
                    <span><b>Marka</b></span>
                    <span title="{{ $item->vehicle->brand->name }}" class="line-clamp-1">
                        {{ $item->vehicle->brand->name }}
                    </span>
                </div>
                <div class="flex justify-between gap-2 border-b border-stroke p-3">
                    <span><b>Model</b></span>
                    <span title="{{ $item->vehicle->title }}" class="line-clamp-1">
                        {{ $item->vehicle->title }}
                    </span>
                </div>
                <div class="flex justify-between gap-2 border-b border-stroke p-3">
                    <span><b>Model Yılı</b></span>
                    <span>{{ $item->vehicle->year }}</span>
                </div>
                <div class="flex justify-between gap-2 border-b border-stroke p-3">
                    <span><b>Kilometre</b></span>
                    <span>{{ $item->kilometer_formatted }}</span>
                </div>
                <div class="flex justify-between gap-2 border-b border-stroke p-3">
                    <span><b>Yakıt Tipi</b></span>
                    <span>{{ $item->vehicle->fuel_label }}</span>
                </div>
                <div class="flex justify-between gap-2 border-b border-stroke p-3">
                    <span><b>Vites Tipi</b></span>
                    <span>{{ $item->vehicle->gear_label }}</span>
                </div>
                <div class="flex justify-between gap-2 border-b border-stroke p-3">
                    <span><b>Motor Gücü</b></span>
                    <span>{{ $item->vehicle->engine_power_formatted }}</span>
                </div>
                <div class="flex justify-between p-3">
                    <span><b>Motor Hacmi</b></span>
                    <span>{{ $item->vehicle->engine_size_formatted }}</span>
                </div>
            </div>
        </div>

        <div
            class="col-span-1 space-y-4 rounded border border-stroke bg-white pb-5 shadow-sm"
        ></div>

        <div class="col-span-3 space-y-4">
            <x-card title="Araç Özeti">
                <div class="flex flex-wrap gap-6 dark:bg-form-strokedark">
                    @if ($item->vehicle->brand->logo)
                        <div class="flex gap-4">
                            <img
                                alt="{{ $item->vehicle->brand->logo }}"
                                src="{{ $item->vehicle->brand->logo_src }}"
                                class="h-20"
                            />
                        </div>
                    @endif

                    <div class="hidden w-[2px] bg-stroke lg:block"></div>
                    <div class="flex gap-10 self-center">
                        <div class="flex items-center gap-3">
                            <svg
                                class="size-12 fill-current"
                                viewBox="0 0 512.009 512.009"
                                xml:space="preserve"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <g>
                                    <g>
                                        <g>
                                            <path
                                                d="M437.024,74.984c-8.331-8.331-21.839-8.331-30.17,0s-8.331,21.839,0,30.17c83.317,83.317,83.317,218.394,0.002,301.69 c-8.332,8.33-8.334,21.838-0.003,30.17c8.33,8.332,21.838,8.334,30.17,0.003C537.004,337.059,537.004,174.964,437.024,74.984z"
                                            ></path>
                                            <path
                                                d="M105.153,105.165c8.332-8.33,8.334-21.838,0.003-30.17c-8.33-8.332-21.838-8.334-30.17-0.004 c-99.981,99.958-99.981,262.054-0.002,362.033c8.331,8.331,21.839,8.331,30.17,0c8.331-8.331,8.331-21.839,0-30.17 C21.838,323.538,21.838,188.46,105.153,105.165z"
                                            ></path>
                                            <path
                                                d="M256.004,85.338c-94.257,0-170.667,76.41-170.667,170.667s76.41,170.667,170.667,170.667s170.667-76.41,170.667-170.667 S350.261,85.338,256.004,85.338z M256.004,384.004c-70.693,0-128-57.307-128-128s57.307-128,128-128s128,57.307,128,128 S326.697,384.004,256.004,384.004z"
                                            ></path>
                                            <path
                                                d="M256.004,170.671c-11.782,0-21.333,9.551-21.333,21.333v64c0,11.782,9.551,21.333,21.333,21.333 c11.782,0,21.333-9.551,21.333-21.333v-64C277.338,180.222,267.786,170.671,256.004,170.671z"
                                            ></path>
                                            <path
                                                d="M256.004,298.671c-11.776,0-21.333,9.557-21.333,21.333s9.557,21.333,21.333,21.333c11.776,0,21.333-9.557,21.333-21.333 S267.78,298.671,256.004,298.671z"
                                            ></path>
                                        </g>
                                    </g>
                                </g>
                            </svg>

                            <div>
                                <div class="font-bold text-primary">Model Yılı</div>
                                <div class="font-bold">{{ $item->vehicle->year }}</div>
                            </div>
                        </div>

                        <div class="flex items-center gap-3">
                            <svg
                                class="size-12 fill-current"
                                viewBox="0 0 512.002 512.002"
                                xml:space="preserve"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <g>
                                    <g>
                                        <g>
                                            <path
                                                d="M192,64.001h-85.333c-11.782,0-21.333,9.551-21.333,21.333v85.333c0,11.782,9.551,21.333,21.333,21.333H192 c11.782,0,21.333-9.551,21.333-21.333V85.334C213.333,73.552,203.782,64.001,192,64.001z M170.667,149.334H128v-42.667h42.667 V149.334z"
                                            ></path>
                                            <path
                                                d="M492.766,63.615C468.845,24.117,425.98,0.328,362.779,0.001c-15.139-0.078-25.54,15.199-19.918,29.256l42.667,106.667 c3.24,8.099,11.084,13.41,19.808,13.41h21.333v192c0,23.589-19.078,42.667-42.667,42.667s-42.667-19.078-42.667-42.667V192.001 c0-39.786-27.183-73.185-64.002-82.649V21.334c0-11.782-9.551-21.333-21.333-21.333H42.667c-11.782,0-21.333,9.551-21.333,21.333 v384C9.551,405.334,0,414.886,0,426.668v64c0,11.782,9.551,21.333,21.333,21.333h256c11.782,0,21.333-9.551,21.333-21.333v-64 c0-11.782-9.551-21.333-21.333-21.333V155.044c12.757,7.371,21.335,21.146,21.335,36.957v149.333 c0,47.153,38.181,85.333,85.333,85.333c47.153,0,85.333-38.181,85.333-85.333v-192h21.333c11.782,0,21.333-9.551,21.333-21.333 C512.002,111.119,507.235,87.506,492.766,63.615z M256,469.334H42.667v-21.333H256V469.334z M64,405.334V42.668h170.667v362.667 H64z M395.413,45.754c29.378,5.895,48.745,19.965,60.857,39.964c4.039,6.67,7.081,13.748,9.244,20.95h-45.736L395.413,45.754z"
                                            ></path>
                                            <path
                                                d="M170.669,234.668h-42.667c-11.782,0-21.333,9.551-21.333,21.333c0,11.782,9.551,21.333,21.333,21.333h42.667 c11.782,0,21.333-9.551,21.333-21.333C192.002,244.219,182.451,234.668,170.669,234.668z"
                                            ></path>
                                        </g>
                                    </g>
                                </g>
                            </svg>

                            <div>
                                <div class="font-bold text-primary">Yakıt Tipi</div>
                                <div class="font-bold">{{ $item->vehicle->fuel_label }}</div>
                            </div>
                        </div>

                        <div class="flex items-center gap-3">
                            <svg
                                class="size-12 fill-current"
                                viewBox="0 0 512 512"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <g>
                                    <g>
                                        <path
                                            d="M448,387.654V256V124.346c24.858-8.784,42.667-32.474,42.667-60.346c0-35.355-28.645-64-64-64c-35.355,0-64,28.645-64,64 c0,27.872,17.808,51.562,42.667,60.346v110.321h-128V124.346C302.192,115.562,320,91.872,320,64c0-35.355-28.645-64-64-64 s-64,28.645-64,64c0,27.872,17.808,51.562,42.667,60.346v110.321h-128V124.346c24.858-8.784,42.667-32.474,42.667-60.346 c0-35.355-28.645-64-64-64s-64,28.645-64,64c0,27.872,17.808,51.562,42.667,60.346V256c0,11.782,9.551,21.333,21.333,21.333 h149.333v110.321C209.808,396.438,192,420.128,192,448c0,35.355,28.645,64,64,64s64-28.645,64-64 c0-27.872-17.808-51.562-42.667-60.346V277.333h128v110.321c-24.858,8.784-42.667,32.474-42.667,60.346c0,35.355,28.645,64,64,64 c35.355,0,64-28.645,64-64C490.667,420.128,472.858,396.438,448,387.654z M426.667,42.667C438.458,42.667,448,52.209,448,64 s-9.542,21.333-21.333,21.333S405.333,75.791,405.333,64S414.875,42.667,426.667,42.667z M256,42.667 c11.791,0,21.333,9.542,21.333,21.333S267.791,85.333,256,85.333c-11.791,0-21.333-9.542-21.333-21.333S244.209,42.667,256,42.667 z M85.333,42.667c11.791,0,21.333,9.542,21.333,21.333s-9.542,21.333-21.333,21.333S64,75.791,64,64S73.542,42.667,85.333,42.667z  M256,469.333c-11.791,0-21.333-9.542-21.333-21.333s9.542-21.333,21.333-21.333c11.791,0,21.333,9.542,21.333,21.333 S267.791,469.333,256,469.333z M426.667,469.333c-11.791,0-21.333-9.542-21.333-21.333s9.542-21.333,21.333-21.333 S448,436.209,448,448S438.458,469.333,426.667,469.333z"
                                        ></path>
                                    </g>
                                </g>
                            </svg>

                            <div>
                                <div class="font-bold text-primary">Vites Tipi</div>
                                <div class="font-bold">{{ $item->vehicle->gear_label }}</div>
                            </div>
                        </div>

                        <div class="flex items-center gap-3">
                            <svg
                                class="size-12 fill-current"
                                viewBox="0 0 512.009 512.009"
                                xml:space="preserve"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <g>
                                    <g>
                                        <g>
                                            <path
                                                d="M256.009,42.671c-0.002,0-0.005,0-0.007,0c-0.001,0-0.001,0-0.002,0c-0.001,0-0.002,0-0.003,0 c-70.671,0.003-134.648,28.637-180.967,74.935c-0.016,0.016-0.034,0.029-0.05,0.045c-0.017,0.017-0.03,0.035-0.047,0.052 C28.688,163.976,0.072,227.867,0.011,298.445C0.011,298.521,0,298.595,0,298.671c0,0.073,0.01,0.143,0.011,0.215 c0.05,60.201,20.962,117.239,58.515,162.704c4.053,4.907,10.084,7.748,16.448,7.748h95.693h170.667h95.688 c6.364,0,12.395-2.841,16.448-7.748c37.607-45.53,58.539-102.65,58.539-162.919C512.009,157.289,397.391,42.671,256.009,42.671z  M197.707,426.671c7.376-12.754,21.165-21.333,36.96-21.333h42.667c15.795,0,29.584,8.579,36.96,21.333H197.707z M426.68,426.671 h-66.702c-9.472-36.807-42.88-64-82.645-64h-42.667c-39.765,0-73.173,27.193-82.645,64H85.316 c-23.281-30.977-37.712-67.661-41.583-106.667h62.934c11.782,0,21.333-9.551,21.333-21.333c0-11.782-9.551-21.333-21.333-21.333 H43.734c4.259-42.905,21.23-82.066,47.091-113.671l14.32,14.32c8.331,8.331,21.839,8.331,30.17,0 c8.331-8.331,8.331-21.839,0-30.17l-14.321-14.321c31.605-25.864,70.765-42.837,113.672-47.098v62.941 c0,11.782,9.551,21.333,21.333,21.333c11.782,0,21.333-9.551,21.333-21.333V86.396c42.906,4.259,82.068,21.232,113.676,47.096 l-14.325,14.325c-8.331,8.331-8.331,21.839,0,30.17c8.331,8.331,21.839,8.331,30.17,0l14.326-14.326 c25.867,31.607,42.842,70.771,47.103,113.677h-62.95c-11.782,0-21.333,9.551-21.333,21.333c0,11.782,9.551,21.333,21.333,21.333 h62.95C464.409,359.001,449.97,395.686,426.68,426.671z"
                                            ></path>
                                            <polygon
                                                points="259.659,341.338 319.989,220.655 199.328,281.007"
                                            ></polygon>
                                        </g>
                                    </g>
                                </g>
                            </svg>

                            <div>
                                <div class="font-bold text-primary">Kilometre</div>
                                <div class="font-bold">{{ $item->kilometer_formatted }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </x-card>

            @if (! empty($item->description))
                <x-card title="İlan Açıklaması" class="content">
                    <div>{!! $item->description !!}</div>
                </x-card>
            @endif

            @if (! empty($attributeCategories))
                @foreach ($attributeCategories as $attributeCategory)
                    <x-card :title="$attributeCategory['categoryName']">
                        @if (! empty($attributeCategory['tableAttributes']))
                            <table class="attribute-table">
                                <tbody>
                                    @foreach ($attributeCategory['tableAttributes'] as $attribute)
                                        <tr>
                                            <td class="w-1/4">{{ $attribute['name'] }}</td>
                                            <td class="font-medium">
                                                {{ $attribute['value'] }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif

                        @if (! empty($attributeCategory['checkboxAttributes']))
                            @foreach ($attributeCategory['checkboxAttributes'] as $attribute)
                                <div>
                                    <div class="font-semibold">{{ $attribute['name'] }}</div>
                                    <div class="mt-3 flex flex-wrap gap-4">
                                        @foreach ($attribute['value'] as $value)
                                            <span
                                                class="rounded-md border border-stroke p-2 text-sm font-medium"
                                            >
                                                {{ $value }}
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </x-card>
                @endforeach
            @endif
        </div>
    </div>
@endsection
