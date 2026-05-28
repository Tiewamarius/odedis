@extends('layouts.myapp')
<style>
    /* =========================================================
   LOGIN BODY
========================================================= */

    .login-body {
        height: 100%;
        width: 100%;

        display: flex;
        justify-content: center;
        align-items: center;

        background: url('https://images.unsplash.com/photo-1496171367470-9ed9a91ea931?q=80&w=1600&auto=format&fit=crop') center/cover no-repeat;

        overflow: hidden;
        position: relative;
    }

    /* =========================================================
   OVERLAY
========================================================= */

    .login-body::before {
        content: '';

        position: absolute;
        inset: 0;

        background: rgba(0, 0, 0, 0.35);

        backdrop-filter: blur(2px);
    }

    /* =========================================================
   LOGIN CONTAINER
========================================================= */

    .login-container {
        position: relative;

        width: 400px;

        padding: 40px 30px;

        border-radius: 16px;

        background: rgba(255, 255, 255, 0.12);

        backdrop-filter: blur(12px);

        border: 1px solid rgba(255, 255, 255, 0.2);

        box-shadow:
            0 8px 32px rgba(0, 0, 0, 0.35),
            inset 0 1px 0 rgba(255, 255, 255, 0.2);

        animation: float 5s ease-in-out infinite;
    }

    /* FLOAT ANIMATION */
    @keyframes float {

        0% {
            transform: translateY(0px);
        }

        50% {
            transform: translateY(-10px);
        }

        100% {
            transform: translateY(0px);
        }
    }

    /* =========================================================
   TITLE
========================================================= */

    .login-container h1 {
        text-align: center;

        margin-bottom: 30px;

        color: #000;

        font-size: 42px;
        font-weight: bold;
    }

    /* =========================================================
   INPUTS
========================================================= */

    .input-group {
        margin-bottom: 18px;
    }

    .input-group input {
        width: 100%;

        padding: 15px;

        border: none;
        outline: none;

        border-radius: 6px;

        background: #fff;

        font-size: 16px;

        transition: 0.3s;
    }

    .input-group input:focus {
        transform: scale(1.02);

        box-shadow: 0 0 15px rgba(162, 12, 227, 0.7);
    }

    /* =========================================================
   BUTTON
========================================================= */

    .login-btn {
        width: 100%;

        padding: 15px;

        border: none;
        border-radius: 6px;

        background: rgba(162, 12, 227, 0.7);

        color: #fff;

        font-size: 20px;
        font-weight: bold;

        cursor: pointer;

        transition: 0.3s;
    }

    .login-btn:hover {
        background: #b139bc;

        transform: translateY(-2px);

        box-shadow: 0 8px 20px rgba(34, 12, 74, 0.45);
    }

    /* =========================================================
   LINKS
========================================================= */

    .links {
        margin-top: 22px;

        text-align: center;
    }

    .links a {
        display: block;

        color: rgba(162, 12, 227, 0.7);

        margin: 14px 0;

        font-size: 17px;

        transition: 0.3s;
    }

    .links a:hover {
        color: #ffffff;

        text-shadow: 0 0 12px rgba(162, 12, 227, 0.7);
    }

    /* =========================================================
   RESPONSIVE
========================================================= */

    @media(max-width:480px) {

        .login-container {
            width: 90%;
            padding: 30px 20px;
        }

        .login-container h1 {
            font-size: 34px;
        }
    }
</style>

<main class='login-body'>
    <div class="login-container">

        <h1>inscription</h1>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="input-group">
                <input type="text" name="username" :value="old('username')" required autofocus autocomplete="username" placeholder="Nom d'utilisateur">
            </div>
            <div class="input-group">
                <input type="email" name="email" :value="old('email')" required autofocus autocomplete="email" placeholder="Adress Email">
            </div>

            <div class="input-group">
                <input type="text" name="phone" :value="old('phone')" required autofocus autocomplete="phone" placeholder="N° Telephone">
            </div>

            <div class="input-group">
                <input type="password" name="password" required autocomplete="new-password" placeholder="creer un password">
            </div>
            <div class="input-group">
                <input type="password" name="password_confirmation" required autocomplete="new-password" placeholder="retapper password">
            </div>

            <button type="submit" class="login-btn">
                Login
            </button>

        </form>

        <div class="links">
            <a href="{{ route('password.request') }}">Forgot your password?</a>
            <a href="{{ route('login') }}">Dejà inscrit? connectez-vous</a>
        </div>

    </div>
</main>