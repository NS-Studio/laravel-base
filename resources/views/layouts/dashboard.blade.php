<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible"
        content="IE=edge">
  <meta name="viewport"
        content="width=device-width, initial-scale=1">
  <meta name="csrf-token"
        content="{{ csrf_token() }}">

  <title>{{ config('app.name') }}</title>

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Raleway:100,600"
        rel="stylesheet"
        type="text/css">

  <!-- Default Styles -->
  <link href="{{ asset('assets/css/app.css') }}"
        rel="stylesheet">

  <style>

    .clickable {

      cursor : pointer;
    }

    .full-width {
      width : 100%;
    }
  </style>

  <!-- Styles Stack -->
  @stack('styles')
</head>
<body>


<div id="app">

  <navbar></navbar>

  <b-container fluid>
    <b-row>
      @if(Gate::allows('access-dashboard', $user ))
        <b-col cols="2"
               v-if="!isMobile"
               style="position: fixed; top: 54px; bottom: 0; border-right: 1px solid #e6eaef">

          <div id="navigation-vue">
            @if($user->hasRole('admin'))
              <admin-navigation></admin-navigation>
            @else
              <navigation-component></navigation-component>
            @endif
          </div>
        </b-col>
      @endif

      <main-content></main-content>

    </b-row>
  </b-container>
</div>

<!-- Scripts -->
<script>

    window.Laravel = {

        token: document.querySelector( 'meta[name=csrf-token]' ).content,

        urls: {

            ajax:   {
                search: "{{ route('ajax.search') }}",
              @if($user->hasRole('admin'))
              admin:    {

                  users: {

                      list:   "{{ route('admin.users.list') }}",
                      store:  "{{ route('admin.users.store') }}",
                      update: "{{ route('admin.users.update', ':id') }}",
                      delete: "{{ route('admin.users.delete', ':id') }}",
                  },
              },
              @elseif($user->hasRole('user'))
              users:    {},
              @endif
            },
            logout: "{{ route('logout') }}",
            admin:  {

                panel: "{{ route('admin.panel') }}",
            }
        }
    };
    window.app_name = "{{ config('app.name') }}";
    window.default_locale = "{{ config('app.locale') }}";
    window.fallback_locale = "{{ config('app.fallback_locale') }}";

    @auth
        window.user = @json($user);
  @endauth
</script>
@stack('urls')

<script src="{{ asset('/assets/js/manifest.js') }}"></script>
<script src="{{ asset('/assets/js/vendor.js') }}"></script>
<script src="{{asset('/assets/js/app.js')}}"></script>

<!-- Stack Scripts -->
@stack('scripts')
</body>
</html>