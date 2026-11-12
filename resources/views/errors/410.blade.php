<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Link Unavailable</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f4f5f7;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .container {
            background: white;
            max-width: 480px;
            width: 100%;
            padding: 45px 30px;
            border-radius: 12px;
            text-align: center;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
        }

        h1 {
            font-size: 64px;
            color: #222;
            margin-bottom: 15px;
        }

        h2 {
            font-size: 22px;
            color: #333;
            margin-bottom: 12px;
        }

        p {
            color: #777;
            line-height: 1.6;
            font-size: 15px;
        }

        a {
            display: inline-block;
            margin-top: 25px;
            padding: 12px 22px;
            background: #2563eb;
            color: white;
            text-decoration: none;
            border-radius: 6px;
        }

        a:hover {
            background: #1d4ed8;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>410</h1>
        <h2>Link Unavailable</h2>

        <p>
            Sorry, this shortened link has expired or has been
            deactivated by its creator.
        </p>

        <a href="{{ url('/') }}">Go to Homepage</a>
    </div>

</body>
</html>