@if ($paginator->hasPages())
    <nav
        role="navigation"
        aria-label="{{ __('Pagination Navigation') }}"
        class="mt-6 flex flex-col items-center justify-between border border-neutral-200 bg-white px-4 py-10 shadow"
    >
        <div class="flex flex-1 justify-between sm:hidden">
            @if ($paginator->onFirstPage())
                <span
                    class="text-gray-500 border-gray-300 dark:text-gray-600 dark:bg-gray-800 dark:border-gray-600 relative inline-flex cursor-default items-center rounded-md border bg-white px-4 py-2 text-sm font-medium leading-5"
                >
                    {!! __('pagination.previous') !!}
                </span>
            @else
                <a
                    href="{{ $paginator->previousPageUrl() }}"
                    class="text-gray-700 border-gray-300 hover:text-gray-500 ring-gray-300 active:bg-gray-100 active:text-gray-700 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 dark:active:bg-gray-700 dark:active:text-gray-300 relative inline-flex items-center rounded-md border bg-white px-4 py-2 text-sm font-medium leading-5 transition duration-150 ease-in-out focus:border-blue-300 focus:outline-none focus:ring dark:focus:border-blue-700"
                >
                    {!! __('pagination.previous') !!}
                </a>
            @endif

            @if ($paginator->hasMorePages())
                <a
                    href="{{ $paginator->nextPageUrl() }}"
                    class="text-gray-700 border-gray-300 hover:text-gray-500 ring-gray-300 active:bg-gray-100 active:text-gray-700 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 dark:active:bg-gray-700 dark:active:text-gray-300 relative ml-3 inline-flex items-center rounded-md border bg-white px-4 py-2 text-sm font-medium leading-5 transition duration-150 ease-in-out focus:border-blue-300 focus:outline-none focus:ring dark:focus:border-blue-700"
                >
                    {!! __('pagination.next') !!}
                </a>
            @else
                <span
                    class="text-gray-500 border-gray-300 dark:text-gray-600 dark:bg-gray-800 dark:border-gray-600 relative ml-3 inline-flex cursor-default items-center rounded-md border bg-white px-4 py-2 text-sm font-medium leading-5"
                >
                    {!! __('pagination.next') !!}
                </span>
            @endif
        </div>

        <div class="hidden sm:flex sm:flex-1 sm:flex-col sm:items-center sm:justify-between">
            <div class="flex gap-2">
                {{-- Previous Page Link --}}

                @if ($paginator->onFirstPage())
                    <span aria-disabled="true" aria-label="{{ __('pagination.previous') }}">
                        <span
                            class="text-gray-500 border-gray-300 dark:bg-gray-800 dark:border-gray-600 relative inline-flex size-10 cursor-default items-center justify-center rounded-full border border-neutral-500 bg-whiten text-sm font-bold leading-5 opacity-50 shadow-sm"
                            aria-hidden="true"
                        >
                            <svg class="size-5" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    fill-rule="evenodd"
                                    d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                    clip-rule="evenodd"
                                />
                            </svg>
                        </span>
                    </span>
                @else
                    <a
                        href="{{ $paginator->previousPageUrl() }}"
                        rel="prev"
                        class="text-gray-500 border-gray-300 hover:text-gray-400 ring-gray-300 active:bg-gray-100 active:text-gray-500 dark:bg-gray-800 dark:border-gray-600 dark:active:bg-gray-700 relative inline-flex size-10 items-center justify-center rounded-full border border-neutral-500 bg-whiten text-sm font-bold leading-5 shadow-sm transition duration-150 ease-in-out hover:border-primary focus:z-10 focus:border-blue-300 focus:outline-none focus:ring dark:focus:border-blue-800"
                        aria-label="{{ __('pagination.previous') }}"
                    >
                        <svg class="size-5" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                fill-rule="evenodd"
                                d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                clip-rule="evenodd"
                            />
                        </svg>
                    </a>
                @endif

                {{-- Pagination Elements --}}
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <span aria-disabled="true">
                            <span
                                class="text-gray-700 border-gray-300 dark:bg-gray-800 dark:border-gray-600 relative -ml-px inline-flex size-10 cursor-default items-center justify-center rounded-full border border-neutral-500 bg-whiten text-sm font-bold leading-5 shadow-sm hover:border-primary"
                            >
                                {{ $element }}
                            </span>
                        </span>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <span aria-current="page">
                                    <span
                                        class="text-gray-500 border-gray-300 dark:bg-gray-800 dark:border-gray-600 relative -ml-px inline-flex size-10 cursor-default items-center justify-center rounded-full border border-primary bg-primary bg-opacity-85 text-sm font-bold leading-5 text-white shadow-sm"
                                    >
                                        {{ $page }}
                                    </span>
                                </span>
                            @else
                                <a
                                    href="{{ $url }}"
                                    class="inline-flex size-10 items-center justify-center rounded-full border border-neutral-500 bg-whiten text-sm font-bold shadow-sm hover:border-primary"
                                    aria-label="{{ __('Go to page :page', ['page' => $page]) }}"
                                >
                                    {{ $page }}
                                </a>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                {{-- Next Page Link --}}

                @if ($paginator->hasMorePages())
                    <a
                        href="{{ $paginator->nextPageUrl() }}"
                        rel="next"
                        class="text-gray-500 border-gray-300 hover:text-gray-400 ring-gray-300 active:bg-gray-100 active:text-gray-500 dark:bg-gray-800 dark:border-gray-600 dark:active:bg-gray-700 relative -ml-px inline-flex size-10 items-center justify-center rounded-full border border-neutral-500 bg-whiten text-sm font-bold leading-5 shadow-sm transition duration-150 ease-in-out hover:border-primary focus:z-10 focus:border-blue-300 focus:outline-none focus:ring dark:focus:border-blue-800"
                        aria-label="{{ __('pagination.next') }}"
                    >
                        <svg class="size-5" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                fill-rule="evenodd"
                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                clip-rule="evenodd"
                            />
                        </svg>
                    </a>
                @else
                    <span aria-disabled="true" aria-label="{{ __('pagination.next') }}">
                        <span
                            class="text-gray-500 border-gray-300 dark:bg-gray-800 dark:border-gray-600 relative inline-flex size-10 cursor-default items-center justify-center rounded-full border border-neutral-500 bg-whiten text-sm font-bold leading-5 opacity-50 shadow-sm"
                            aria-hidden="true"
                        >
                            <svg class="size-5" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    fill-rule="evenodd"
                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                    clip-rule="evenodd"
                                />
                            </svg>
                        </span>
                    </span>
                @endif
            </div>

            <div>
                <p class="text-gray-700 dark:text-gray-400 mt-6 text-sm leading-5">
                    <span class="font-bold">{{ $paginator->lastPage() }}</span>
                    sayfa içinden
                    <span class="font-bold">{{ $paginator->currentPage() }}.</span>
                    sayfa görüntüleniyor.
                </p>
            </div>
        </div>
    </nav>
@endif
