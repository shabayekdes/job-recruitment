<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Talents Mine - Login</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.4/examples/sign-in/">

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="{{ asset('css/style.css')}}">

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>

</head>

<body class="text-center" data-new-gr-c-s-check-loaded="14.990.0" data-gr-ext-installed="">

    <form class="form-signin" action="{{ route('job.login.store') }}" method="POST">
        @csrf
        <img src="https://recruitment.talentsmine.net/wp-content/uploads/2019/11/logox300.png" width="122" height="76"
            alt="Recruitment Talents Mine">
        <h1 class="h3 mt-5 font-weight-normal">Please sign in</h1>
        <p class="mb-3 text-muted mt-3">
            OR <a class="login-register-switch-link" href="#">create an account</a>
        </p>
        @if (session('status'))
            <div class="alert alert-danger">
                {!! session('status') !!}
            </div>
        @endif

        <input type="hidden" name="job_id" value="{{ $job }}">

        <div class="form-group">
            <label for="inputEmail" class="sr-only">Email address</label>
            <input type="email" name="email" id="inputEmail" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="Email address"
                required="" autofocus="">
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
        </div>
        <div class="form-group">
            <label for="inputPassword" class="sr-only">Password</label>
            <input type="password" name="password" id="inputPassword" class="form-control @error('password') is-invalid @enderror" value="{{ old('password') }}" placeholder="Password"
                required="">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
        </div>

        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>

        <p class="mb-2 text-muted mt-3">
            <a href="https://recruitment.talentsmine.net/my-account/lost-password/">Lost your password?</a>
        </p>

        <p class="mt-5 mb-2 text-muted mt-3">Recruitment Talents Mine 2021</p>
    </form>

</body>

</html>