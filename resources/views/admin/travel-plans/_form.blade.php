@csrf

<div class="form-section">

    <div class="form-section-title">
        Основная информация
    </div>

    <div class="form-grid">

        <div class="form-group full">

            <label for="title">
                Название
            </label>

            <input
                id="title"
                type="text"
                name="title"
                value="{{ old('title', $travelPlan->title ?? '') }}"
                placeholder="Например: Vietnam"
                required
            >

        </div>


        <div class="form-group">

            <label for="country">
                Страна
            </label>

            <input
                id="country"
                type="text"
                name="country"
                value="{{ old('country', $travelPlan->country ?? '') }}"
                placeholder="Vietnam"
            >

        </div>


        <div class="form-group">

            <label for="city">
                Основной город
            </label>

            <input
                id="city"
                type="text"
                name="city"
                value="{{ old('city', $travelPlan->city ?? '') }}"
                placeholder="Da Nang"
            >

        </div>


        <div class="form-group">

            <label for="flag">
                Флаг
            </label>

            <input
                id="flag"
                type="text"
                name="flag"
                value="{{ old('flag', $travelPlan->flag ?? '') }}"
                placeholder="🇻🇳"
            >

        </div>

    </div>

</div>


<div class="form-section">

    <div class="form-section-title">
        Даты путешествия
    </div>

    <div class="form-grid">

        <div class="form-group">

            <label for="start_date">
                Дата начала
            </label>

            <input
                id="start_date"
                type="date"
                name="start_date"
                value="{{ old(
                    'start_date',
                    isset($travelPlan->start_date)
                        ? $travelPlan->start_date->format('Y-m-d')
                        : ''
                ) }}"
            >

        </div>


        <div class="form-group">

            <label for="end_date">
                Дата окончания
            </label>

            <input
                id="end_date"
                type="date"
                name="end_date"
                value="{{ old(
                    'end_date',
                    isset($travelPlan->end_date)
                        ? $travelPlan->end_date->format('Y-m-d')
                        : ''
                ) }}"
            >

        </div>

    </div>

</div>


<div class="form-section">

    <div class="form-section-title">
        Статус
    </div>

    <div class="form-group">

        <label for="status">
            Статус путешествия
        </label>

        <select
            id="status"
            name="status"
        >

            <option
                value="planned"
                @selected(
                    old(
                        'status',
                        $travelPlan->status ?? 'planned'
                    ) === 'planned'
                )
            >
                Planned
            </option>

            <option
                value="current"
                @selected(
                    old(
                        'status',
                        $travelPlan->status ?? ''
                    ) === 'current'
                )
            >
                Current
            </option>

            <option
                value="completed"
                @selected(
                    old(
                        'status',
                        $travelPlan->status ?? ''
                    ) === 'completed'
                )
            >
                Completed
            </option>

        </select>

    </div>

</div>


<div class="form-section">

    <div class="form-section-title">
        Описание
    </div>

    <div class="form-group">

        <textarea
            name="description"
            rows="6"
            placeholder="Краткое описание путешествия..."
        >{{ old(
            'description',
            $travelPlan->description ?? ''
        ) }}</textarea>

    </div>

</div>


<div class="form-section">

    <div class="form-section-title">
        Медиа и ссылка
    </div>

    <div class="form-grid">

        <div class="form-group">

            <label for="cover_image">
                Обложка
            </label>

            <input
                id="cover_image"
                type="text"
                name="cover_image"
                value="{{ old(
                    'cover_image',
                    $travelPlan->cover_image ?? ''
                ) }}"
                placeholder="/images/journey/vietnam.jpg"
            >

        </div>


        <div class="form-group">

            <label for="link_page">
                Ссылка
            </label>

            <input
                id="link_page"
                type="text"
                name="link_page"
                value="{{ old(
                    'link_page',
                    $travelPlan->link_page ?? ''
                ) }}"
                placeholder="/journeys/vietnam"
            >

        </div>

    </div>

</div>