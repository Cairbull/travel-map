# Интерактивная карта путешествий

Интерактивная карта путешествий на Laravel + Vue + MapLibre GL.

## Стек

- Laravel
- Vue 3
- Vite
- MapLibre GL
- Joomla API
- MySQL
- Redis
- Scheduler

## Возможности

- отображение путешествий на карте
- кастомные маркеры
- попап с информацией о путешествии
- фильтрация по годам
- получение данных из Joomla через Laravel API
- динамическая загрузка точек
- Синхронизация Joomla таблицы БД с таблицой БД Laravel
- Кеширование данных для оптимизации запросов
- Планировщик, который выполняет кеширование каждый час и проверяет изменения в данных для возможной синхронизации

## Архитектура

Joomla DB
    │
    │ Scheduler
    ↓
Synchronization
    ↓ CRUD synchronization
Laravel DB
    ↓
Redis Cache
    ↓
Laravel API
    ↓
Vue.js
    ↓
MapLibre GL

## Описание логики работы приложения
Есть сайт https://maxwrites.ru , который работает на базе CMS Joomla. Там я пишу заметки из путешествий, которые в свою очередь хранятся в базе данных MySQL.
Для создания интерактивной карты я разработал отдельное приложение на **Laravel + Vue.js**. **Laravel** выступает в качестве API-слоя и получает необходимые данные непосредственно из базы Joomla: координаты, название и описание путешествия, дату публикации, изображение и другие параметры.

На фронтенде данные динамически обрабатываются во **Vue.js** и отображаются на интерактивной карте с использованием **MapLibre GL**. Для каждой записи создаётся кастомный маркер с изображением, а при нажатии открывается попап с информацией о путешествии и ссылкой на соответствующую статью.

Данные кэшируются посредством **Redis** и таким образом снижают количество загружаемого трафика при загрузке карты у пользователя

Также реализован **фильтр путешествий по годам**. Можно выбрать нужный год, после чего **Laravel API** запрашивает из базы только соответствующие записи, а карта обновляет набор отображаемых маркеров без перезагрузки страницы.

С помощью планировщика задач производится, как очистка кэша для актуализации данных так и синхронизация данных таблицы **Laravel** с таблицей Joomla.
Сделано это для того, чтобы данные тянулись напрямую, а не с Joomla. Тут буквально реализован принцип **CRUD**, когда новые данные создаются, существующие обновляются, а неактуальные удаляются.
<br>
[![Карта путешествий](https://img.shields.io/badge/🌍%20Карта%20путешествий-API-2ea44f?style=for-the-badge)](https://api.maxwrites.ru/api/travel-map)

# Interactive travel map

An interactive travel map built with Laravel, Vue, and MapLibre GL.

## Tech Stack

- Laravel
- Vue 3
- Vite
- MapLibre GL
- Joomla API
- MySQL
- Redis
- Scheduler

## Features

- Displaying trips on a map
- Custom markers
- Trip information popups
- Filtering by year
- Data retrieval from Joomla via Laravel API
- Dynamic loading of map points
- Data caching to optimize queries
- A scheduler that performs caching every hour and tracks data changes for potential synchronization.

## Architecture

Joomla DB
    │
    │ Scheduler
    ↓
Synchronization
    ↓ CRUD synchronization
Laravel DB
    ↓
Redis Cache
    ↓
Laravel API
    ↓
Vue.js
    ↓
MapLibre GL

## Application Logic
There is a website, https://maxwrites.ru, powered by the Joomla CMS. I publish travel notes there, which are stored in a MySQL database.
To create an interactive map, I developed a separate application using **Laravel + Vue.js**. Laravel acts as the API layer, fetching the necessary data directly from the Joomla database—such as coordinates, trip title and description, publication date, images, and other parameters.

On the frontend, the data is dynamically processed via Vue.js and displayed on an interactive map using **MapLibre GL**. A custom marker featuring an image is created for each entry; clicking a marker opens a popup containing trip details and a link to the corresponding article.

Data is cached using **Redis**, thereby reducing the amount of traffic downloaded when the user loads the map.

A **year-based filter** has also been implemented. Users can select a specific year, prompting the Laravel API to fetch only the relevant records from the database, while the map updates the displayed markers without requiring a page reload.

The task scheduler handles both cache clearing—to ensure data is up to date—and the synchronization of data between the **Laravel** table and the **Joomla** table.
This setup ensures that data is retrieved directly rather than from Joomla. It essentially implements the **CRUD** principle: new data is created, existing data is updated, and outdated data is deleted.

[![Travel map](https://img.shields.io/badge/🌍%20Travel%20Map-API-2ea44f?style=for-the-badge)](https://api.maxwrites.ru/api/travel-map)

