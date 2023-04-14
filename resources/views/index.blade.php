<x-layout>
  <div class="d-flex justify-content-between">
    <h2>Search tickets</h2>
    <div>
      <a href="{{ route('tickets.create') }}" class="btn btn-success" role="button">Create new ticket</a>
    </div>
  </div>
  <div class="mb-3">
    <form class="row g-3" action="{{ route('tickets.index') }}" method="GET">
      <div class="col-md-3">
        <input type="search" name="search" class="form-control" value="{{ request()->search }}" placeholder="Title">
      </div>
      <div class="col-md-3">
        <select name="assignee" class="form-control">
          <option value=""></option>
          @foreach ($users as $user)
            <option value="{{ $user->id }}" {{ request()->assignee == $user->id ? 'selected' : '' }}>
              {{ $user->name }}</option>
          @endforeach
        </select>
      </div>
      <div class="col-md-2">
        <button type="submit" class="btn btn-primary">Search</button>
      </div>
    </form>
  </div>
  <x-flash type="success">
    {{ session()->get('success') }}
  </x-flash>

  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Title</th>
        <th>Type</th>
        <th>Priority</th>
        <th>Status</th>
        <th>Assignee</th>
        <th>Reporter</th>
        <th colspan="2" class="text-center">Actions</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($tickets as $ticket)
        <tr>
          <td><a href="{{ route('tickets.show', $ticket->id) }}">{{ $ticket->title }}</a></td>
          <td>{{ $ticket->type->name }}</td>
          <td>{{ $ticket->priority->name }}</td>
          <td>{{ $ticket->status->name }}</td>
          <td>{{ $ticket->assignee->name }}</td>
          <td>{{ $ticket->reporter->name }}</td>
          <td class="text-center">
            <a href="{{ route('tickets.edit', $ticket->id) }}" class="btn btn-secondary"><i id="{{ $ticket->id }}"
                class="fa-solid fa-pencil"></i></a>
          </td>
          <td class="text-center">
            <form action="{{ route('tickets.destroy', $ticket->id) }}" id="delete-{{ $ticket->id }}" method="POST"
              hidden>
              @method('DELETE')
              @csrf
            </form>
            <button type="button" class="btn btn-danger deleteButton" id="{{ $ticket->id }}"><i
                id="{{ $ticket->id }}" class="fa-solid fa-trash-can"></i></button>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>

  {{ $tickets->links() }}

  @push('script')
    <script type="text/javascript">
      $(".deleteButton").click((e) => {
        let ticket_id = e.target.id
        Swal.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.isConfirmed) {
            $('form#delete-' + ticket_id).submit();
          }
        })
      });
    </script>
  @endpush
</x-layout>
