<table class="item-list-table">
    <thead>
        <th></th>
        <th>Model</th>
        <th>İlan Başlığı</th>
        <th>Model Yılı</th>
        <th>Kilometre</th>
        <th>Fiyat</th>
        <th>İlan Tarihi</th>
        <th>Konum</th>
    </thead>
    <tbody>
        @foreach ($items as $item)
            <x-item.row :item="$item"></x-item.row>
        @endforeach
    </tbody>
</table>
