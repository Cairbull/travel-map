<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'MAXWRITES ADMIN' }}</title>

    @vite(['resources/css/admin.css'])
</head>

<body>

<div class="admin-layout">

    <aside class="admin-sidebar">

        <div class="admin-brand">
            <div class="admin-brand-title">MAXWRITES</div>
            <div class="admin-brand-subtitle">ADMIN</div>
        </div>

        <nav class="admin-nav">

            <a
                href="{{ route('admin.travel-plans.index') }}"
                class="admin-nav-item {{ request()->routeIs('admin.travel-plans.*') ? 'active' : '' }}"
            >
                <span class="admin-nav-icon">✈</span>
                <span>Travel Plans</span>
            </a>

        </nav>

        <div class="admin-sidebar-bottom">

    <a href="https://maxwrites.ru" target="_blank">
        ← На сайт
    </a>

    <form method="POST" action="{{ route('admin.logout') }}">
        @csrf

        <button class="sidebar-logout">
            Выйти
        </button>
    </form>

</div>

    </aside>


    <div class="admin-main">

        <header class="admin-header">
            <div>
                @yield('breadcrumb')
            </div>
        </header>

        <main class="admin-content">

            @if(session('success'))
                <div class="admin-alert admin-alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="admin-alert admin-alert-error">
                    <strong>Проверьте данные:</strong>

                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')

        </main>

    </div>

</div>

</body>
</html>