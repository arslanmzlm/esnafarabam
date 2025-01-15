<div class="mt-15 border-t border-slate-300 bg-white py-10">
    <div class="container">
        <div class="grid grid-cols-1 gap-6 lg:grid-cols-5">
            <div class="lg:col-span-1">
                <img
                    src="{{ \App\Services\SettingService::getSrc('logo_default') }}"
                    alt="Logo"
                    class="h-12"
                />

                <p class="mt-2 text-sm">
                    {{ nl2br(\App\Services\SettingService::get('footer_description')) }}
                </p>
            </div>

            <div class="lg:col-span-1">
                <div class="font-bold">Kurumsal</div>
                <nav class="flex flex-col">
                    @foreach (\App\Services\PageService::getByCategory(\App\Enums\PageCategory::COMMERCIAL) as $page)
                        <a href="{{ route('page.detail', $page->slug) }}" class="text-sm">
                            {{ $page->title }}
                        </a>
                    @endforeach
                </nav>
            </div>

            <div class="lg:col-span-1">
                <div class="font-bold">Hizmetlerimiz</div>
                <nav class="flex flex-col">
                    @foreach (\App\Services\PageService::getByCategory(\App\Enums\PageCategory::SERVICE) as $page)
                        <a href="{{ route('page.detail', $page->slug) }}" class="text-sm">
                            {{ $page->title }}
                        </a>
                    @endforeach
                </nav>
            </div>

            <div class="lg:col-span-1">
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
            <div class="text-sm">
                {{ \App\Services\SettingService::get('footer_copyright') }}
            </div>
            <div class="text-sm">
                {{ \App\Services\SettingService::get('footer_end') }}
            </div>
        </div>
    </div>
</div>
