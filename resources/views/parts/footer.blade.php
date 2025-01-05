<div class="mt-15 border-t border-slate-300 bg-white py-10">
    <div class="container">
        <div class="grid grid-cols-5 gap-6">
            <div class="col-span-1">
                <img
                    src="{{ Vite::asset('resources/images/logo/logo-dark.png') }}"
                    alt="Logo"
                    class="h-12"
                />

                <p class="mt-2 text-sm">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Autem cum delectus
                    ducimus fugit minus natus odio possimus provident qui. Aliquid debitis dolores
                    eos harum mollitia numquam suscipit. Ducimus, fugit, ut.
                </p>
            </div>

            <div class="col-span-1">
                <div class="font-bold">Kurumsal</div>
                <nav class="flex flex-col">
                    @foreach (\App\Services\PageService::getByCategory(\App\Enums\PageCategory::COMMERCIAL) as $page)
                        <a href="{{ route('page.detail', $page->slug) }}" class="text-sm">
                            {{ $page->title }}
                        </a>
                    @endforeach
                </nav>
            </div>

            <div class="col-span-1">
                <div class="font-bold">Hizmetlerimiz</div>
                <nav class="flex flex-col">
                    @foreach (\App\Services\PageService::getByCategory(\App\Enums\PageCategory::SERVICE) as $page)
                        <a href="{{ route('page.detail', $page->slug) }}" class="text-sm">
                            {{ $page->title }}
                        </a>
                    @endforeach
                </nav>
            </div>

            <div class="col-span-1">
                <div class="font-bold">Gizlilik ve Kullanım</div>
                <nav class="flex flex-col">
                    @foreach (\App\Services\PageService::getByCategory(\App\Enums\PageCategory::PRIVACY) as $page)
                        <a href="{{ route('page.detail', $page->slug) }}" class="text-sm">
                            {{ $page->title }}
                        </a>
                    @endforeach
                </nav>
            </div>
        </div>
    </div>
</div>

<div class="bg-whiter py-2">
    <div class="container">
        <div class="flex justify-between">
            <div class="text-sm">Copyright</div>
            <div class="text-sm">Phone</div>
        </div>
    </div>
</div>
