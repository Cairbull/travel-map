<script setup>
import { ref, onMounted } from 'vue'
import TravelMap from './TravelMap.vue'

const statistics = ref({
    countries: 0,
    cities: 0,
    locations: 0,
    years: 0,
});

const trips = ref([]);

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

const fetchTrips = async () => {
    loading.value = true
    try {
        const response = await fetch('/api/trips');
        const result = await response.json();
        
        if (!response.ok) {
            throw new Error('Failed to load trips')
        }

        trips.value = result.data;
    } catch (error) {
        console.error(error)
    } finally {
        loading.value = false
    }
}

onMounted(() => {
    fetchStatistics()
    fetchTrips()
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

                <span>MAXWRITES</span>
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
                            RECENT
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
                        Vietnam 2026
                    </div>


                    <div class="hero-info">

                        <div class="hero-info__item">

                            <span class="hero-info__label">
                                COUNTRY
                            </span>

                            <strong>
                                🇻🇳 Vietnam
                            </strong>

                            <small>
                                Southeast Asia
                            </small>

                        </div>


                        <div class="hero-divider"></div>


                        <div class="hero-info__item">

                            <span class="hero-info__label">
                                LOCATIONS
                            </span>

                            <strong>
                                8
                            </strong>

                            <small>
                                destinations
                            </small>

                        </div>


                        <div class="hero-divider"></div>


                        <div class="hero-info__item">

                            <span class="hero-info__label">
                                YEAR
                            </span>

                            <strong>
                                2026
                            </strong>

                            <small>
                                latest trip
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
                                    TRAVEL OVERVIEW
                                </span>

                                <h2>
                                    My journey
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
                                        Countries
                                    </strong>

                                    <small>
                                        visited
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
                                        Locations
                                    </strong>

                                    <small>
                                        mapped
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
                                    SYSTEM
                                </span>

                                <h2>
                                    Status
                                </h2>
                            </div>

                            <span class="online">
                                <i></i>
                                Online
                            </span>

                        </div>


                        <div class="system-row">

                            <span>
                                Joomla Sync
                            </span>

                            <strong>
                                Connected
                            </strong>

                        </div>


                        <div class="system-row">

                            <span>
                                Redis
                            </span>

                            <strong>
                                Healthy
                            </strong>

                        </div>


                        <div class="system-row">

                            <span>
                                Last sync
                            </span>

                            <strong>
                                4 min ago
                            </strong>

                        </div>

                    </article>

                </aside>

            </section>


            <!-- STATISTICS -->
            <section class="statistics">


                <article class="stat-card stat-card--dark">

                    <span class="eyebrow">
                        ATLAS · COUNTRIES VISITED
                    </span>

                    <div class="stat-main">
                        <strong>
                          {{statistics.countries}}
                        </strong>

                        <span>
                            of 195
                        </span>
                    </div>

                    <div class="flags">
                        🇻🇳 🇳🇵 🇵🇭
                    </div>

                </article>


                <article class="stat-card">

                    <span class="eyebrow">
                        TRIPS TOTAL
                    </span>

                    <strong class="stat-value">
                        27
                    </strong>

                    <span class="stat-description">
                        recorded trips
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
                        LOCATIONS
                    </span>

                    <strong class="stat-value">
                     {{statistics.locations}}
                    </strong>

                    <span class="stat-description">
                        places mapped
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
                        YEARS TRAVELLING
                    </span>

                    <strong class="stat-value">
                        {{statistics.years}}
                    </strong>

                    <span class="stat-description">
                        years of travelling
                    </span>

                    <div class="circle-progress">
                        <span></span>
                    </div>

                </article>

            </section>


            <!-- TRIPS -->
            <section class="trips-section">

                <div class="section-header">

                    <div>
                        <span class="eyebrow">
                            JOURNAL
                        </span>

                        <h2>
                            My Trips
                        </h2>
                    </div>


                    <div class="section-controls">

                        <button class="tab">
                            Planned
                        </button>

                        <button class="tab">
                            Archived
                        </button>

                        <button class="tab active">
                            Completed
                        </button>

                        <button class="view-button">
                            ☷
                        </button>

                    </div>

                </div>


                <div class="trips-grid">

<article class="trip-card">

                        <div class="trip-image">

                            <img
                                src="https://images.unsplash.com/photo-1544735716-392fe2489ffa?auto=format&fit=crop&w=1000&q=85"
                                alt="Nepal"
                            >

                            <span>
                                2024
                            </span>

                        </div>

                        <div class="trip-content">

                            <div class="trip-country">
                                🇳🇵 Nepal
                            </div>

                            <h3>
                                Kathmandu & Himalayas
                            </h3>

                            <div class="trip-meta">
                                <span>5 locations</span>
                                <span>2024</span>
                            </div>

                        </div>

                    </article>
                    <article v-for="trip in trips" :key="trip.id" class="trip-card">

                        <div class="trip-image">

                            <img
                                :src="trip.image"
                        :alt="trip.title"
                            >

                            <span>
                                {{trip.year}}
                            </span>

                        </div>

                        <div class="trip-content">

                            <div class="trip-country">
                                {{trip.country}}
                            </div>

                            <h3>
                                {{trip.group_stories}}
                            </h3>

                            <div class="trip-meta">
                                <span>{{ trip.group_stories?.length || 0 }} историй</span>
                                <span>{{trip.year}}</span>
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
                            ATLAS
                        </span>

                        <h2>
                            Travel Map
                        </h2>
                    </div>

                    <button class="map-button">
                        Open full map ↗
                    </button>

                </div>


                <div class="map-wrapper">

                    <TravelMap />

                </div>

            </section>


        </main>

    </div>
</template>
