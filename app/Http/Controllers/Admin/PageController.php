<?php

namespace App\Http\Controllers\Admin;

use App\Enums\PageCategory;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePageRequest;
use App\Http\Requests\UpdatePageRequest;
use App\Models\Page;
use App\Services\PageService;
use Inertia\Inertia;

class PageController extends Controller
{
    public function __construct(private PageService $pageService)
    {
    }

    public function list()
    {
        return Inertia::render('Admin/Page/List', [
            'pages' => Page::all()
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/Page/Create', [
            'pageCategories' => PageCategory::getAll()
        ]);
    }

    public function store(StorePageRequest $request)
    {
        $this->pageService->store($request->validated());

        $request->session()->flash('toast.success', trans('messages.page.created'));

        return to_route('admin.page.list');
    }

    public function edit(Page $page)
    {
        return Inertia::render('Admin/Page/Edit', [
            'page' => $page,
            'pageCategories' => PageCategory::getAll()
        ]);
    }

    public function update(Page $page, UpdatePageRequest $request)
    {
        $this->pageService->update($page, $request->validated());

        $request->session()->flash('toast.success', trans('messages.page.updated'));

        return to_route('admin.page.list');
    }

    public function destroy(Page $page)
    {
        $this->pageService->delete($page);

        session()->flash('toast.success', trans('messages.page.deleted'));

        return to_route('admin.page.list');
    }
}
