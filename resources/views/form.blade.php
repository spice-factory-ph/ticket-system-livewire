<x-layout>
  @if (session()->has('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}
    </div>
  @endif
  
  @if ($ticket->exists)
    <h4>Update a ticket</h4>
    <form action="{{ route('tickets.update', $ticket->id) }}" method="POST">
      @method('PATCH')
    @else
      <h4>Create a ticket</h4>
      <form action="{{ route('tickets.store') }}" method="POST">
  @endif

  @csrf
  <div class="mb-3">
    <label for="title" class="form-label">Title</label>
    <input type="text" class="form-control" name="title" value="{{ $ticket->title }}">
  </div>

  <div class="mb-3">
    <label for="project" class="form-label">Project:</label>
    <select class="form-select" name="project_id" id="project">
      <option hidden></option>
      @foreach ($projects as $project)
        <option value="{{ $project->id }}" {{ $project->id == optional($ticket->project)->id ? 'selected' : '' }}>
          {{ $project->name }}</option>
      @endforeach
    </select>
  </div>

  <div class="mb-3">
    <label for="type" class="form-label">Type:</label>
    <select class="form-select" name="type_id" id="type">
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
    <select class="form-select" name="status_id" id="status">
      <option hidden></option>
      @foreach ($statuses as $status)
        <option value="{{ $status->id }}" {{ $status->id == optional($ticket->status)->id ? 'selected' : '' }}>
          {{ $status->name }}</option>
      @endforeach
    </select>
  </div>

  <div class="mb-3">
    <label for="description" class="form-label">Description</label>
    <textarea class="form-control" name="description" id="description" rows="3">{{ $ticket->description }}</textarea>
  </div>

  <div class="mb-3">
    <label for="priority" class="form-label">Priority:</label>
    <select class="form-select" name="priority_id" id="priority">
      <option hidden></option>
      @foreach ($priorities as $priority)
        <option value="{{ $priority->id }}" {{ $priority->id == optional($ticket->priority)->id ? 'selected' : '' }}>
          {{ $priority->name }}</option>
      @endforeach
    </select>
  </div>

  <div class="mb-3">
    <label for="assigned_to" class="form-label">Assigned to:</label>
    <select class="form-select" name="assigned_to" id="assigned_to">
      <option hidden></option>
      @foreach ($users as $user)
        <option value="{{ $user->id }}" {{ $user->id == optional($ticket->assignee)->id ? 'selected' : '' }}>
          {{ $user->name }}</option>
      @endforeach
    </select>
  </div>

  <div class="mb-3">
    <label for="comments" class="form-label">Comments:</label>
    @foreach ($comments as $comment)
      <div class="mb-3">
        <span>{{ $comment->user->name }}:</span>
        <p>{{ $comment->text }}</p>
      </div>
    @endforeach
  </div>

  <div class="mb-3">
    <textarea name="text" id="" cols="30" rows="3" class="form-control"
      placeholder="Add a comment..."></textarea>
  </div>

  <div>
    <button type="submit" class="btn btn-success">Submit</button>
    <a href="{{ route('tickets.index') }}" class="btn btn-danger">Cancel</a>
  </div>
  </form>
</x-layout>
