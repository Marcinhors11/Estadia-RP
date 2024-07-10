<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Universidad Politectica del Valle de Toluca</title>


    <!--Bootstrap JS-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

</head>

<body>
    <header id="header">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg 12 col-xl-12">

                    <div class="row">
                        <div id="logoheader" class="col-xs-12 col-sm-12 col-md-3 col-lg-3 col-xl-3 mt-3">
                            <a href="{{ route('auth.login') }}"><img
                                    src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQLwhSixNsZQCn1i1yVJnASZGLneVdyi-TkvA&s"
                                    class="img-fluid" alt="Universidad Politécnica del Valle de Toluca" height="auto"
                                    width="180px"></a>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9 col-xl-9 mt-3">
                            <h1>Universidad Politécnica del Valle de Toluca</h1>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">
                        </div>
                        <div class=" col-xs-12 col-sm-12 col-md-9 col-lg-9 col-xl-9">
                            <h4>Repositorio Universidad Politéctica del Valle de Toluca</h4>
                        </div>
                    </div>
                </div>
            </div>
    </header>


    <section class="d-flex mt-3 m-auto">
        @yield('content')
    </section>

    <!--Bootstrap JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    @yield('scripts')
</body>

</html>
