<script setup lang="ts">
import { ref, onMounted } from 'vue'
import TravelMap from './TravelMap.vue'

const statistics = ref({
    countries: 0,
    cities: 0,
    locations: 0,
    years: 0,
});

const journeys = ref([]);

const loading = ref(false);

const fetchStatistics = async () => {
    loading.value = true

    try {
        const response = await fetch('/api/statistics')
        
        if (!response.ok) {
            throw new Error('Failed to load statistics')
        }

        statistics.value = await response.json()
    } catch (error) {
        console.error(error)
    } finally {
        loading.value = false
    }
}

const fetchJourneys = async () => {
    loading.value = true

    try {
        const response = await fetch('/api/journeys');
        const result = await response.json();
        
        if (!response.ok) {
            throw new Error('Failed to load journeys')
        }

        journeys.value = result;
    } catch (error) {
        console.error(error)
    } finally {
        loading.value = false
    }
}

onMounted(() => {
    fetchStatistics()
    fetchJourneys()
})
</script>

<template>
    <div id="dashboard-app" class="dashboard">

        <!-- HEADER -->
        <header class="header">

            <div class="logo">
                <div class="logo-mark">
                    M
                </div>

                <span>Макс пишет</span>
            </div>

            <nav class="navigation">

                <a href="#" class="navigation__item active">
                    <span>▣</span>
                    My Trips
                </a>

                <a href="#" class="navigation__item">
                    <span>▦</span>
                    Timeline
                </a>

                <a href="#" class="navigation__item">
                    <span>◎</span>
                    Atlas
                </a>

                <a href="#" class="navigation__item">
                    <span>◉</span>
                    Journey
                </a>

            </nav>

            <div class="header-actions">

                <button class="header-button">
                    ☾
                </button>

                <button class="header-button">
                    ♧
                </button>

                <div class="profile">
                    <div class="profile-avatar">
                        M
                    </div>

                    <span>Max</span>

                    <span class="profile-arrow">
                        ⌄
                    </span>
                </div>

            </div>

        </header>


        <!-- CONTENT -->
        <main class="content">


            <!-- TOP SECTION -->
            <section class="top-section">

                <!-- HERO -->
                <article class="hero-card">

                    <img
                        class="hero-image"
                        src="https://images.unsplash.com/photo-1528127269322-539801943592?auto=format&fit=crop&w=1800&q=85"
                        alt="Latest trip"
                    >

                    <div class="hero-overlay"></div>

                    <div class="hero-top">

                        <span class="hero-badge">
                            Текущее
                        </span>

                        <div class="hero-actions">

                            <button>
                                ✎
                            </button>

                            <button>
                                □
                            </button>

                            <button>
                                ▣
                            </button>

                            <button>
                                ♡
                            </button>

                        </div>

                    </div>


                    <div class="hero-title">
                        Вьетнам 2026
                    </div>


                    <div class="hero-info">

                        <div class="hero-info__item">

                            <span class="hero-info__label">
                                Страна
                            </span>

                            <strong>
                                🇻🇳 Вьетнам
                            </strong>

                            <small>
                                Южная Азия
                            </small>

                        </div>


                        <div class="hero-divider"></div>


                        <div class="hero-info__item">

                            <span class="hero-info__label">
                                Локации
                            </span>

                            <strong>
                                8
                            </strong>

                            <small>
                                направлений
                            </small>

                        </div>


                        <div class="hero-divider"></div>


                        <div class="hero-info__item">

                            <span class="hero-info__label">
                                ГОД
                            </span>

                            <strong>
                                2026
                            </strong>

                            <small>
                                последнее путешествие
                            </small>

                        </div>

                    </div>

                </article>


                <!-- RIGHT COLUMN -->
                <aside class="side-column">


                    <!-- TRAVEL OVERVIEW -->
                    <article class="side-card">

                        <div class="side-card__header">

                            <div>
                                <span class="eyebrow">
                                    Статистика
                                </span>

                                <h2>
                                    Путешествия
                                </h2>
                            </div>

                            <button class="refresh-button">
                                ↻
                            </button>

                        </div>


                        <div class="overview-list">

                            <div class="overview-item">

                                <span class="overview-icon">
                                    ◉
                                </span>

                                <div>
                                    <strong>
                                        Страны
                                    </strong>

                                    <small>
                                        посещенные
                                    </small>
                                </div>

                                <b>
                                    {{statistics.countries}}
                                </b>

                            </div>


                            <div class="overview-item">

                                <span class="overview-icon">
                                    ◇
                                </span>

                                <div>
                                    <strong>
                                        Локации
                                    </strong>

                                    <small>
                                        на карте
                                    </small>
                                </div>

                                <b>
                                  {{statistics.locations}}
                                </b>

                            </div>


                            <div class="overview-item">

                                <span class="overview-icon">
                                    ◷
                                </span>

                                <div>
                                    <strong>
                                        Years
                                    </strong>

                                    <small>
                                        travelling
                                    </small>
                                </div>

                                <b>
                                    {{statistics.years}}
                                </b>

                            </div>

                        </div>

                    </article>


                    <!-- SYSTEM STATUS -->
                    <article class="side-card system-card">

                        <div class="side-card__header">

                            <div>
                                <span class="eyebrow">
                                    Система
                                </span>

                                <h2>
                                    Status
                                </h2>
                            </div>

                            <span class="online">
                                <i></i>
                                В сети
                            </span>

                        </div>


                        <div class="system-row">

                            <span>
                                Joomla Sync
                            </span>

                            <strong>
                                Синхронизирован
                            </strong>

                        </div>


                        <div class="system-row">

                            <span>
                                Redis
                            </span>

                            <strong>
                                Обновлен
                            </strong>

                        </div>


                        <div class="system-row">

                            <span>
                                Last sync
                            </span>

                            <strong>
                                4 минуты назад
                            </strong>

                        </div>

                    </article>

                </aside>

            </section>


            <!-- Статистика -->
            <section class="statistics">


                <article class="stat-card stat-card--dark">

                    <span class="eyebrow">
                        Список · посещенных стран
                    </span>

                    <div class="stat-main">
                        <strong>
                          {{statistics.countries}}
                        </strong>

                        <span>
                            из 195
                        </span>
                    </div>

                    <div class="flags">
                        <article v-for="journey in journeys" :key="journey.group_stories">
                        <div class="journeys-country">
                            <img class="icon_flag"
                                :src="journey.flag_country"
                        :alt="journey.country"
                            >
                            </div>
                        </article>
                    </div>

                </article>


                <article class="stat-card">

                    <span class="eyebrow">
                        Общее число путешествий
                    </span>

                    <strong class="stat-value">
                        27
                    </strong>

                    <span class="stat-description">
                        записанных путешествий
                    </span>

                    <div class="mini-chart">
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>

                </article>


                <article class="stat-card">

                    <span class="eyebrow">
                        Локации
                    </span>

                    <strong class="stat-value">
                     {{statistics.locations}}
                    </strong>

                    <span class="stat-description">
                        посещенных мест
                    </span>

                    <div class="mini-chart mini-chart--second">
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>

                </article>


                <article class="stat-card">

                    <span class="eyebrow">
                        Время в путешествии
                    </span>

                    <strong class="stat-value">
                        {{statistics.years}}
                    </strong>

                    <span class="stat-description">
                        годы путешествий
                    </span>

                    <div class="circle-progress">
                        <span></span>
                    </div>

                </article>

            </section>


            <!-- Путешествия -->
            <section class="trips-section">

                <div class="section-header">

                    <div>
                        <span class="eyebrow">
                            Журнал путешествий
                        </span>

                        <h2>
                            Мои путешествия
                        </h2>
                    </div>


                    <div class="section-controls">

                        <button class="tab">
                            Планируемые
                        </button>

                        <button class="tab">
                            В архиве
                        </button>

                        <button class="tab active">
                            Завершенные
                        </button>

                        <button class="view-button">
                            ☷
                        </button>

                    </div>

                </div>


                <div class="journeys-grid">
                    <article v-for="journey in journeys" :key="journey.group_stories" class="trip-card">

                        <div class="journeys-image">

                            <img
                                :src="journey.preview_image_journey"
                        :alt="journey.group_stories"
                            >

                            <span>
                                {{journey.year}}
                            </span>

                        </div>

                        <div class="journeys-content">

                            <div class="journeys-country">
                            <img class="icon_flag"
                                :src="journey.flag_country"
                        :alt="journey.country"
                            > {{journey.country}}
                            </div>

                            <h3>
                                {{journey.group_stories}}
                            </h3>

                            <div class="journeys-meta">
                                <span>{{ journey.stories_count}} истории</span>
                                <span>{{journey.year}}</span>
                            </div>

                        </div>

                    </article>

                </div>

            </section>


            <!-- MAP -->
            <section class="map-section">

                <div class="section-header">

                    <div>
                        <span class="eyebrow">
                            Карта
                        </span>

                        <h2>
                            Карта путешествий
                        </h2>
                    </div>

                    <button class="map-button">
                        Открыть карту ↗
                    </button>

                </div>


                <div class="map-wrapper">

                    <TravelMap />

                </div>

            </section>


        </main>

    </div>
</template>
