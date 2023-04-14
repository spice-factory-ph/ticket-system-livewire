@if (session()->has('success'))
  <div class="alert {{ $type == 'success' ? 'alert-success' : 'alert-danger' }}">
    {{ $slot }}
  </div>
@endif
