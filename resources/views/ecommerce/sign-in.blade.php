<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login Form</title>
  {{-- <link rel="stylesheet" href="{{ asset('css/web/sign_in.css') }}"> --}}
  <style>
@import url("https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css");
* {
  padding: 0%;
  margin: 0%;
  box-sizing: border-box;
  border: none;
  outline: none;
}
body {
  height: 100vh;
  background-color: #f4631b;
  font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
}


.login-form {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  height: 460px;
  width: 100%;
  background:  #fff;
}

.login-form h3 {
  font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
  padding: 10px 0px;
  font-size: 2rem;
  text-align: center;
}
.login-form label {
  display: block;
  padding: 10px 0px 5px 0px;
  font-size: 1.2rem;
  color: dark;
}

.login-form form {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    /* height: 460px; */
    width: 100%;
    padding: 20px;
    box-shadow: 1px 1px 15px 1px rgba(0, 0, 0, 0.15);
    backdrop-filter: blur(4px);
    -webkit-backdrop-filter: blur(4px);
    border-radius: 10px 50px;
    border: 1px solid rgba(255, 255, 255, 0.05);
}

/* Default width for the form */
.login-form form {
    width: 100%; 
    max-width: 340px; 
    margin: 0 auto; 
    margin: 10px;
  }
  
  /* For devices with screens wider than 768px (tablets and larger) */
  @media (min-width: 768px) {
    .login-form form {
      width: 80%; /* Adjust width to 80% for medium screens */
    }
  }
  
  /* For devices with screens wider than 1024px (desktops and larger) */
  @media (min-width: 1024px) {
    .login-form form {
      width: 50%; /* Adjust width to 50% for larger screens */
    }
  }
  
.login-form input[type="text"],
input[type="password"] {
  display: block;
  position: relative;
  height: 40px;
  width: 100%;
  padding: 10px;
  border: none;
  font-size: 1rem;
  font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto,
    Oxygen, Ubuntu, Cantarell, "Open Sans", "Helvetica Neue", sans-serif;
  cursor: pointer;
  transition: all 450ms;
  border-radius: 20px; /* Adjust the value as needed */
  padding: 10px; /* Optional: for better spacing inside the input */
  border: 1px solid #ccc; /* Optional: adds a border */
}

.login-form input::placeholder {
  font-size: 14px;
}

.login-form button {
  height: 35px;
  width: 100%;
  margin: 5px 0px;
  border-radius: 25px;
  font-weight: 700;
  font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
  font-size: 1.2rem;
  color: #000000c3;
  cursor: pointer;
  transition: all 450ms;
  background: #f4631b;
}

.login-form .social {
  display: flex;
  justify-content: space-evenly;
  align-items: center;
  gap: 10px;
}

/* Remember Me and Forgot Password on the same line */
.remember-forgot {
  display: flex;
  justify-content: space-between;  /* Distribute space evenly */
  align-items: center;
  margin-bottom: 5px; /* Space between this section and the login button */
}

.remember-me {
  display: flex;
  align-items: center;
}

.remember-me input {
  margin-top: 5px;
  margin-right: 10px; /* Space between checkbox and label */
}

.remember-me label {
  font-size: 0.8rem;
  color: #333;
}

.forgot-password {
  text-align: right;
}

.forgot-password a {
  font-size: 0.8rem;
  color: #f4631b;
  text-decoration: none;
  transition: color 0.3s ease;
}

.forgot-password a:hover {
  color: #ff7f47;
}

.social .gg,
.fb {
  width: 140px;
  padding: 5px;
  background-color: #00000023;
  /* color: #ffffff; */
  text-align: center;
  border-radius: 5px;
  cursor: pointer;
  transition: all 450ms;
}
.social .gg:hover,
.fb:hover {
  background-color: #00000036;
}

/* Styling for the Create Account link */
.create-account {
  text-align: center;
  margin-top: 0px; /* Space between social buttons and the Create Account message */
  margin-bottom: 5px;
}

.create-account p {
  font-size: 0.8rem;
  color: #333;
}

.create-account a {
  font-size: 0.8rem;
  color: #f4631b;
  text-decoration: none;
  transition: color 0.3s ease;
}
    </style>
</head>

<body>
  <div class="login-form">
    <form style="margin-top: 20px;" method="POST" action="{{ route('login') }}" id="login-form">
        @csrf
        <label for="mobile"> Number</label>
        <input type="text" name="mobile" placeholder="Enter Mobile Number"  autocomplete="name" required/>
        <label for="psw">Password</label>
        <input type="password" name="password" placeholder="Enter Password" autocomplete="password" required/>

        <!-- Remember Me and Forgot Password on the same line -->
    <div class="remember-forgot">
      <div class="remember-me">
        <input type="checkbox" name="remember" id="remember" />
        <label for="remember">Remember Me</label>
      </div>
      
      <div class="forgot-password">
        <a href="{{ route('password.request') }}">Forgot Password?</a>
      </div>
    </div>

        <button class="btn" type="submit" type="submit">Login Now</button>
        <!-- Don't have an account message -->
    <div class="create-account">
      <p>Don't have an account? <a href="{{ route('sign-up') }}">Create An Account</a></p>
    </div>
        <div class="social">
          <div class="gg"><i class="bi bi-google"></i> Google</div>
          <div class="fb"><i class="bi bi-facebook"></i> Facebook</div>
        </div>
      </form>
  </div>
</body>

</html>

