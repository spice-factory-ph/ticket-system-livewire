<div>
  <div class="mb-3">
    <form class="row g-3" action="{{ route('tickets.index') }}" method="GET">
      <div class="col-md-2">
        <input wire:model="search" type="text" name="search" class="form-control" value="{{ request()->search }}"
          placeholder="Search">
      </div>
      <div class="col-md-2">
        <select wire:model="assignee" name="assignee" class="form-control">
          <option value="">User...</option>
          @foreach ($users as $user)
          <option value="{{ $user->id }}" {{ request()->assignee == $user->id ? 'selected' : '' }}>
            {{ $user->name }}</option>
          @endforeach
        </select>
      </div>
      <div class="col-md-2">
        <select wire:model="type" name="type" class="form-control">
          <option value="">Type...</option>
          @foreach ($types as $type)
          <option value="{{ $type->id }}" {{ request()->type_id == $type->id ? 'selected' : '' }}>
            {{ $type->name }}</option>
          @endforeach
        </select>
      </div>
      <div class="col-md-2">
        <select wire:model="priority" name="priority" class="form-control">
          <option value="">Priority...</option>
          @foreach ($priorities as $priority)
          <option value="{{ $priority->id }}" {{ request()->priority == $priority->id ? 'selected' : '' }}>
            {{ $priority->name }}</option>
          @endforeach
        </select>
      </div>
      <div class="col-md-2">
        <select wire:model="status" name="status" class="form-control">
          <option value="">Status...</option>
          @foreach ($statuses as $status)
          <option value="{{ $status->id }}" {{ request()->status == $status->id ? 'selected' : '' }}>
            {{ $status->name }}</option>
          @endforeach
        </select>
      </div>
      <div class="col-md-2">
        <button type="submit" class="btn btn-primary">Search</button>
      </div>
    </form>
  </div>

  <table class="table">
    <thead>
      <tr>
        <th width="300">
          <div class="flex items-center">
            <button wire:click="sortBy('title')" class="border-0 fw-bold">Title</button>
          </div>
        </th>
        <th width="150"><button wire:click="sortBy('type_id')" class="border-0 fw-bold">Type</button></th>
        <th width="150"><button wire:click="sortBy('priority_id')" class="border-0 fw-bold">Priority</button></th>
        <th>Status</th>
        <th>Assignee</th>
        <th>Reporter</th>
        <th colspan="2" class="text-center">Actions</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($tickets as $ticket)
      <tr wire:key="ticket-{{ $ticket->id }}">
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
          <form action="{{ route('tickets.destroy', $ticket->id) }}" id="delete-{{ $ticket->id }}" method="POST" hidden>
            @method('DELETE')
            @csrf
          </form>
          <button type="button" class="btn btn-danger deleteButton" id="{{ $ticket->id }}"><i id="{{ $ticket->id }}"
              class="fa-solid fa-trash-can"></i></button>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>

  {{ $tickets->links() }}
</div>