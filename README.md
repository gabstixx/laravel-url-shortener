# Laravel URL Shortener with Click Analytics

A URL shortening application built with Laravel that converts long URLs into short, shareable links and tracks visitor activity through click analytics.

## Features

- **URL Shortening:** Convert long URLs into unique six-character short links.
- **Custom Aliases:** Choose a custom alias for a shortened URL.
- **Link Expiration:** Set an optional expiration date for shortened links.
- **Click Tracking:** Record visitor IP addresses, user agents, referrers, and click timestamps.
- **User Authentication:** Register and log in to manage shortened URLs.
- **Dashboard:** View total links, total clicks, active links, and manage created URLs.
- **Link Management:** Activate, deactivate, and delete shortened URLs.
- **Analytics:** View daily click counts, top referrers, and recent click activity.
- **Rate Limiting:** Limit URL creation requests to prevent abuse.

## Technologies Used

- PHP
- Laravel
- MySQL
- Blade
- Tailwind CSS
- JavaScript
- Laravel Breeze
- PHPUnit

## Getting Started

### Prerequisites

Make sure you have the following installed:

- PHP 8.2 or later
- Composer
- Node.js and npm
- MySQL

### Installation

1. Clone the repository:

    ```bash
    git clone https://github.com/Gab-stixx/laravel-url-shortener.git
    ```

2. Navigate into the project directory:

    ```bash
    cd laravel-url-shortener
    ```

3. Install PHP dependencies:

    ```bash
    composer install
    ```

4. Create your environment file:

    ```bash
    cp .env.example .env
    ```

5. Generate the application key:

    ```bash
    php artisan key:generate
    ```

6. Create a MySQL database named `url_shortener` and configure your database credentials in the `.env` file.

7. Run database migrations:

    ```bash
    php artisan migrate
    ```

8. Install frontend dependencies and build the assets:

    ```bash
    npm install
    npm run build
    ```

9. Start the Laravel development server:

    ```bash
    php artisan serve
    ```

10. Open `http://127.0.0.1:8000` in your browser.

## Running Tests

Run the test suite with:

```bash
php artisan test
```

## Author

**Gabriel Komolafe**

GitHub: [Gab-stixx](https://github.com/Gab-stixx)
