<!DOCTYPE html>
<html>

<head>
    <title>Register</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/web/sign_up.css') }}">

</head>

<body>

    <!-- Add your signup form here -->
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
</body>

</html>
