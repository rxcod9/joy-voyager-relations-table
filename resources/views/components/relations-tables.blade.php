@foreach($relations as $relation => $slug)
    <x-joy-voyager-relations-table
        :parentSlug="$parentSlug"
        :id="$id"
        :relation="$relation"
        :slug="$slug"
        :dataId="($dataId ?? 'relations') . '-' . $relation . '-' . $slug"
        :without-checkbox="$withoutCheckbox"
        :without-actions="$withoutActions"
        :with-label="$withLabel"
    />
@endforeach