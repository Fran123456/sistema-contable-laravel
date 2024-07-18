<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ config('app.name') }} - Recuperación de Contraseña</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8fafc;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .card {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            padding: 20px;
            max-width: 600px;
            width: 100%;
            margin: 20px;
            text-align: center;
        }
        .header {
            background-color: #f8fafc;
            padding: 20px;
            text-align: center;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .content {
            margin: 20px;
        }
        .button-container {
            text-align: center;
            margin: 20px 0;
        }
        .button {
            background-color: #3490dc;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            border-radius: 5px;
        }
        
        .footer {
            margin: 20px;
            text-align: center;
            font-size: 12px;
            color: #888888;
            max-width: 100%;
            word-wrap: break-word;
        }
        .logo {
            width: 60px;
            height: 60px;
            margin-bottom: 0px;
        }
        h2{
            margin-top:10px;
        }
    </style>
</head>
<body>
    <div class="card">
        <div class="header">
            <img src="{{ asset(Help::getConfigByKey('general', 'logo')->value) }}" alt="logo" class="logo">
        </div>
        <div class="content">
            <h2>{{ $greeting }}</h2>
            @foreach ($introLines as $line)
                <p>{{ $line }}</p>
            @endforeach
            <div class="button-container">
                <a href="{{ $actionUrl }}" class="button">{{ $actionText }}</a>
            </div>
            @foreach ($outroLines as $line)
                <p>{{ $line }}</p>
            @endforeach
            <p>{{ $salutation }}</p>
        </div>
        <div class="footer">
            <p>Si tienes problemas para hacer clic en el botón "{{ $actionText }}", copia y pega la siguiente URL en tu navegador web: <a href="{{ $actionUrl }}">{{ $actionUrl }}</a></p>
        </div>
    </div>
</body>
</html>
