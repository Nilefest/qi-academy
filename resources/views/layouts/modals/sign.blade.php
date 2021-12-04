<!-- Modal. For Sign IN and Sign UP -->
<div class="modal_win container modal_sign_account signup_step">
    <div class="step_block signup_block">
        <h3>Create Account</h3>
        <a href="{{ url('auth/google') }}" class="login_button google">
            <i class="fab fa-google icon"></i>
            <span class="title">Sign up with Google</span>
        </a>
        <a href="{{ url('auth/facebook') }}" class="login_button facebook">
            <i class="fab fa-facebook icon"></i>
            <span class="title">Sign up with Facebook</span>
        </a>
        <p class="keep_me">
            <i class="far fa-check-square icon"></i>
            <span class="title">Keep me up to date on class events and new releases.</span>
        </p>
        <a href="{{ url('/register') }}" class="login_button submit">Create account</a>
        <p class="already">Already have an account? <span class="step_toggle to_signin">Sign In</span>.</p>
        <p class="policy">By signing up or creating an account, you agree to our <a href="#doc">Polityka
                przetwarzania danych osobowych</a> and <a href="#doc">Oferta publiczna</a>.</p>
    </div>
    <div class="step_block signin_block">
        <h3>Sign in</h3>
        <a href="{{ url('auth/google') }}" class="login_button google">
            <i class="fab fa-google icon"></i>
            <span class="title">Sign in with Google</span>
        </a>
        <a href="{{ url('auth/facebook') }}" class="login_button facebook">
            <i class="fab fa-facebook icon"></i>
            <span class="title">Sign in with Facebook</span>
        </a>
        <p class="already">Need an account? <span class="step_toggle to_signup">Sign Up</span>.</p>
        <p class="policy">By signing up or creating an account, you agree to our <a href="#doc">Polityka
                przetwarzania danych osobowych</a> and <a href="#doc">Oferta publiczna</a>.</p>
    </div>
</div>
