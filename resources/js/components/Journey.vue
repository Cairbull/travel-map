<script setup>
import { computed } from 'vue'

const journey = {
    group_stories: 'Непальские истории',
    slug: 'nepalskie-istorii',
    country: 'Непал',
    preview_image_journey:
        'https://maxwrites.ru/images/journey/nepal_stories/main_image_Nepal_stories.jpg',
    flag_country:
        'https://maxwrites.ru/images/journey/nepal_stories/flag_Nepal.png',
    year: 2026,
}

const stories = [
    {
        id: 1,
        number: '01',
        title: 'Первые впечатления о Непале. Знакомство с Катманду',
        city: 'Катманду',
        date: '25 мая 2026',
        alias: 'pervye-vpechatleniya-o-nepale',
        image:
            'https://maxwrites.ru/images/journey/nepal_stories/story_01.jpg',
        coordinates: [85.311068, 27.714506],
    },
    {
        id: 2,
        number: '02',
        title: 'Храм-крематорий Пашупатинатх в Катманду',
        city: 'Катманду',
        date: '27 мая 2026',
        alias: 'pashupatinath',
        image:
            'https://maxwrites.ru/images/journey/nepal_stories/story_02.jpg',
        coordinates: [85.348752, 27.710547],
    },
    {
        id: 3,
        number: '03',
        title: 'Бхактапур — город, где время остановилось',
        city: 'Бхактапур',
        date: '30 мая 2026',
        alias: 'bhaktapur',
        image:
            'https://maxwrites.ru/images/journey/nepal_stories/story_03.jpg',
        coordinates: [85.428, 27.671],
    },
    {
        id: 4,
        number: '04',
        title: 'Покхара. Горы, озеро и спокойствие',
        city: 'Покхара',
        date: '2 июня 2026',
        alias: 'pokhara',
        image:
            'https://maxwrites.ru/images/journey/nepal_stories/story_04.jpg',
        coordinates: [83.9856, 28.2096],
    },
]

const uniqueCities = computed(() => {
    return new Set(
        stories
            .map(story => story.city)
            .filter(Boolean)
    ).size
})
</script>


<template>
    <div class="journey-page">

        <!-- =========================
             BACK
        ========================== -->

        <div class="journey-topbar">

            <RouterLink
                to="/api/dashboard"
                class="back-link"
            >
                <span class="back-arrow">←</span>

                <span>
                    Все путешествия
                </span>
            </RouterLink>

        </div>


        <!-- =========================
             HERO
        ========================== -->

        <section
            class="journey-hero"
            :style="{
                backgroundImage:
                    `url(${journey.preview_image_journey})`
            }"
        >

            <div class="journey-hero-overlay"></div>

            <div class="journey-hero-content">

                <div class="journey-country">

                    <img
                        :src="journey.flag_country"
                        :alt="journey.country"
                    >

                    <span>
                        {{ journey.country }}
                    </span>

                </div>


                <h1>
                    {{ journey.group_stories }}
                </h1>


                <p class="journey-description">
                    Путешествие по Непалу в 2026 году.
                    Катманду, храмы, горы, люди и атмосфера
                    этой удивительной страны.
                </p>


                <div class="journey-hero-meta">

                    <span>
                        📅 {{ journey.year }}
                    </span>

                    <span>
                        📖 {{ stories.length }} историй
                    </span>

                    <span>
                        📍 {{ journey.country }}
                    </span>

                </div>

            </div>

        </section>


        <!-- =========================
             STATISTICS
        ========================== -->

        <section class="journey-stats">

            <div class="journey-stat">

                <div class="journey-stat-icon">
                    📖
                </div>

                <div>
                    <strong>
                        {{ stories.length }}
                    </strong>

                    <span>
                        истории
                    </span>

                    <small>
                        опубликовано
                    </small>
                </div>

            </div>


            <div class="journey-stat">

                <div class="journey-stat-icon">
                    📍
                </div>

                <div>
                    <strong>
                        {{ uniqueCities }}
                    </strong>

                    <span>
                        города
                    </span>

                    <small>
                        посещено
                    </small>
                </div>

            </div>


            <div class="journey-stat">

                <div class="journey-stat-icon">
                    🏔
                </div>

                <div>
                    <strong>
                        ~1200 км
                    </strong>

                    <span>
                        пройдено
                    </span>

                    <small>
                        маршрут
                    </small>
                </div>

            </div>


            <div class="journey-stat">

                <div class="journey-stat-icon">
                    📅
                </div>

                <div>
                    <strong>
                        май 2026
                    </strong>

                    <span>
                        период
                    </span>

                    <small>
                        путешествия
                    </small>
                </div>

            </div>

        </section>


        <!-- =========================
             MAP + ABOUT
        ========================== -->

        <section class="journey-overview">

            <!-- MAP -->

            <div class="journey-map">

                <div class="map-placeholder">

                    <span class="map-city city-pokhara">
                        Покхара
                    </span>

                    <span class="map-city city-kathmandu">
                        Катманду
                    </span>

                    <span class="map-city city-bhaktapur">
                        Бхактапур
                    </span>


                    <div class="map-route">

                        <span class="map-point point-1">
                            1
                        </span>

                        <span class="map-point point-2">
                            2
                        </span>

                        <span class="map-point point-3">
                            3
                        </span>

                    </div>


                    <div class="map-label">
                        Карта путешествия
                    </div>

                </div>

            </div>


            <!-- ABOUT -->

            <aside class="journey-about">

                <h2>
                    О путешествии
                </h2>


                <p>
                    Непал — страна невероятных контрастов.
                    Здесь древние храмы соседствуют с шумными
                    улицами Катманду, а величественные Гималаи
                    вдохновляют на каждом новом шаге.
                </p>


                <div class="journey-about-list">

                    <div class="about-item">

                        <span class="about-icon">
                            🌐
                        </span>

                        <div>
                            <small>
                                Страна
                            </small>

                            <strong>
                                {{ journey.country }}
                            </strong>
                        </div>

                    </div>


                    <div class="about-item">

                        <span class="about-icon">
                            📅
                        </span>

                        <div>
                            <small>
                                Год
                            </small>

                            <strong>
                                {{ journey.year }}
                            </strong>
                        </div>

                    </div>


                    <div class="about-item">

                        <span class="about-icon">
                            🚩
                        </span>

                        <div>
                            <small>
                                Основной маршрут
                            </small>

                            <strong>
                                Катманду, Бхактапур, Покхара
                            </strong>
                        </div>

                    </div>


                    <div class="about-item">

                        <span class="about-icon">
                            📷
                        </span>

                        <div>
                            <small>
                                Главное
                            </small>

                            <strong>
                                Храмы, горы, культура, люди
                            </strong>
                        </div>

                    </div>

                </div>

            </aside>

        </section>


        <!-- =========================
             STORIES
        ========================== -->

        <section class="journey-stories">

            <div class="stories-header">

                <div>

                    <h2>
                        Истории путешествия
                    </h2>

                    <p>
                        Все истории, связанные с этим путешествием
                    </p>

                </div>


                <div class="stories-sort">
                    Сначала новые
                    <span>⌄</span>
                </div>

            </div>


            <div class="stories-grid">

                <RouterLink
                    v-for="story in stories"
                    :key="story.id"
                    :to="`/stories/${story.alias}`"
                    class="story-card"
                >

                    <!-- IMAGE -->

                    <div class="story-image">

                        <img
                            :src="story.image"
                            :alt="story.title"
                        >

                        <span class="story-number">
                            {{ story.number }}
                        </span>

                    </div>


                    <!-- CONTENT -->

                    <div class="story-content">

                        <div class="story-city">
                            📍 {{ story.city }}
                        </div>


                        <h3>
                            {{ story.title }}
                        </h3>


                        <div class="story-footer">

                            <span>
                                📅 {{ story.date }}
                            </span>

                            <span class="story-arrow">
                                →
                            </span>

                        </div>

                    </div>

                </RouterLink>

            </div>

        </section>


        <!-- =========================
             QUOTE
        ========================== -->

        <section class="journey-quote">

            <div class="quote-icon">
                🏔
            </div>

            <div>

                <p>
                    «Непал — это не просто место на карте.»
                </p>

                <span>
                    Это состояние души, к которому хочется
                    возвращаться.
                </span>

            </div>

        </section>

    </div>
</template>


<style scoped>

.journey-page {
    max-width: 1200px;
    margin: 0 auto;

    padding: 24px 32px 60px;

    color: #171717;
}


/* =========================
   BACK
========================= */

.journey-topbar {
    margin-bottom: 20px;
}

.back-link {
    display: inline-flex;
    align-items: center;
    gap: 8px;

    color: #222;
    text-decoration: none;

    font-size: 14px;
    font-weight: 500;
}

.back-arrow {
    font-size: 20px;
}


/* =========================
   HERO
========================= */

.journey-hero {
    position: relative;

    min-height: 420px;

    border-radius: 18px;
    overflow: hidden;

    background-size: cover;
    background-position: center;
}

.journey-hero-overlay {
    position: absolute;
    inset: 0;

    background:
        linear-gradient(
            90deg,
            rgba(0, 0, 0, .78),
            rgba(0, 0, 0, .38),
            rgba(0, 0, 0, .05)
        );
}

.journey-hero-content {
    position: relative;
    z-index: 1;

    min-height: 420px;

    max-width: 650px;

    padding: 60px 48px;

    display: flex;
    flex-direction: column;
    justify-content: center;

    color: white;
}

.journey-country {
    display: flex;
    align-items: center;

    gap: 10px;

    margin-bottom: 14px;

    font-size: 18px;
}

.journey-country img {
    width: 32px;
    height: 22px;

    object-fit: cover;

    border-radius: 3px;
}

.journey-hero h1 {
    margin: 0 0 18px;

    font-size: 46px;
    line-height: 1.08;
}

.journey-description {
    max-width: 550px;

    margin: 0 0 28px;

    color: rgba(255,255,255,.9);

    font-size: 17px;
    line-height: 1.6;
}

.journey-hero-meta {
    display: flex;
    flex-wrap: wrap;

    gap: 24px;

    font-size: 15px;
}


/* =========================
   STATS
========================= */

.journey-stats {
    display: grid;

    grid-template-columns: repeat(4, 1fr);

    margin: 28px 12px 40px;

    padding: 28px;

    background: white;

    border-radius: 16px;

    box-shadow:
        0 8px 30px rgba(0,0,0,.06);
}

.journey-stat {
    display: flex;
    align-items: center;

    gap: 16px;

    padding: 0 24px;

    border-right: 1px solid #eee;
}

.journey-stat:last-child {
    border-right: none;
}

.journey-stat-icon {
    font-size: 26px;
}

.journey-stat strong {
    display: block;

    font-size: 21px;
}

.journey-stat span {
    display: block;

    font-size: 14px;
}

.journey-stat small {
    display: block;

    color: #999;

    font-size: 12px;
}


/* =========================
   OVERVIEW
========================= */

.journey-overview {
    display: grid;

    grid-template-columns: 1.6fr 1fr;

    gap: 24px;

    margin-bottom: 50px;
}


/* =========================
   MAP
========================= */

.journey-map {
    min-height: 390px;

    overflow: hidden;

    border-radius: 16px;
}

.map-placeholder {
    position: relative;

    width: 100%;
    min-height: 390px;

    overflow: hidden;

    background:
        linear-gradient(
            135deg,
            #f3f0e9,
            #e7e3da
        );
}

.map-placeholder::before {
    content: '';

    position: absolute;
    inset: 0;

    background-image:
        linear-gradient(
            25deg,
            transparent 48%,
            rgba(120,120,120,.12) 49%,
            transparent 50%
        );

    background-size: 100px 100px;

    opacity: .5;
}

.map-label {
    position: absolute;

    top: 20px;
    left: 20px;

    padding: 9px 13px;

    background: white;

    border-radius: 8px;

    font-size: 13px;
    font-weight: 600;

    box-shadow:
        0 3px 12px rgba(0,0,0,.08);
}

.map-city {
    position: absolute;

    z-index: 2;

    font-size: 16px;
    font-weight: 600;
}

.city-pokhara {
    top: 72px;
    left: 27%;
}

.city-kathmandu {
    top: 200px;
    left: 58%;
}

.city-bhaktapur {
    top: 270px;
    left: 69%;
}


/* route */

.map-route {
    position: absolute;

    left: 29%;
    top: 105px;

    width: 45%;
    height: 180px;

    border-bottom: 5px solid #6656d9;

    border-radius: 50%;

    transform: rotate(10deg);
}

.map-route::after {
    content: '';

    position: absolute;

    width: 45%;
    height: 100px;

    right: -10px;
    bottom: -42px;

    border-bottom: 5px solid #6656d9;

    border-radius: 50%;

    transform: rotate(-35deg);
}

.map-point {
    position: absolute;

    z-index: 3;

    width: 34px;
    height: 34px;

    display: flex;
    align-items: center;
    justify-content: center;

    border: 4px solid white;

    border-radius: 50%;

    background: #6656d9;

    color: white;

    font-size: 11px;

    box-shadow:
        0 4px 12px rgba(0,0,0,.2);
}

.point-1 {
    left: 0;
    top: -17px;
}

.point-2 {
    left: 55%;
    top: 65px;
}

.point-3 {
    right: -12px;
    bottom: -16px;
}


/* =========================
   ABOUT
========================= */

.journey-about {
    padding: 30px;

    background: white;

    border-radius: 16px;

    box-shadow:
        0 8px 30px rgba(0,0,0,.05);
}

.journey-about h2 {
    margin: 0 0 20px;

    font-size: 23px;
}

.journey-about > p {
    margin-bottom: 28px;

    color: #555;

    font-size: 15px;
    line-height: 1.7;
}

.journey-about-list {
    display: flex;
    flex-direction: column;

    gap: 20px;
}

.about-item {
    display: flex;
    align-items: center;

    gap: 14px;
}

.about-icon {
    font-size: 21px;
}

.about-item small {
    display: block;

    margin-bottom: 3px;

    color: #999;

    font-size: 12px;
}

.about-item strong {
    display: block;

    font-size: 14px;
}


/* =========================
   STORIES
========================= */

.journey-stories {
    margin-bottom: 50px;
}

.stories-header {
    display: flex;

    justify-content: space-between;
    align-items: flex-end;

    margin-bottom: 24px;
}

.stories-header h2 {
    margin: 0 0 6px;

    font-size: 28px;
}

.stories-header p {
    margin: 0;

    color: #888;

    font-size: 14px;
}

.stories-sort {
    color: #555;

    font-size: 14px;
}


/* GRID */

.stories-grid {
    display: grid;

    grid-template-columns: repeat(2, 1fr);

    gap: 20px;
}


/* CARD */

.story-card {
    display: flex;

    min-height: 190px;

    overflow: hidden;

    background: white;

    border-radius: 14px;

    color: inherit;
    text-decoration: none;

    box-shadow:
        0 5px 25px rgba(0,0,0,.05);

    transition:
        transform .2s,
        box-shadow .2s;
}

.story-card:hover {
    transform: translateY(-3px);

    box-shadow:
        0 12px 35px rgba(0,0,0,.09);
}

.story-image {
    position: relative;

    width: 46%;

    flex-shrink: 0;

    overflow: hidden;
}

.story-image img {
    width: 100%;
    height: 100%;

    object-fit: cover;

    transition: transform .3s;
}

.story-card:hover .story-image img {
    transform: scale(1.05);
}

.story-number {
    position: absolute;

    top: 12px;
    left: 12px;

    width: 34px;
    height: 34px;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 50%;

    background: #6656d9;

    color: white;

    font-size: 12px;
    font-weight: 600;
}

.story-content {
    display: flex;
    flex-direction: column;

    flex: 1;

    padding: 22px;
}

.story-city {
    margin-bottom: 10px;

    color: #6656d9;

    font-size: 13px;
}

.story-content h3 {
    margin: 0;

    font-size: 18px;
    line-height: 1.35;
}

.story-footer {
    display: flex;

    align-items: center;
    justify-content: space-between;

    margin-top: auto;
    padding-top: 20px;

    color: #888;

    font-size: 12px;
}

.story-arrow {
    color: #222;

    font-size: 24px;

    transition: transform .2s;
}

.story-card:hover .story-arrow {
    transform: translateX(5px);
}


/* =========================
   QUOTE
========================= */

.journey-quote {
    display: flex;
    align-items: center;

    gap: 22px;

    padding: 30px 36px;

    border-radius: 16px;

    background: #f7f5ff;
}

.quote-icon {
    width: 52px;
    height: 52px;

    flex-shrink: 0;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 50%;

    background: #6656d9;

    font-size: 22px;
}

.journey-quote p {
    margin: 0 0 5px;

    font-size: 16px;
    font-weight: 500;
}

.journey-quote span {
    color: #888;

    font-size: 13px;
}


/* =========================
   MOBILE
========================= */

@media (max-width: 900px) {

    .journey-page {
        padding: 16px;
    }

    .journey-stats {
        grid-template-columns: repeat(2, 1fr);

        gap: 24px;
    }

    .journey-stat {
        border-right: none;
    }

    .journey-overview {
        grid-template-columns: 1fr;
    }

    .stories-grid {
        grid-template-columns: 1fr;
    }

}


@media (max-width: 600px) {

    .journey-hero {
        min-height: 400px;
    }

    .journey-hero-content {
        min-height: 400px;

        padding: 40px 25px;
    }

    .journey-hero h1 {
        font-size: 34px;
    }

    .journey-hero-meta {
        gap: 12px;
    }

    .journey-stats {
        grid-template-columns: 1fr;

        margin-left: 0;
        margin-right: 0;
    }

    .journey-stat {
        padding: 0;
    }

    .stories-header {
        align-items: flex-start;

        flex-direction: column;

        gap: 12px;
    }

    .story-card {
        flex-direction: column;
    }

    .story-image {
        width: 100%;
        height: 220px;
    }

}
</style>