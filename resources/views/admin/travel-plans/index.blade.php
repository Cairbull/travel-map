@extends('layouts.admin')

@section('title', 'Travel Plans')

@section('header')
    <h1>Travel Plans</h1>
@endsection

@section('content')

<div class="admin-page">

    <div class="admin-page-header">

        <div>
            <h2>Путешествия</h2>

            <p>
                Управление прошлыми и будущими путешествиями
            </p>
        </div>

        <a
            href="{{ route('admin.travel-plans.create') }}"
            class="admin-button"
        >
            + Добавить путешествие
        </a>

    </div>


    <div class="admin-table">

        @forelse($plans as $plan)

            <div class="admin-table-row">

                <div class="plan-title">

                    @if($plan->flag)
                        <span class="plan-flag">
                            {{ $plan->flag }}
                        </span>
                    @endif

                    <div>
                        <strong>
                            {{ $plan->title }}
                        </strong>

                        <small>
                            {{ $plan->country }}
                            @if($plan->city)
                                · {{ $plan->city }}
                            @endif
                        </small>
                    </div>

                </div>


                <div class="plan-dates">

                    @if($plan->start_date)
                        {{ $plan->start_date->format('d.m.Y') }}
                    @endif

                    @if($plan->end_date)
                        —
                        {{ $plan->end_date->format('d.m.Y') }}
                    @endif

                </div>


                <div>

                    <span class="plan-status {{ $plan->status }}">
                        {{ $plan->status }}
                    </span>

                </div>


                <div class="plan-actions">

                    <a
                        href="{{ route(
                            'admin.travel-plans.edit',
                            $plan
                        ) }}"
                    >
                        Edit
                    </a>

                    <form
                        method="POST"
                        action="{{ route(
                            'admin.travel-plans.destroy',
                            $plan
                        ) }}"
                    >

                        @csrf
                        @method('DELETE')

                        <button
                            onclick="return confirm(
                                'Удалить путешествие?'
                            )"
                        >
                            Delete
                        </button>

                    </form>

                </div>

            </div>

        @empty

            <div class="admin-empty">
                Путешествий пока нет.
            </div>

        @endforelse

    </div>

</div>

@endsection