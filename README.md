# Интерактивная карта путешествий

Интерактивная карта путешествий на Laravel + Vue + MapLibre GL.

## Стек

- Laravel
- Vue 3
- Vite
- MapLibre GL
- Joomla API
- MySQL

## Возможности

- отображение путешествий на карте
- кастомные маркеры
- попап с информацией о путешествии
- фильтрация по годам
- получение данных из Joomla через Laravel API
- динамическая загрузка точек

## Архитектура

Joomla
↓
Laravel API
↓
Vue
↓
MapLibre GL

## Описание логики работы приложения
Есть сайт https://maxwrites.ru , который работает на базе CMS Joomla. Там я пишу заметки из путешествий, которые в свою очередь хранятся в базе данных MySQL.
Для создания интерактивной карты я разработал отдельное приложение на **Laravel + Vue.js**. **Laravel** выступает в качестве API-слоя и получает необходимые данные непосредственно из базы Joomla: координаты, название и описание путешествия, дату публикации, изображение и другие параметры.

На фронтенде данные динамически обрабатываются во **Vue.js** и отображаются на интерактивной карте с использованием **MapLibre GL**. Для каждой записи создаётся кастомный маркер с изображением, а при нажатии открывается попап с информацией о путешествии и ссылкой на соответствующую статью.

Также реализован **фильтр путешествий по годам**. Можно выбрать нужный год, после чего **Laravel API** запрашивает из базы только соответствующие записи, а карта обновляет набор отображаемых маркеров без перезагрузки страницы.


# Interactive travel map

An interactive travel map built with Laravel, Vue, and MapLibre GL.

## Tech Stack

- Laravel
- Vue 3
- Vite
- MapLibre GL
- Joomla API
- MySQL

## Features

- Displaying trips on a map
- Custom markers
- Trip information popups
- Filtering by year
- Data retrieval from Joomla via Laravel API
- Dynamic loading of map points

## Architecture

Joomla
↓
Laravel API
↓
Vue
↓
MapLibre GL

## Application Logic
There is a website, https://maxwrites.ru, powered by the Joomla CMS. I publish travel notes there, which are stored in a MySQL database.
To create an interactive map, I developed a separate application using **Laravel + Vue.js**. Laravel acts as the API layer, fetching the necessary data directly from the Joomla database—such as coordinates, trip title and description, publication date, images, and other parameters.

On the frontend, the data is dynamically processed via Vue.js and displayed on an interactive map using **MapLibre GL**. A custom marker featuring an image is created for each entry; clicking a marker opens a popup containing trip details and a link to the corresponding article.

A **year-based filter** has also been implemented. Users can select a specific year, prompting the Laravel API to fetch only the relevant records from the database, while the map updates the displayed markers without requiring a page reload.

