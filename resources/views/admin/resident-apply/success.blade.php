<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ trans('admin.resident.actions.success') }} | Covid Tracker</title>

    @include('brackets/admin-ui::admin.partials.main-styles')

    @yield('styles')

</head>

<body class="app header-fixed">

    <div class="app-body">

        <main class="main">

            <div class="container-xl">

                <div class="card">

                    <div class="card-body">

                        <h2>Thank you for applying, {{ $name }}! <br /><br /> Once approved, an email containing your QR Code ID will be sent to you.</h2>

                    </div>

                </div>

            </div>

        </main>

    </div>

</body>

</html>