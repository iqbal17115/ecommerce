<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login Form</title>
  <link rel="stylesheet" href="{{ asset('css/web/sign_in.css') }}">
</head>

<body>
  <div class="login-form">
    <form style="margin-top: 20px;" method="POST" action="{{ route('login') }}" id="login-form">
        @csrf
        <label for="mobile"> Number</label>
        <input type="text" name="mobile" placeholder="Enter Mobile Number"  autocomplete="name" />
        <label for="psw">Password</label>
        <input type="password" name="password" placeholder="Enter Password" autocomplete="password" />
        <button class="btn" type="submit" type="submit">Login Now</button>
        <div class="social">
          <div class="gg"><i class="bi bi-google"></i> Google</div>
          <div class="fb"><i class="bi bi-facebook"></i> Facebook</div>
        </div>
      </form>
  </div>
</body>

</html>

