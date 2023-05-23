<style>
    /**
 * Created by Muhammed Erdem on 10.10.2017.
 */

* {
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
}

body {
    margin: 0;
}

.wrapper {
    width: 1%;
    height: 100vh;
    background: #ededed;
    display: table-cell;
    vertical-align: middle;
    font-family: 'Dosis', sans-serif;
}

.sign-panels {
    width: 470px;
    background: #fff;
    padding: 10px 20px;
    margin: 40px auto;
    border-radius: 20px;
    text-align: center;
}
.login,.signup {
    position: relative;
}


.title {
    color: #9f9f9f;
}

.title span {
    display: block;
    font-size: 46px;
    font-weight: bold;
}

.title p {
    font-size: 20px;
    font-weight: 500;
}

.btn-face,.btn-twitter {
    color: #fff;
    display: inline-block;
    width: 200px;
    font-size: 20px;
    height: 50px;
    border-radius: 50px;
    text-decoration: none;
    padding: 11px 0;
    font-weight: 500;
}

.btn-face .fa,.btn-twitter .fa {
    margin-right: 5px;
}

.btn-face {
    background: #5397d7;
    margin-right: 25px;
}

.btn-twitter {
    background: #40b9e0;
}

.or {
    margin: 35px 0;
    font-weight: 600;
    color: #9f9f9f;
}

.or:after {
    content: '';
    display: block;
    width: 100%;
    height: 1px;
    background: #cecece;
    position: absolute;
    margin-top: -10px;
    z-index: 0;
}

.or span {
    display: block;
    background: #fff;
    width: 50px;
    margin: auto;
    position: relative;
    z-index: 2;
}

.sign-panels input {
    width: 100%;
    display: block;
    margin-bottom: 15px;
    height: 50px;
    border-radius: 50px;
    border: none;
    background: #ededed;
    text-align: center;
    padding: 10px;
    font-size: 15px;
    color: #7c7c7c;
    font-weight: 500;
}

.sign-panels input:focus {
    outline:none;
}

.sign-panels input[type="checkbox"] {
    display: none;
}

.sign-panels input[type="checkbox"] + label {
    display: block;
    width: 50%;
    text-align: left;
    padding-left: 60px;
    cursor: pointer;
    color: #828282;
    font-weight: 500;
    margin-top: 10px;
    float: left;
    height: 50px;
    padding-top: 15px;
}

.sign-panels input[type="checkbox"] + label:before {
    content: '';
    display: block;
    width: 15px;
    height: 15px;
    background: #dbdbdb;
    position: absolute;
    left: 30px;
    border-radius: 50%;
    border: 2px solid white;
    box-shadow: 0 0 0 5px #ededed;
    -webkit-transition: all .3s ease;
    transition: all .3s ease;
}
.sign-panels input[type="checkbox"]:checked + label:before {
    background: #FF5722;
    box-shadow: 0 0 0 5px #FF5722;
    -webkit-transition: all .3s ease;
    transition: all .3s ease;
}

.btn-signin {
    display: inline-block;
    width: 40%;
    margin-top: 10px;
    background: #ec581e;
    border-radius: 50px;
    padding: 8px;
    font-size: 20px;
    color: #fff;
    text-decoration: none;
    font-weight: 500;
    border: none;
    box-shadow: none;
    cursor: pointer;
}

.btn-reset,.btn-member,.btn-fade {
    font-size: 19px;
    font-weight: 500;
    color: #9f9f9f;
    display: block;
    /*width: 210px;*/
    margin: 30px auto 0;
    text-decoration: none;

}
.btn-member {
    margin-top: 15px;
}

.btn-reset .fa,.btn-member .fa {
    margin-left: 6px;
}

.notification p {
    font-size: 20px;
    font-weight: 600;
    color: #9f9f9f;
}

.notification span {
    color: #ec581e;
}

.error {
    display: block;
    color: #ec581e;
    font-size: 20px;
    font-weight: 600;
    margin: 15px 0;
}

@media screen and (max-width: 768px) {
    .sign-panels {
        width: 90%;
        padding: 40px;
    }
}

@media screen and (max-width: 570px) {
    .sign-panels {
        padding: 40px 20px;
    }

    .btn-face, .btn-twitter {
        width: 100%;
    }
    .btn-face {
        margin-right: 0;
        margin-bottom: 25px;
    }
}

@media screen and (max-width: 480px) {
    .sign-panels input[type="checkbox"] + label {
        width: 100%;
    }

    .btn-signin {
        width: 80%;
    }

    .title span {
        font-size: 36px;
    }

}



</style>
<div class="wrapper">
    <div class="sign-panels">
        <div class="login">
            <div class="title">
                <span><img src="{{ asset('storage/'.$company_info->logo) }}" class="w-100 ml-sm-0 ml-md-5 lazy-load"
                    width="111" height="44"
                    style="height: 64px;width: 151px;filter: brightness(4) contrast(1.5) saturate(1.5);" alt="Porto Logo"></span>
                <p>Welcome to @if($company_info && $company_info->icon) {{$company_info->name}} @endif.</p>
            </div>

            <div>
                <a href="#" class="btn-face"><i class="fa fa-facebook" aria-hidden="true"></i> Facebook</a>
                <a href="#" class="btn-twitter"><i class="fa fa-twitter" aria-hidden="true"></i> Twitter</a>
            </div>

            <div class="or"><span>OR</span></div>

            <form method="POST" action="{{ route('customer-login') }}" id="login-form">
                @csrf
                <input type="text" name="identifier"  placeholder="Email or Mobile" required>
                <input type="password" name="password" placeholder="Password" required>
                <input type="checkbox" id="remember" >
                <label for="remember">Keep me sign in</label>
                <button type="submit" class="btn-signin">Sign In</button>

                <a href="javascript:void(0)" class="btn-reset btn-fade">Recover your password <i class="fa fa-long-arrow-right"
                                                                                aria-hidden="true"></i></a>
                <a href="{{ route('sign-up') }}" class="btn-member btn-fade">Not a member yet? <i class="fa fa-long-arrow-right"
                                                                             aria-hidden="true"></i></a>
            </form>
        </div>


    </div>
</div>
