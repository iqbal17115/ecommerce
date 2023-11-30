<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('css/web/sign_in.css') }}">
</head>

<body>

    <div class="wrapper">
        <div class="container">
          <div class="col-left">
            <div class="login-form">
              <h2>Login</h2>
              <form method="POST" action="{{ route('customer-login') }}" id="login-form">
                @csrf
                <p>
                  <input type="text" name="mobile" placeholder="Email or Mobile" required>
                </p>
                <p>
                  <input type="password" name="password" placeholder="Password" required>
                </p>
                <p>
                  <input class="btn" type="submit" value="Sing In" />
                </p>
                <p>
                  <a href="">Forget Password?</a>
                </p>
              </form>
            </div>
          </div>
          <div class="col-right">
            <div class="login-social">
              <h2>Login with</h2>
              <a class="btn btn-go" href="">Google</a>
              <a class="btn btn-fb" href="">Facebook</a>
              <a class="btn btn-tw" href="">Twitter</a>
            </div>
          </div>
        </div>
        <div class="credit">
        </div>
      </div>
</body>

</html>
