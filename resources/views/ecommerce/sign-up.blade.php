<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
  <style>
    @import url("https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css");
    body {
      background-color: #f4631b;
      font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
    }

    .form1 {
      background: #ffffff;
      margin-top: 0px;
      height: 100%;
      border-radius: 15px;
      box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.2);
    }

    .form1 form {
      position: absolute;
      top: 45%;
      left: 50%;
      transform: translate(-50%, -50%);
      border-radius: 15px;
      padding: 20px;
      width: 340px;
      background: #f7f7f7;
    }

    .form1 label {
      display: block;
      margin-bottom: 5px;
      font-weight: bold;
    }

    .form1 label span.required {
      color: red;
      font-size: 1.2em;
      margin-left: 2px;
    }

    .form1 input,
    .form1 select {
      display: block;
      width: 95%;
      height: 40px;
      padding: 10px;
      margin-bottom: 5px;
      border: 1px solid #ccc;
      border-radius: 20px;
      font-size: 1rem;
      transition: all 450ms;
    }

    .form1 input.is-invalid,
    .form1 select.is-invalid {
      border: 1px solid red;
    }

    .form1 .error-message {
      color: red;
      font-size: 0.85rem;
      margin-bottom: 10px;
      display: block;
    }

    .form1 button {
      height: 40px;
      width: 100%;
      border-radius: 25px;
      font-weight: 700;
      font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
      font-size: 1.2rem;
      color: #fff;
      cursor: pointer;
      transition: all 450ms;
      background: #f4631b;
      border: none;
    }

    .form1 button:hover {
      background-color: #d85316;
    }

    .signin-link {
      display: block;
      text-align: center;
      margin-top: 20px;
      font-size: 1rem;
    }

    .signin-link a {
      color: #f4631b;
      text-decoration: none;
      font-weight: bold;
    }

    .signin-link a:hover {
      color: #d85316;
    }

    .form-summary {
      background-color: #ffe6e6;
      color: #b00;
      padding: 10px;
      border: 1px solid #b00;
      border-radius: 5px;
      margin-bottom: 15px;
      font-size: 0.95rem;
    }
  </style>
</head>

<body>
  <div class="main">
    <div class="form1">
      <form method="POST" action="{{ route('customer-register') }}" id="checkout-form">
        @csrf
        <label for="name">
          Name <span class="required">*</span>
        </label>
        <input type="text" name="name" id="name" placeholder="Enter Full Name" class="{{ $errors->has('name') ? 'is-invalid' : '' }}" value="{{ old('name') }}">
        @error('name')
        <span class="error-message">{{ $message }}</span>
        @enderror

        <label for="mobile">
          Number <span class="required">*</span>
        </label>
        <input type="text" name="mobile" id="mobile" placeholder="Enter Mobile Number" class="{{ $errors->has('mobile') ? 'is-invalid' : '' }}" value="{{ old('mobile') }}">
        @error('mobile')
        <span class="error-message">{{ $message }}</span>
        @enderror

        <label for="email">
          Email(Optional)
        </label>
        <input type="email" name="email" id="email" placeholder="Enter Email Address" value="{{ old('email') }}">
        @error('email')
        <span class="error-message">{{ $message }}</span>
        @enderror

        <label for="gender">
          Gender <span class="required">*</span>
        </label>
        <select id="gender" name="gender" class="{{ $errors->has('gender') ? 'is-invalid' : '' }}">
          <option value="" disabled {{ old('gender') ? '' : 'selected' }}>Select Gender</option>
          <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
          <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
        </select>
        @error('gender')
        <span class="error-message">{{ $message }}</span>
        @enderror

        <label for="bday">
          Date Of Birth <span class="required">*</span>
        </label>
        <input type="date" name="bday" id="bday" class="{{ $errors->has('bday') ? 'is-invalid' : '' }}" value="{{ old('bday') }}">
        @error('bday')
        <span class="error-message">{{ $message }}</span>
        @enderror

        <label for="password">Password</label>
        <div style="position: relative;">
          <input type="password" name="password" id="password" class="{{ $errors->has('password') ? 'is-invalid' : '' }}" placeholder="Enter Password" autocomplete="password" />
          <i class="bi bi-eye-slash" id="togglePassword" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer;"></i>
        </div>
        @error('password')
        <span class="error-message">{{ $message }}</span>
        @enderror

        <button class="btn" type="submit">Register</button>

        <!-- Sign-in option link below the register button -->
        <div class="signin-link">
          <span>Already have an account? </span>
          <a href="{{ route('customer-sign-in') }}">Sign In</a>
        </div>
      </form>
    </div>
  </div>

  <script>
    const togglePassword = document.querySelector("#togglePassword");
    const passwordField = document.querySelector("#password");

    togglePassword.addEventListener("click", function () {
      const type = passwordField.getAttribute("type") === "password" ? "text" : "password";
      passwordField.setAttribute("type", type);
      this.classList.toggle("bi-eye");
      this.classList.toggle("bi-eye-slash");
    });
  </script>
</body>

</html>
