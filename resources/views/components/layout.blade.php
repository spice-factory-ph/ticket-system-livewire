<!DOCTYPE html>
<html>

<head>
  <title>Ticketing System</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <script src="{{ asset('js/app.js') }}" type="text/javascript"></script>

</head>

<body>
  <header>
    <div>
      <h1>Ticketing System</h1>
      {{ Auth::user()->name }}
      <div class="d-flex justify-content-end">
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <a class="btn btn-secondary" href="route('logout')"
            onclick="event.preventDefault(); this.closest('form').submit();">
            {{ __('Log Out') }}</a>
        </form>
      </div>
    </div>
  </header>
  <main>

    {{ $slot }}
  </main>
  @stack('script')
</body>

</html>
