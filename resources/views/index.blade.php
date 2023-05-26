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

  {{-- <livewire:data-table :statuses="$statuses" :tickets="$tickets" :types="$types" :users="$users" :priorities="$priorities" /> --}}

  <div id="react-table"></div>

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
