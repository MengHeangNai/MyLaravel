<tr @if ($loop->even) class="table-primary" @endif>
    <td>{{ $contact->id }}</td>
    <td>{{ $contact->first_name }}</td>
    <td>{{ $contact->last_name }}</td>
    <td>{{ $contact->email }}</td>
    <td>{{ $contact->company->name }}</td>
    <td width="150">
        <a href="{{ route('contacts.show', $contact->id) }}" class="btn btn-sm btn-circle btn-outline-info"
            title="Show"><i class="bi bi-eye-fill"></i></a>
        <a href="{{ route('contacts.edit', $contact->id) }}" class="btn btn-sm btn-circle btn-outline-secondary"
            title="Edit"><i class="bi bi-pencil-square"></i></a>
        <form action="{{ route('contacts.destroy', $contact->id) }}" method="POST"
            onsubmit="return confirm('Are you sure?')" style="display: inline">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-sm btn-circle btn-outline-danger" title="Delete"><i
                    class="bi bi-x-circle"></i>
            </button>
        </form>
</tr>
