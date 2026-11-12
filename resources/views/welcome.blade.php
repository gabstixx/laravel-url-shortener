
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shortly - URL Shortener</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            margin: 0;
            background: #f3f4f6;
            color: #111827;
            font-family: Arial, sans-serif;
        }

        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 18px 8%;
            background: white;
            box-shadow: 0 1px 4px #00000015;
        }

        nav h1 {
            font-size: 24px;
            font-weight: bold;
        }

        nav a {
            margin-left: 18px;
            color: #4b5563;
            text-decoration: none;
        }

        main {
            max-width: 650px;
            margin: 70px auto;
            padding: 0 20px;
        }

        .intro {
            text-align: center;
            margin-bottom: 30px;
        }

        .intro h2 {
            font-size: 32px;
            font-weight: bold;
            margin-bottom: 12px;
        }

        .intro p {
            color: #6b7280;
        }

        .form-card {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 3px 12px #00000010;
        }

        .form-group {
            margin-bottom: 22px;
        }

        label {
            display: block;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .optional {
            color: #9ca3af;
            font-weight: normal;
        }

        input {
            width: 100%;
            box-sizing: border-box;
            padding: 13px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 15px;
        }

        .error {
            color: #dc2626;
            font-size: 13px;
            margin-top: 6px;
        }

        .submit-btn {
            display: block;
            width: 100%;
            padding: 14px;
            background-color: #2563eb;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
        }

        .submit-btn:hover {
            background-color: #1d4ed8;
        }

        .result {
            margin-top: 28px;
            padding: 20px;
            background: #f0fdf4;
            border: 1px solid #bbf7d0;
            border-radius: 8px;
        }

        .result h3 {
            color: #166534;
            margin-bottom: 12px;
            font-weight: bold;
        }

        .copy-btn {
            padding: 12px 20px;
            background: #16a34a;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
        }

        @media (max-width: 600px) {
            main {
                margin-top: 40px;
            }

            .intro h2 {
                font-size: 26px;
            }

            .form-card {
                padding: 20px;
            }
        }
    </style>
</head>

<body>

    <nav>
        <h1>Shortly</h1>

        <div>
            @auth
                <a href="{{ route('dashboard') }}">Dashboard</a>
            @else
                <a href="{{ route('login') }}">Login</a>
                <a href="{{ route('register') }}">Register</a>
            @endauth
        </div>
    </nav>

    <main>

        <div class="intro">
            <h2>Shorten Your Long URLs</h2>
            <p>Turn long links into short, shareable URLs in seconds.</p>
        </div>

        <div class="form-card">

            <form action="{{ route('short-urls.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="original_url">Enter your URL</label>

                    <input
                        type="url"
                        name="original_url"
                        id="original_url"
                        value="{{ old('original_url') }}"
                        placeholder="https://example.com/your-long-url"
                        required
                    >

                    @error('original_url')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="custom_alias">
                        Custom Alias <span class="optional">(Optional)</span>
                    </label>

                    <input
                        type="text"
                        name="custom_alias"
                        id="custom_alias"
                        value="{{ old('custom_alias') }}"
                        placeholder="my-link"
                    >

                    @error('custom_alias')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="expires_at">
                        Expiration Date <span class="optional">(Optional)</span>
                    </label>

                    <input
                        type="datetime-local"
                        name="expires_at"
                        id="expires_at"
                        value="{{ old('expires_at') }}"
                    >

                    @error('expires_at')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="submit-btn">
                    Shorten URL
                </button>

            </form>

            @if (session('shortUrl'))
                <div class="result">
                    <h3>Your shortened URL is ready!</h3>

                    <div>
                        <input
                            type="text"
                            id="shortUrl"
                            value="{{ session('shortUrl') }}"
                            readonly
                        >

                        <button
                            type="button"
                            class="copy-btn"
                            id="copyButton"
                            onclick="copyShortUrl()"
                        >
                            Copy
                        </button>
                    </div>
                </div>
            @endif

        </div>
    </main>

    <script>
        function copyShortUrl() {
            const input = document.getElementById('shortUrl');
            const copyButton = document.getElementById('copyButton');

            navigator.clipboard.writeText(input.value)
                .then(() => {
                    copyButton.textContent = 'Copied!';

                    setTimeout(() => {
                        copyButton.textContent = 'Copy';
                    }, 2000);
                })
                .catch(() => {
                    copyButton.textContent = 'Copy failed';

                    setTimeout(() => {
                        copyButton.textContent = 'Copy';
                    }, 2000);
                });
        }
    </script>

</body>
</html>
