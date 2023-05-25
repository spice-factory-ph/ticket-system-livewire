<x-layout>
  <div class="d-flex justify-content-between">
    <h2>Search tickets</h2>
    <div>
      <a href="{{ route('tickets.create') }}" class="btn btn-success" role="button">Create new ticket</a>
    </div>
  </div>

  <div>
    <p>Total number of bugs: {{ $totalBugTickets }}</p>
    <p>Total number of tasks: {{ $totalTaskTickets }}</p>
    <p>Total number of stories: {{ $totalStoryTickets }}</p>
  </div>

  <x-flash type="success">
    {{ session()->get('success') }}
  </x-flash>

  <livewire:data-table :statuses="$statuses" :tickets="$tickets" :types="$types" :users="$users" :priorities="$priorities" />

  @push('script')
    
  @endpush
</x-layout>
