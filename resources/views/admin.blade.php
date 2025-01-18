<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>City University Faculty Management Login</title>
    <link rel="stylesheet" href="{{ asset('assets/styles.css') }}">
</head>

<body>
    <div class="header">
        <img src="{{ asset('assets/lg-removebg-preview.png') }}" alt="University Logo" class="logo">
        <h1>City University Routine Management System</h1>
    </div>

    <div class="login-container">
        <div class="login-box">
            <img src="{{ asset('assets/lg-removebg-preview.png') }}" alt="University Logo" class="small-logo">
            <h2>Login</h2>
            <form id="loginForm" method="POST" action="{{ route('login') }}">
                @csrf
                <div class="input-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="email" placeholder="" required>
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
                <div class="input-group">
                    <label for="password">Password</label>
                    <div class="password-container">
                        <input type="password" id="password" name="password" placeholder="password" required>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        <img src="{{ asset('assets/view.png') }}" id="togglePassword" class="toggle-password"
                            alt="Show/Hide Password">
                    </div>
                </div>
                <a href="#" class="forgot-password">Forgot Password?</a>
                <button type="submit" class="login-btn">Sign In</button>
                <p class="continue-text">Or continue with</p>
                <div class="social-login">
                    <img class="google" src="{{ asset('assets/google.png') }}" alt="Social Login">
                    <img class="github" src="{{ asset('assets/github.png') }}" alt="Social Login">
                    <img class="facebook" src="{{ asset('assets/facebook.png') }}" alt="Social Login">
                </div>
                <p class="register-text">Don't Have an account yet? <a href="{{route('register')}}" class="register-link">Register
                        Now!</a></p>
            </form>
        </div>
    </div>

    <script src="{{ asset('assets/script.js') }}"></script>
</body>

</html>
