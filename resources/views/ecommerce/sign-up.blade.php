<!DOCTYPE html>
<html>

<head>
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/web/sign_up.css') }}">

</head>

<body>

    <!-- Add your signup form here -->
    <div class="row">
<div class="col-md-12">
    <div class="signup-form">
        <div class="container">
            <div class="header">
                <h1>Create an Account</h1>
                @if (session('message'))
                    <div class="alert-message">
                        {{ session('message') }}
                    </div>
                @endif

            </div>
            <form method="POST" action="{{ route('customer-register') }}" id="checkout-form">
                @csrf
                <div class="input">
                    <i class="fa-solid fa-user"></i>
                    <input type="text" name="name" placeholder="Name" />
                </div>
                <div class="input">
                    <i class="fa-solid fa-envelope"></i>
                    <input type="text" name="mobile" placeholder="Mobile" />
                </div>
                <div class="input">
                    <i class="fa-solid fa-lock"></i>
                    <input type="password" name="password" placeholder="Password" />
                </div>
                <input class="signup-btn" type="submit" value="SIGN UP" />
            </form>
            <p>Or sign up with</p>
            <div class="social-icons">
                <i class="fa-brands fa-facebook-f"></i>
                <i class="fa-brands fa-twitter"></i>
                <i class="fa-brands fa-google"></i>
            </div>
            <p>Already have an account <a href="{{ route('customer-sign-in') }}">sign in</a></p>
        </div>
        </div>
    </div>
</div>

        <!-- Option 1: Bootstrap Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

        <!-- Option 2: Separate Popper and Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

</body>

</html>
