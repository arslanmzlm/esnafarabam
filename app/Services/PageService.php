<?php

namespace App\Services;

use App\Enums\PageCategory;
use App\Models\Page;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class PageService
{
    /**
     * @param int|null $limit
     * @return Collection<Page>
     */
    public static function getActive(?int $limit = null): Collection
    {
        return Page::where('active', true)->limit($limit)->get();
    }

    /**
     * @param PageCategory $pageCategory
     * @param int|null $limit
     * @return Collection<Page>
     */
    public static function getByCategory(PageCategory $pageCategory, ?int $limit = null): Collection
    {
        return Page::where('active', true)->where('category', $pageCategory)->limit($limit)->get();
    }

    public function store(array $data): ?Page
    {
        $item = new Page();
        return $this->assignAttribute($item, $data);
    }

    private function assignAttribute(Page $page, array $data): ?Page
    {
        $page->active = $data['active'] ?? $page->active ?? false;
        $page->category = $data['category'] ?? $page->category;
        $page->title = $data['title'];
        $page->slug = Str::slug($data['slug'] ?? $data['title']);
        $page->body = $data['body'] ?? null;
        $page->meta_title = $data['meta_title'] ?? null;
        $page->meta_description = $data['meta_description'] ?? null;
        $page->meta_keywords = $data['meta_keywords'] ?? null;

        $page->save();

        return $page->fresh();
    }

    public function update(Page $item, array $data): ?Page
    {
        return $this->assignAttribute($item, $data);
    }

    public function delete(Page $item): ?bool
    {
        return $item->delete();
    }
}
