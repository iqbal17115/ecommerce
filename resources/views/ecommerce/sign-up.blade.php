<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
  <style>
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
      top: 40%;
      left: 50%;
      transform: translate(-50%, -50%);
      box-shadow: 1px 1px 15px rgba(0, 0, 0, 0.15);
      backdrop-filter: blur(4px);
      -webkit-backdrop-filter: blur(4px);
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
      height: 30px;
      padding: 10px;
      margin-bottom: 15px;
      border: 1px solid #ccc;
      border-radius: 20px;
      font-size: 1rem;
      transition: all 450ms;
    }

    .form1 input[type="radio"] {
      font-size: 14px;
      size: 10px;
      height: 12px;
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
        <input type="text" name="name" id="name" placeholder="Enter Full Name" required>

        <label for="mobile">
          Number <span class="required">*</span>
        </label>
        <input type="text" name="mobile" id="mobile" placeholder="Enter Mobile Number" required>

        <label for="email">
          Email
        </label>
        <input type="email" name="email" id="email" placeholder="Enter Email Address">

        <label for="gender">
          Gender
        </label>
        <select id="gender" name="gender">
          <option value="" disabled selected>Select Gender</option>
          <option value="male">Male</option>
          <option value="female">Female</option>
        </select>

        <label for="bday">
          Date Of Birth
        </label>
        <input type="date" name="bday" id="bday">

        <label for="password">
          Password <span class="required">*</span>
        </label>
        <input type="password" name="password" id="password" placeholder="Password" required>

        <button class="btn" type="submit">Register</button>
      </form>
    </div>
  </div>
</body>

</html>
