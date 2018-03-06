<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Laravel Base Using Bootstrap Vue</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <!-- Default Styles -->
    <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet">

    <!-- Styles Stack -->
    @stack('styles')
</head>
<body>
<div id="app">

    <b-container>

        <b-row>

            <b-col>

                <b-jumbotron bg-variant="info" text-variant="white" border-variant="dark">
                    <template slot="header">
                        Bootstrap Vue
                    </template>
                    <template slot="lead">
                        This is a simple hero unit, a simple jumbotron-style component for
                        calling extra attention to featured content or information.
                    </template>
                    <hr class="my-4">
                    <p>
                        It uses utility classes for typography and spacing to space content
                        out within the larger container.
                    </p>
                </b-jumbotron>
            </b-col>
        </b-row>
    </b-container>


</div>

<!-- Scripts -->
<script>


    window.Laravel = {

        urls: {}
    }
</script>

<script src="{{ asset('assets/js/app.js') }}"></script>

<!-- Stack Scripts -->
@stack('scripts')
</body>
</html>
