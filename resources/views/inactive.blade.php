@extends('layouts.guest')

<!DOCTYPE html>
<html>
<head>
    <title>Account Inactive</title>
    <style>
        body {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 90vh;
            font-family: Arial, sans-serif;
        }

        h1 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        img {
            width: 200px;
            height: 200px;
            margin-bottom: 20px;
        }

        .message {
            text-align: center;
            margin-bottom: 20px;
        }

        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #008374;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <img src="{{ asset('images/not-found.png') }}" alt="Inactive User Image">
    <h1>Hello {{$userName}}</h1>
    <div class="message">
        <p>Your account is currently inactive. Please contact the administrator to activate your account.</p>
    </div>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="button">Logout</button>
    </form>
</body>
</html>
