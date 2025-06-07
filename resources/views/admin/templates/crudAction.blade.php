<div class="d-flex align-items-center gap-3 fs-6">
  {{-- @can($prefix . 'show')
    <a id="objectShow" data-id="{{ $row->id }}" href="{{ route('admin.' . $crudRoutePath . '.show', $row->id) }}"
      class="objectShow text-primary" style="cursor: pointer;" data-toggle="tooltip" data-placement="bottom"
      title="View detail" aria-label="Views"><i class="fa fa-eye"></i></a>
  @endcan --}}
  @can($prefix . 'edit')
    <a id="objectEdit" data-id="{{ $row->id }}" href="{{ route('admin.' . $crudRoutePath . '.edit', $row->id) }}"
      class="objectEdit btn btn-sm btn-success" style="cursor: pointer;" data-toggle="tooltip" data-placement="bottom"
      title="Edit info" aria-label="Edit"><i class="fas fa-edit"></i></a>
  @endcan
  |
  @can($prefix . 'delete')
    <a id="objectDelete" data-id="{{ $row->id }}"
      href="{{ route('admin.' . $crudRoutePath . '.destroy', $row->id) }}" class="objectDelete btn btn-sm btn-danger"
      data-toggle="tooltip" data-placement="bottom" title="Delete" aria-label="Delete"><i
        class="far fa-trash-alt"></i></a>
  @endcan
</div>
