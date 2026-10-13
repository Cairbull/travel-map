@extends('layouts.admin')

@section('content')

<div class="container">

    <h1 class="mb-4">
        Редактировать путешествие
    </h1>

    <form
        method="POST"
        action="{{ route(
            'admin.travel-plans.update',
            $travelPlan
        ) }}"
    >

        @method('PUT')

        @include('admin.travel-plans._form')

        <button class="btn btn-primary">
            Сохранить
        </button>

        <a
            href="{{ route('admin.travel-plans.index') }}"
            class="btn btn-secondary"
        >
            Отмена
        </a>

    </form>

</div>

@endsection