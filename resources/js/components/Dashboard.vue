<script setup lang="ts">
import { ref, onMounted } from "vue";
import TravelMap from "./TravelMap.vue";


const statistics = ref({
  countries: 0,
  cities: 0,
  locations: 0,
  years: 0,
});

const journeys = ref([]);
const loading = ref(false);

const fetchStatistics = async () => {
  loading.value = true;

  try {
    const response = await fetch("/api/statistics");

    if (!response.ok) {
      throw new Error("Failed to load statistics");
    }

    statistics.value = await response.json();
  } catch (error) {
    console.error(error);
  } finally {
    loading.value = false;
  }
};

const fetchJourneys = async () => {
  loading.value = true;

  try {
    const response = await fetch("/api/journeys");
    const result = await response.json();

    if (!response.ok) {
      throw new Error("Failed to load journeys");
    }

    journeys.value = result;
  } catch (error) {
    console.error(error);
  } finally {
    loading.value = false;
  }
};

onMounted(() => {
  fetchStatistics();
  fetchJourneys();
});
</script>

<template>
  <div id="dashboard-app" class="dashboard">
    <!-- Основная часть контента -->
    <main class="content">
      <!-- Верхняя секция -->
      <section class="top-section">
        <!-- Баннер -->
        <article class="hero-card">
          <img
            class="hero-image"
            src="https://images.unsplash.com/photo-1528127269322-539801943592?auto=format&fit=crop&w=1800&q=85"
            alt="Latest trip"
          />

          <div class="hero-overlay"></div>

          <div class="hero-top">
            <span class="hero-badge">Недавнее</span>

            <div class="hero-actions">
              <button><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
  <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325"/>
</svg></button>
            </div>
          </div>

          <div class="hero-title">Вьетнам 2026</div>

          <div class="hero-info">
            <div class="hero-info__item">
              <span class="hero-info__label"> Страна </span>

              <strong> 🇻🇳 Вьетнам </strong>

              <small> Южная Азия </small>
            </div>

            <div class="hero-divider"></div>

            <div class="hero-info__item">
              <span class="hero-info__label"> Локации </span>

              <strong> 8 </strong>

              <small> мест </small>
            </div>

            <div class="hero-divider"></div>

            <div class="hero-info__item">
              <span class="hero-info__label"> ГОД </span>

              <strong> 2026 </strong>

              <small> последнее путешествие </small>
            </div>
          </div>
        </article>

        <!-- Правая колонка -->
        <aside class="side-column">
          <!-- Обзор путешествий -->
          <article class="side-card">
            <div class="side-card__header">
              <div>
                <span class="eyebrow"> Статистика </span>

                <h2>Путешествия</h2>
              </div>

              <button class="refresh-button">↻</button>
            </div>

            <div class="overview-list">
              <div class="overview-item">
                <span class="overview-icon"> ◉ </span>

                <div>
                  <strong> Страны </strong>

                  <small> посещенные </small>
                </div>

                <b> {{ statistics.countries }} </b>
              </div>

              <div class="overview-item">
                <span class="overview-icon"> ◇ </span>

                <div>
                  <strong> Локации </strong>

                  <small> на карте </small>
                </div>

                <b> {{ statistics.locations }} </b>
              </div>

              <div class="overview-item">
                <span class="overview-icon"> ◷ </span>

                <div>
                  <strong> Время </strong>

                  <small> проведенное в путешествии </small>
                </div>

                <b> {{ statistics.years }} </b>
              </div>
            </div>
          </article>

          <!-- Системные данные -->
          <article class="side-card system-card">
            <div class="side-card__header">
              <div>
                <span class="eyebrow"> Система </span>

                <h2>Статус</h2>
              </div>

              <span class="online">
                <i></i>
                В сети
              </span>
            </div>

            <div class="system-row">
              <span> Синхронизация данных </span>

              <strong> Синхронизирован </strong>
            </div>

            <div class="system-row">
              <span> Redis </span>

              <strong> Обновлен </strong>
            </div>

            <div class="system-row">
              <span> Последняя синхронизация </span>

              <strong> 4 минуты назад </strong>
            </div>
          </article>
        </aside>
      </section>

      <!-- Статистика -->
      <section class="statistics">
        <article class="stat-card stat-card--dark">
          <span class="eyebrow"> Список · посещенных стран </span>

          <div class="stat-main">
            <strong> {{ statistics.countries }} </strong>

            <span> из 195 </span>
          </div>

          <div class="flags">
            <article v-for="journey in journeys" :key="journey.group_stories">
              <div class="journeys-country">
                <img
                  class="icon_flag"
                  :src="journey.flag_country"
                  :alt="journey.country"
                />
              </div>
            </article>
          </div>
        </article>

        <article class="stat-card">
          <span class="eyebrow"> Общее число путешествий </span>

          <strong class="stat-value"> {{ statistics.countries }} </strong>

          <span class="stat-description">посещенных мест </span>

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
          <span class="eyebrow"> Локации </span>

          <strong class="stat-value"> {{ statistics.locations }} </strong>

          <span class="stat-description"> посещенных мест </span>

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
          <span class="eyebrow"> Время в путешествии </span>

          <strong class="stat-value"> {{ statistics.years }} </strong>

          <span class="stat-description"> годы путешествий </span>

          <div class="circle-progress">
            <span></span>
          </div>
        </article>
      </section>

      <!-- Мои поездки -->
      <section class="trips-section">
        <div class="section-header">
          <div>
            <span class="eyebrow"> Журнал поездок </span>

            <h2>Мои поездки</h2>
          </div>

          <div class="section-controls">
<!-- <RouterLink
                to="/plansJourneys"
                class="tab"
                active-class="tab active"
            >
          Планируемые
        </RouterLink>

        <RouterLink
                to="/finishJourneys"
                class="tab"
                active-class="tab active"
            >
          Завершенные
        </RouterLink> -->

            <button class="tab">Планируемые</button>

            <button class="tab active">Завершенные</button>

            <button class="view-button"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5"/>
</svg></button>
          </div>
        </div>

        <div class="journeys-grid">
          <RouterLink
            v-for="journey in journeys"
            :key="journey.group_stories"
            :to="`/journeys/${journey.slug}`"
            class="journeys-card"
          >
            <div class="journeys-image">
              <img
                :src="journey.preview_image_journey"
                :alt="journey.group_stories"
              />

              <span> {{ journey.year }} </span>
            </div>

            <div class="journeys-content">
              <div class="journeys-country">
                <img
                  class="icon_flag"
                  :src="journey.flag_country"
                  :alt="journey.country"
                />
                {{ journey.country }}
              </div>

              <h3>{{ journey.group_stories }}</h3>

              <div class="journeys-meta">
                <span>{{ journey.stories_count }} истории</span>
                <span>{{ journey.year }}</span>
              </div>
            </div>
          </RouterLink>
        </div>
      </section>

      <!-- MAP -->
      <section class="map-section">
        <div class="section-header">
          <div>
            <span class="eyebrow"> Карта </span>

            <h2>Карта путешествий</h2>
          </div>

          <button class="map-button">Открыть карту <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-up-right" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M14 2.5a.5.5 0 0 0-.5-.5h-6a.5.5 0 0 0 0 1h4.793L2.146 13.146a.5.5 0 0 0 .708.708L13 3.707V8.5a.5.5 0 0 0 1 0z"/>
</svg></button>
        </div>

        <div class="map-wrapper">
          <TravelMap />
        </div>
      </section>
    </main>
  </div>
</template>

