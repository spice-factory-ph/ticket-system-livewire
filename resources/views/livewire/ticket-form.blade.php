<div>
  <x-flash type="success">
    {{ session()->get('success') }}
  </x-flash>

  @if ($ticket->exists)
    <h4>Update a ticket</h4>
    <form action="{{ route('tickets.update', $ticket->id) }}" wire:submit.prevent="submitForm" method="POST">
      @method('PATCH')
    @else
      <h4>Create a ticket</h4>
      <form action="{{ route('tickets.store') }}" method="POST">
  @endif

  @csrf
  <div class="mb-3">
    <label for="title" class="form-label">Title</label>
    <input wire:model="ticket.title" type="text" class="form-control" name="title">
    @error('ticket.title')
      <p class="text-danger mt-1"> {{ $message }}</p>
    @enderror
  </div>

  <div class="mb-3">
    <label for="project" class="form-label">Project:</label>
    <select wire:model="ticket.project_id" class="form-select" name="project_id" id="project">
      <option hidden></option>
      @foreach ($projects as $project)
        <option value="{{ $project->id }}" {{ $project->id == optional($ticket->project)->id ? 'selected' : '' }}>
          {{ $project->name }}</option>
      @endforeach
    </select>
  </div>

  <div class="mb-3">
    <label for="type" class="form-label">Type:</label>
    <select wire:model="ticket.type_id" class="form-select" name="type_id" id="type">
      <option hidden></option>
      @foreach ($types as $type)
        <option value="{{ $type->id }}" {{ $type->id == optional($ticket->type)->id ? 'selected' : '' }}>
          {{ $type->name }}
        </option>
      @endforeach
    </select>
  </div>

  <div class="mb-3">
    <label for="status" class="form-label">Status:</label>
    <select wire:model="ticket.status_id" class="form-select" name="status_id" id="status">
      <option hidden></option>
      @foreach ($statuses as $status)
        <option value="{{ $status->id }}" {{ $status->id == optional($ticket->status)->id ? 'selected' : '' }}>
          {{ $status->name }}</option>
      @endforeach
    </select>
  </div>

  <div class="mb-3">
    <label for="description" class="form-label">Description</label>
    <textarea wire:model="ticket.description" class="form-control" name="description" id="description" rows="3"></textarea>
    @error('ticket.description')
      <p class="text-danger mt-1"> {{ $message }}</p>
    @enderror
  </div>

  <div class="mb-3">
    <label for="priority" class="form-label">Priority:</label>
    <select wire:model="ticket.priority_id" class="form-select" name="priority_id" id="priority">
      <option hidden></option>
      @foreach ($priorities as $priority)
        <option value="{{ $priority->id }}" {{ $priority->id == optional($ticket->priority)->id ? 'selected' : '' }}>
          {{ $priority->name }}</option>
      @endforeach
    </select>
  </div>

  <div class="mb-3">
    <label for="assigned_to" class="form-label">Assigned to:</label>
    <select wire:model="ticket.assigned_to" class="form-select" name="assigned_to" id="assigned_to">
      <option hidden></option>
      @foreach ($users as $user)
        <option value="{{ $user->id }}" {{ $user->id == optional($ticket->assignee)->id ? 'selected' : '' }}>
          {{ $user->name }}</option>
      @endforeach
    </select>
  </div>

  <div>
    <button type="submit" class="btn btn-success">Submit</button>
    <a href="{{ route('tickets.index') }}" class="btn btn-danger">Cancel</a>
  </div>
  </form>

  @if ($ticket->exists)
    <livewire:comments-section :ticket="$ticket" />
  @endif
</div>
