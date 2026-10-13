<script setup lang="ts">
import "@/assets/calendar.css";

import { ref, computed, onMounted } from 'vue'

const journeys = ref([])
const loading = ref(true)
const error = ref(null)

const filter = ref('all')

const filteredJourneys = computed(() => {
    if (filter.value === 'all') {
        return journeys.value
    }

    return journeys.value.filter(
        journey => journey.status === filter.value
    )
})

async function loadJourneys() {
    try {
        loading.value = true

        const response = await fetch('/api/journeys')

        if (!response.ok) {
            throw new Error('Не удалось загрузить путешествия')
        }

        journeys.value = await response.json()
    } catch (err) {
        error.value = err.message
    } finally {
        loading.value = false
    }
}

onMounted(loadJourneys)
</script>

<template>
    <div class="travel-journal">

        <!-- Header -->

        <header class="journal-header">

            <div>
                <span class="eyebrow">
                    Календарь путешествий
                </span>

                <h1>2026</h1>
            </div>

            <div class="filters">

                <button
                    :class="{ active: filter === 'all' }"
                    @click="filter = 'all'"
                >
                    Все
                </button>

                <button
                    :class="{ active: filter === 'past' }"
                    @click="filter = 'past'"
                >
                    Прошлые
                </button>

                <button
                    :class="{ active: filter === 'planned' }"
                    @click="filter = 'planned'"
                >
                    Запланированные
                </button>

            </div>

        </header>


        <!-- Loading -->

        <div
            v-if="loading"
            class="journal-state"
        >
            Загружаем путешествия...
        </div>


        <!-- Error -->

        <div
            v-else-if="error"
            class="journal-state error"
        >
            {{ error }}
        </div>


        <!-- Timeline -->

        <main
            v-else
            class="timeline"
        >

            <article
                v-for="journey in filteredJourneys"
                :key="journey.slug"
                class="journey"
            >

                <!-- Timeline -->

                <div class="timeline-marker">

                    <div class="timeline-dot"></div>

                    <div class="timeline-line"></div>

                </div>


                <!-- Month -->

                <div class="journey-month">
                    {{ journey.year }}
                </div>


                <!-- Content -->

                <RouterLink
    :to="`/journeys/${journey.slug}`"
    class="journey-card"
>
    <div class="journey-card-content">

        <div class="journey-number">
            01
        </div>

        <div class="journey-info">

            <div class="journey-top">

                <div class="journey-country">

                    <img
                        v-if="journey.flag_country"
                        :src="journey.flag_country"
                        :alt="journey.country"
                        class="country-flag"
                    >

                    <h2>
                        {{ journey.country }}
                    </h2>

                </div>

                <span class="journey-year">
                    {{ journey.year }}
                </span>

            </div>


            <div class="journey-bottom">

                <div class="journey-stats">
                    <span>
                        {{ journey.stories_count }}
                        stories
                    </span>
                </div>

            </div>

        </div>

    </div>


    <div
        v-if="journey.preview_image_journey"
        class="journey-image"
    >
        <img
            :src="journey.preview_image_journey"
            :alt="journey.country"
        >

        <div class="image-overlay"></div>

        <span class="image-label">
            Посмотреть путешествие
        </span>
    </div>

</RouterLink>

            </article>


            <!-- Empty -->

            <div
                v-if="filteredJourneys.length === 0"
                class="journal-state"
            >
                Путешествий пока нет.
            </div>

        </main>

    </div>
</template>