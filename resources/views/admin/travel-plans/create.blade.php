@extends('layouts.admin')

@section('breadcrumb')

    <div class="admin-breadcrumb">

        <a href="{{ route('admin.travel-plans.index') }}">
            Travel Plans
        </a>

        <span class="admin-breadcrumb-separator">›</span>

        <span>Новое путешествие</span>

    </div>

@endsection


@section('content')

<div class="admin-page-header">

    <div>
        <h1 class="admin-page-title">
            Новое путешествие
        </h1>

        <p class="admin-page-description">
            Добавьте даты и информацию о путешествии
        </p>
    </div>

    <a
        href="{{ route('admin.travel-plans.index') }}"
        class="admin-button admin-button-secondary"
    >
        ← &nbsp; К списку
    </a>

</div>


<form
    action="{{ route('admin.travel-plans.store') }}"
    method="POST"
>

    @csrf

    <div class="admin-two-columns">

        {{-- LEFT COLUMN --}}

        <div class="admin-column">

            {{-- Основная информация --}}

            <section class="admin-card">

                <h2 class="admin-card-title">
                    <span class="admin-card-icon">▣</span>
                    Основная информация
                </h2>

                <div class="admin-form-grid">

                    <div class="admin-field admin-form-grid-full">

                        <label for="title">
                            Название
                            <span class="admin-required">*</span>
                        </label>

                        <input
                            type="text"
                            id="title"
                            name="title"
                            value="{{ old('title') }}"
                            placeholder="Например: Vietnam"
                            required
                        >

                    </div>


                    <div class="admin-field">

                        <label for="country">
                            Страна
                        </label>

                        <input
                            type="text"
                            id="country"
                            name="country"
                            value="{{ old('country') }}"
                            placeholder="Vietnam"
                        >

                    </div>


                    <div class="admin-field">

                        <label for="city">
                            Основной город
                        </label>

                        <input
                            type="text"
                            id="city"
                            name="city"
                            value="{{ old('city') }}"
                            placeholder="Da Nang"
                        >

                    </div>


                    <div class="admin-field">

                        <label for="flag">
                            Флаг
                        </label>

                        <input
                            type="text"
                            id="flag"
                            name="flag"
                            value="{{ old('flag') }}"
                            placeholder="🇻🇳"
                        >

                    </div>

                </div>

            </section>


            {{-- Даты --}}

            <section class="admin-card">

                <h2 class="admin-card-title">
                    <span class="admin-card-icon">▣</span>
                    Даты путешествия
                </h2>

                <div class="admin-form-grid">

                    <div class="admin-field">

                        <label for="start_date">
                            Дата начала
                        </label>

                        <input
                            type="date"
                            id="start_date"
                            name="start_date"
                            value="{{ old('start_date') }}"
                        >

                    </div>


                    <div class="admin-field">

                        <label for="end_date">
                            Дата окончания
                        </label>

                        <input
                            type="date"
                            id="end_date"
                            name="end_date"
                            value="{{ old('end_date') }}"
                        >

                    </div>

                </div>

            </section>


            {{-- Статус --}}

            <section class="admin-card">

                <h2 class="admin-card-title">
                    <span class="admin-card-icon">⚑</span>
                    Статус
                </h2>

                <div class="admin-field">

                    <label>
                        Статус путешествия
                    </label>

                    <div class="admin-status-options">

                        <div class="admin-status-option">

                            <input
                                type="radio"
                                id="status-planned"
                                name="status"
                                value="planned"
                                {{ old('status', 'planned') === 'planned' ? 'checked' : '' }}
                            >

                            <label for="status-planned">

                                <span class="admin-status-title">
                                    Planned
                                </span>

                                <span class="admin-status-description">
                                    Запланировано
                                </span>

                            </label>

                        </div>


                        <div class="admin-status-option">

                            <input
                                type="radio"
                                id="status-current"
                                name="status"
                                value="current"
                                {{ old('status') === 'current' ? 'checked' : '' }}
                            >

                            <label for="status-current">

                                <span class="admin-status-title">
                                    Current
                                </span>

                                <span class="admin-status-description">
                                    Сейчас в путешествии
                                </span>

                            </label>

                        </div>


                        <div class="admin-status-option">

                            <input
                                type="radio"
                                id="status-completed"
                                name="status"
                                value="completed"
                                {{ old('status') === 'completed' ? 'checked' : '' }}
                            >

                            <label for="status-completed">

                                <span class="admin-status-title">
                                    Completed
                                </span>

                                <span class="admin-status-description">
                                    Завершено
                                </span>

                            </label>

                        </div>

                    </div>

                </div>

            </section>


            <div class="admin-actions">

                <a
                    href="{{ route('admin.travel-plans.index') }}"
                    class="admin-button admin-button-secondary"
                >
                    Отмена
                </a>

                <button
                    type="submit"
                    class="admin-button admin-button-primary"
                >
                    Создать путешествие
                </button>

            </div>

        </div>


        {{-- RIGHT COLUMN --}}

        <div class="admin-column">

            {{-- Обложка --}}

            <section class="admin-card">

                <h2 class="admin-card-title">
                    <span class="admin-card-icon">▧</span>
                    Обложка
                </h2>

                <div class="admin-cover-upload">

                    <div class="admin-cover-icon">
                        ▧
                    </div>

                    <div class="admin-cover-title">
                        Выберите изображение
                    </div>

                    <div class="admin-cover-description">
                        Перетащите файл сюда или выберите вручную
                    </div>

                    <input
                        type="file"
                        name="cover_image_file"
                    >

                </div>

                <div class="admin-field admin-cover-url">

                    <label for="cover_image">
                        URL изображения
                    </label>

                    <input
                        type="text"
                        id="cover_image"
                        name="cover_image"
                        value="{{ old('cover_image') }}"
                        placeholder="https://..."
                    >

                </div>

            </section>


            {{-- Ссылки --}}

            <section class="admin-card">

                <h2 class="admin-card-title">
                    <span class="admin-card-icon">↗</span>
                    Дополнительные ссылки
                </h2>

                <div class="admin-field">

                    <label for="link_page">
                        Ссылка на страницу
                    </label>

                    <input
                        type="text"
                        id="link_page"
                        name="link_page"
                        value="{{ old('link_page') }}"
                        placeholder="Например: /journeys/vietnam"
                    >

                </div>

            </section>


            {{-- Описание --}}

            <section class="admin-card">

                <h2 class="admin-card-title">
                    <span class="admin-card-icon">▤</span>
                    Описание
                </h2>

                <div class="admin-field">

                    <label for="description">
                        Краткое описание
                    </label>

                    <textarea
                        id="description"
                        name="description"
                        placeholder="Расскажите немного о путешествии..."
                    >{{ old('description') }}</textarea>

                </div>

            </section>

        </div>

    </div>

</form>

@endsection