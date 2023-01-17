@foreach($relations as $relation => $slug)
    <x-joy-voyager-relations-table-script
        :parentSlug="$parentSlug"
        :id="$id"
        :relation="$relation"
        :slug="$slug"
        :with-label="$withLabel"
        :auto-width="$autoWidth"
        :column-defs="$columnDefs"
        :without-checkbox="$withoutCheckbox"
        :without-actions="$withoutActions"
        :dataId="($dataId ?? 'relations') . '-' . $relation . '-' . $slug"
    />
@endforeach