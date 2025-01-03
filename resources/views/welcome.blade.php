<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>IPersonal - API</title>
    <link rel="icon" type="image/ico" href="https://ipersonal.onrender.com/icons/favicon.ico" />
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

    <!-- Styles -->
    <style>
        * {
            padding: 0;
            margin: 0;
            font-family: Roboto, sans-serif;
        }

        main {
            height: 100vh;
            width: 100%;
            background-color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            color: #0f0a38;
            gap: 10px;
        }
        .logo {
            height: 50px;
        }
        hr {
            border: 1px dashed #ececec;
            width: 500px;
        }
    </style>
</head>

<body class="font-sans">
    <main>
        <h1>API</h1>
        <hr />
        <div>
            <img
                class="logo"
                src="{{ asset('img/logo.png') }}"
                alt="{{config('app.name')}}" />
        </div>
    </main>
</body>

</html>
