<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>MAXWRITES ADMIN</title>

    @vite(['resources/css/auth.css'])
</head>

<body class="login-page">

<div class="login-layout">

    {{-- LEFT SIDE --}}

    <section class="login-hero">

        <div class="login-hero-overlay"></div>

        <div class="login-hero-content">

            <div class="login-brand">
                <div class="login-brand-title">
                    MAXWRITES
                </div>

                <div class="login-brand-subtitle">
                    ADMIN PANEL
                </div>
            </div>


            <div class="login-quote">

                <div class="login-quote-line"></div>

                <p>
                    Путешествия начинаются
                    с идеи, а истории —
                    с деталей.
                </p>

            </div>


            <a
                href="https://maxwrites.ru"
                target="_blank"
                class="login-site-link"
            >
                <span class="login-site-icon">◎</span>
                <span>На сайт</span>
                <span>→</span>
            </a>

        </div>

    </section>


    {{-- RIGHT SIDE --}}

    <section class="login-content">

        <div class="login-card">

            <div class="login-heading">

                <h1>
                    Вход
                </h1>

                <p>
                    Войдите в панель управления
                </p>

            </div>


            <form
                method="POST"
                action="{{ route('admin.login') }}"
                class="login-form"
            >

                @csrf


                {{-- Email --}}

                <div class="login-field">

                    <label for="email">
                        Email
                    </label>

                    <div class="login-input-wrapper">

                        <span class="login-input-icon">
                            ✉
                        </span>

                        <input
                            id="email"
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="admin@maxwrites.ru"
                            autocomplete="email"
                            required
                            autofocus
                        >

                    </div>

                </div>


                {{-- Password --}}

                <div class="login-field">

                    <label for="password">
                        Пароль
                    </label>

                    <div class="login-input-wrapper">

                        <span class="login-input-icon">
                            ♙
                        </span>

                        <input
                            id="password"
                            type="password"
                            name="password"
                            autocomplete="current-password"
                            required
                        >

                        <button
                            type="button"
                            class="login-password-toggle"
                            onclick="togglePassword()"
                            aria-label="Показать пароль"
                        >
                            ◉
                        </button>

                    </div>

                </div>


                @error('email')

                    <div class="login-error">
                        {{ $message }}
                    </div>

                @enderror


                {{-- Remember --}}

                <div class="login-options">

                    <label class="login-remember">

                        <input
                            type="checkbox"
                            name="remember"
                            value="1"
                        >

                        <span>
                            Запомнить меня
                        </span>

                    </label>

                </div>


                {{-- Submit --}}

                <button
                    type="submit"
                    class="login-submit"
                >
                    <span>Войти</span>
                    <span class="login-submit-arrow">→</span>
                </button>


                {{-- Footer --}}

                <div class="login-divider">

                    <span></span>
                    <small>ИЛИ</small>
                    <span></span>

                </div>


                <div class="login-security">

                    <span class="login-security-icon">
                        ♙
                    </span>

                    <span>
                        Доступ только для авторизованных пользователей
                    </span>

                </div>

            </form>

        </div>

    </section>

</div>


<script>

function togglePassword()
{
    const input = document.getElementById('password');

    input.type = input.type === 'password'
        ? 'text'
        : 'password';
}

</script>

</body>
</html>