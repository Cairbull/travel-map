<script setup lang="ts">
import { ref, onMounted } from "vue";
import TravelMap from "./TravelMap.vue";

const statistics = ref({
  countries: 0,
  cities: 0,
  locations: 0,
  years: 0,
});

const imageRegex = /"image_intro":"([^"#]+)(?=#)/;

const journeys = ref([]);
const trips = ref([]);
const loading = ref(false);

const fetchQuery = async (nameQuery, urlQuery) => {
  loading.value = true;

  try {
    const response = await fetch(urlQuery);

    if (!response.ok) {
      throw new Error("Failed to load journeys");
    }

    nameQuery.value = await response.json();

    /*if (urlQuery === "/api/trips") {
      const result = await response.json();
      nameQuery.value = result.data;
      const results = nameQuery.value;

      results.forEach((itemResult) => {
        let oldPath = itemResult.image;
        let foundImage = oldPath.match(imageRegex);
        let newPath = foundImage[1].replace(/\\\//g, "/");
        itemResult.image = "https://maxwrites.ru/" + newPath;
      });
    }*/
  } catch (error) {
    console.error(error);
  } finally {
    loading.value = false;
  }
};

const fetchTrips = async () => {
  loading.value = true;

  try {
    const response = await fetch("/api/trips");
    const result = await response.json();
     trips.value = result.data;
    const results = trips.value;

    if (!response.ok) {
      throw new Error("Failed to load trips");
    }

    results.forEach((itemResult) => {
      const oldPath = itemResult.image;
      const foundImage = oldPath.match(imageRegex);
      const newPath = foundImage[1].replace(/\\\//g, '/');
      itemResult.image = "https://maxwrites.ru/"+newPath;
    });
  } catch (error) {
    console.error(error);
  } finally {
    loading.value = false;
  }
};

onMounted(() => {
  fetchQuery(statistics, "/api/statistics");
  fetchQuery(journeys, "/api/journeys");
  //fetchQuery(trips, "/api/trips");
  fetchTrips();
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

            <!-- <div class="hero-actions">
              <button><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
  <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325"/>
</svg></button>
            </div> -->
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

              <!-- <button class="refresh-button"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-repeat" viewBox="0 0 16 16">
  <path d="M11.534 7h3.932a.25.25 0 0 1 .192.41l-1.966 2.36a.25.25 0 0 1-.384 0l-1.966-2.36a.25.25 0 0 1 .192-.41m-11 2h3.932a.25.25 0 0 0 .192-.41L2.692 6.23a.25.25 0 0 0-.384 0L.342 8.59A.25.25 0 0 0 .534 9"/>
  <path fill-rule="evenodd" d="M8 3c-1.552 0-2.94.707-3.857 1.818a.5.5 0 1 1-.771-.636A6.002 6.002 0 0 1 13.917 7H12.9A5 5 0 0 0 8 3M3.1 9a5.002 5.002 0 0 0 8.757 2.182.5.5 0 1 1 .771.636A6.002 6.002 0 0 1 2.083 9z"/>
</svg></button> -->
            </div>

            <div class="overview-list">
              <div class="overview-item">
                <span class="overview-icon"
                  ><svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="16"
                    height="16"
                    fill="currentColor"
                    class="bi bi-flag"
                    viewBox="0 0 16 16"
                  >
                    <path
                      d="M14.778.085A.5.5 0 0 1 15 .5V8a.5.5 0 0 1-.314.464L14.5 8l.186.464-.003.001-.006.003-.023.009a12 12 0 0 1-.397.15c-.264.095-.631.223-1.047.35-.816.252-1.879.523-2.71.523-.847 0-1.548-.28-2.158-.525l-.028-.01C7.68 8.71 7.14 8.5 6.5 8.5c-.7 0-1.638.23-2.437.477A20 20 0 0 0 3 9.342V15.5a.5.5 0 0 1-1 0V.5a.5.5 0 0 1 1 0v.282c.226-.079.496-.17.79-.26C4.606.272 5.67 0 6.5 0c.84 0 1.524.277 2.121.519l.043.018C9.286.788 9.828 1 10.5 1c.7 0 1.638-.23 2.437-.477a20 20 0 0 0 1.349-.476l.019-.007.004-.002h.001M14 1.221c-.22.078-.48.167-.766.255-.81.252-1.872.523-2.734.523-.886 0-1.592-.286-2.203-.534l-.008-.003C7.662 1.21 7.139 1 6.5 1c-.669 0-1.606.229-2.415.478A21 21 0 0 0 3 1.845v6.433c.22-.078.48-.167.766-.255C4.576 7.77 5.638 7.5 6.5 7.5c.847 0 1.548.28 2.158.525l.028.01C9.32 8.29 9.86 8.5 10.5 8.5c.668 0 1.606-.229 2.415-.478A21 21 0 0 0 14 7.655V1.222z"
                    /></svg
                ></span>

                <div>
                  <strong> Страны </strong>

                  <small> посещенные </small>
                </div>

                <b> {{ statistics.countries }} </b>
              </div>

              <div class="overview-item">
                <span class="overview-icon"
                  ><svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="16"
                    height="16"
                    fill="currentColor"
                    class="bi bi-building"
                    viewBox="0 0 16 16"
                  >
                    <path
                      d="M4 2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zM4 5.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zM7.5 5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zm2.5.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zM4.5 8a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zm2.5.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5z"
                    />
                    <path
                      d="M2 1a1 1 0 0 1 1-1h10a1 1 0 0 1 1 1v14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1zm11 0H3v14h3v-2.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 .5.5V15h3z"
                    /></svg
                ></span>

                <div>
                  <strong>Города </strong>

                  <small>посещенные</small>
                </div>

                <b> {{ statistics.cities }} </b>
              </div>

              <div class="overview-item">
                <span class="overview-icon"
                  ><svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="16"
                    height="16"
                    fill="currentColor"
                    class="bi bi-clock"
                    viewBox="0 0 16 16"
                  >
                    <path
                      d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71z"
                    />
                    <path
                      d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0"
                    /></svg
                ></span>

                <div>
                  <strong>Количество дней </strong>

                  <small> проведенных в путешествии </small>
                </div>

                <b> {{ statistics.locations }} </b>
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

        <article class="stat-card stat-card--dark">
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

        <article class="stat-card stat-card--dark">
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

        <article class="stat-card stat-card--dark">
          <span class="eyebrow">Общее время</span>

          <strong class="stat-value"> {{ statistics.locations }} </strong>
          <strong class="stat-days">дней</strong>

          <span class="stat-description"> проведенное в путешествии </span>

          <div class="circle-progress">
            <span></span>
          </div>
        </article>
      </section>

      <!-- Мои поездки -->
      <section class="journeys-section">
        <div class="section-header">
          <div>
            <span class="eyebrow"> Журнал поездок </span>

            <h2>Мои поездки</h2>
          </div>

          <div class="section-controls">
            <button class="tab">Планируемые</button>

            <button class="tab active">Завершенные</button>
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
              <!-- <RouterLink
                to="`/journeys/${journey.slug}`"
                class="button"
                active-class="button active"
            >
          Перейти
        </RouterLink> -->
              <!-- <div class="journeys-meta">
                <span>{{ journey.stories_count }} истории</span>
                <span>{{ journey.year }}</span>
              </div> -->
            </div>
          </RouterLink>
        </div>
      </section>

      <!-- Мои путешествия -->

      <section class="trips-section">
        <div class="section-header">
          <div>
            <span class="eyebrow"> Бортовой журнал </span>

            <h2>Истории из путешествий</h2>
          </div>
        </div>

        <div class="trips-grid">
          <RouterLink
            v-for="trip in trips"
            :key="trip.id"
            :to="`https://maxwrites.ru/index.php/istorii/${trip.alias}`"
            class="trips-card"
          >
            <div class="trips-image">
              <img :src="trip.image" :alt="trip.title" />

              <span> {{ trip.year }} </span>
            </div>

            <div class="trips-content">
              <h3>{{ trip.title }}</h3>
              <!-- <RouterLink
                to="`https://maxwrites.ru/index.php/istorii/${trip.alias}`"
                class="button"
                active-class="button active"
            >
          Перейти
        </RouterLink> -->
              <!-- <div class="trips-meta">
                <span>{{ journey.stories_count }} истории</span>
                <span>{{ journey.year }}</span>
              </div> -->
            </div>
          </RouterLink>
        </div>
      </section>

      <!-- Карта -->
      <section class="map-section">
        <div class="section-header">
          <div>
            <span class="eyebrow"> Карта </span>

            <h2>Карта путешествий</h2>
          </div>

          <button class="map-button">
            Открыть карту &nbsp;&nbsp;&nbsp;<svg
              xmlns="http://www.w3.org/2000/svg"
              width="16"
              height="16"
              fill="currentColor"
              class="bi bi-arrows-fullscreen"
              viewBox="0 0 16 16"
            >
              <path
                fill-rule="evenodd"
                d="M5.828 10.172a.5.5 0 0 0-.707 0l-4.096 4.096V11.5a.5.5 0 0 0-1 0v3.975a.5.5 0 0 0 .5.5H4.5a.5.5 0 0 0 0-1H1.732l4.096-4.096a.5.5 0 0 0 0-.707m4.344 0a.5.5 0 0 1 .707 0l4.096 4.096V11.5a.5.5 0 1 1 1 0v3.975a.5.5 0 0 1-.5.5H11.5a.5.5 0 0 1 0-1h2.768l-4.096-4.096a.5.5 0 0 1 0-.707m0-4.344a.5.5 0 0 0 .707 0l4.096-4.096V4.5a.5.5 0 1 0 1 0V.525a.5.5 0 0 0-.5-.5H11.5a.5.5 0 0 0 0 1h2.768l-4.096 4.096a.5.5 0 0 0 0 .707m-4.344 0a.5.5 0 0 1-.707 0L1.025 1.732V4.5a.5.5 0 0 1-1 0V.525a.5.5 0 0 1 .5-.5H4.5a.5.5 0 0 1 0 1H1.732l4.096 4.096a.5.5 0 0 1 0 .707"
              ></path>
            </svg>
          </button>
        </div>

        <div class="map-wrapper">
          <TravelMap />
        </div>
      </section>
    </main>
  </div>
</template>
