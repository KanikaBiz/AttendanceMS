<tr id="tr_object_id_{{ $row->id }}">
    <td>{{ $row->id }}</td>
    <td>{{ $row->name }}</td>
    <td>{{ $row->year->name }}</td>
    <td>{{ date('d-M-Y', strtotime($row->created_at)) }}</td>
    <td>
        <input id="status" name="status" data-id="{{ $row->id }}"
            {{ $row->status ? 'checked' : '' }} title="Status" type="checkbox"
            class="ace-switch input-lg ace-switch-yesno bgc-green-d2 text-grey-m2" />
    </td>
    <td>
        <div class="d-flex align-items-center gap-3 fs-6">
            @can($prefix . 'edit')
                <a id="objectEdit" data-id="{{ $row->id }}" href="{{ route('admin.' . $crudRoutePath . '.edit', $row->id) }}"
                    class="objectEdit btn btn-sm btn-success" style="cursor: pointer;" data-toggle="tooltip" data-placement="bottom"
                    title="Edit info" aria-label="Edit"><i class="fas fa-edit"></i></a>
            @endcan
            @can($prefix . 'delete')
              <a id="objectDelete" data-id="{{ $row->id }}"
                href="{{ route('admin.' . $crudRoutePath . '.destroy', $row->id) }}" class="objectDelete btn btn-sm btn-danger"
                data-toggle="tooltip" data-placement="bottom" title="Delete" aria-label="Delete"><i
                  class="far fa-trash-alt"></i></a>
            @endcan
        </div>
    </td>
</tr>
