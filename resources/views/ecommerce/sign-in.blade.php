<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/web/sign_in.css') }}">
</head>

<body>

    <div class="wrapper" style="background-color: #fff;">
        <div class="sign-panels">
            <div class="login">
                <div class="title">
                    <span><img src="{{ asset('storage/' . $company_info?->logo) }}"
                            class="w-100 ml-sm-0 ml-md-5 lazy-load" width="111" height="44"
                            style="height: 64px;width: 151px;filter: brightness(4) contrast(1.5) saturate(1.5);"
                            alt="Porto Logo"></span>
                    <p>Welcome to @if ($company_info && $company_info->icon)
                            {{ $company_info?->name }}
                        @endif.</p>
                </div>

                {{-- <div>
                <a href="#" class="btn-face"><i class="fa fa-facebook" aria-hidden="true"></i> Facebook</a>
                <a href="#" class="btn-twitter"><i class="fa fa-twitter" aria-hidden="true"></i> Twitter</a>
            </div> --}}

                <div class="row">
                    <div class="col-md-6">
                        <form method="POST" action="{{ route('customer-login') }}" id="login-form">
                            @csrf
                            <input type="text" name="identifier" placeholder="Email or Mobile" required>
                            <input type="password" name="password" placeholder="Password" required>
                            <input type="checkbox" id="remember">
                            <label for="remember">Remember me</label>

                            <a href="javascript:void(0)" class="btn-reset btn-fade" style="padding-top: 9px;">Forgot
                                <span style="color: #077e7e;">password<span>? <i class="fa fa-long-arrow-right"
                                            aria-hidden="true"></i></a>
                            <button type="submit" class="btn-signin" style="width: 100%;">Sign In</button>

                            <a href="{{ route('sign-up') }}" class="btn-member btn-fade">Don't have an Account? <span
                                    style="color: #077e7e;"><span>Sign Up</span> <i class="fa fa-long-arrow-right"
                                        aria-hidden="true"></i></a>
                        </form>
                    </div>
                    <div class="col-md-1">
                        <div class="or">
                            <span>OR</span>
                            <hr>
                        </div>
                    </div>

                    <div class="col-md-5">
                        <div>
                            <button class="loginBtn loginBtn--facebook" style="margin-top: 10px;">
                                Login with Facebook
                            </button>
                        </div>
                        <div>
                            <button class="loginBtn loginBtn--google">
                                Login with Google
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</body>

</html>
