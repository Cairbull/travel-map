<script setup lang="ts">
import maplibregl from "maplibre-gl";
import { ref, onMounted } from "vue";
import MapToolbar from "@/components/MapToolbar.vue";
import "maplibre-gl/dist/maplibre-gl.css";

const mapContainer = ref(null);
const map = ref(null);
const markers = [];

const coordRegex =
  /^-?([1-8]?\d(?:\.\d+)?|90(?:\.0+)?),\s*-?((?:1[0-7]\d|[1-9]?\d)(?:\.\d+)?|180(?:\.0+)?)$/;
const imageRegex = /"image_intro":"([^"#]+)(?=#)/;
const years = ref([]);
const selectedYear = ref(null);

/* Настройка формата даты в попапе маркера */
const formatDate = (date) => {
  return new Intl.DateTimeFormat("ru-RU", {
    day: "numeric",
    month: "long",
    year: "numeric",
  }).format(new Date(date));
};
/* Настройка формата даты в попапе маркера  */

/* Получаем год из поля публикации */

/* Получение года из поля публикации */
const getYear = (date) => {
  return new Intl.DateTimeFormat("ru-RU", {
    year: "numeric",
  }).format(new Date(date));
};
/* Получение года из поля публикации */

/* Создание маркера */
const createMarker = (
  titleContent,
  aliasContent,
  introText,
  publishDate,
  previewImage,
  country,
  city,
  coordinates
) => {
  //т.к. данные берутся из полей Joomla, то через регулярку достаем путь к картинке и координаты, т.к. они там массивом, а нам нужно разбить на долготу и широту
  const foundCoord = coordinates.match(coordRegex);
  const foundImage = previewImage.match(imageRegex);

  if (foundCoord != null) {
    const lat = Number(foundCoord[1]);
    const lng = Number(foundCoord[2]);
    const image = foundImage[1].replace(/\\\//g, "/");

    //создаем html элемент с маркером на карте
    const markerCustom = document.createElement("div");
    markerCustom.className = "travel-marker";

    markerCustom.innerHTML = `
    <img src="https://maxwrites.ru/${image}">
`;

   const marker = new maplibregl.Marker({
      element: markerCustom,
      anchor: "bottom",
    })
      .setLngLat([lng, lat])
      .setPopup(
        new maplibregl.Popup().setHTML(
          `<div class="popup-travel"> <div class="popup-travel__image"> <img src="https://maxwrites.ru/${image}"/> </div> <div class="popup-travel__content"> <h3> ${titleContent} </h3> ${introText} </div> <div class="popup-travel__footer"> <span class="popup-travel__date">  📅 ${formatDate(publishDate)} </span> <a href="https://maxwrites.ru/index.php/istorii/${aliasContent}" target="_blank"> Читать статью → </a> </div> </div>`,
        ),
      )
      .addTo(map.value);
    markers.push(marker);
  }
};
/* Создание маркера */

/* Очистка точек на карте */
const clearMarkers = () => {
  markers.forEach((marker) => {
    marker.remove();
  });
  markers.length = 0;
};
/* Очистка точек на карте */

/* Загрузка точек */
const loadPoints = async (url) => {
  //получаем массив точек
  const response = await fetch(url);
  const points = await response.json();
  // создаем массив годов для фильтра
  const yearsList = points.map((point) => getYear(point.publish_up));
  //сортируем года по возрастанию
  years.value = [...new Set(yearsList)].sort((a, b) => a - b);
  // при выборе нового года убираем старые точки
  clearMarkers();

  points.forEach((point) => {
    createMarker(
      point.title,
      point.alias,
      point.introtext,
      point.publish_up,
      point.images,
      point.country,
      point.city,
      point.coordinates
    );
  });
};
/* Загрузка точек */

/* Инициализация карты */
onMounted(async () => {
  map.value = new maplibregl.Map({
    container: mapContainer.value,
    style: "https://tiles.openfreemap.org/styles/liberty",
    center: [85.315466, 27.713729],
    zoom: 4,
  });
  map.value.on("load", async () => {
    await loadPoints("/api/map-points");
  });
});
/* Инициализация карты*/

/* Выбор года */
const changeYear = async (year) => {
  selectedYear.value = year;

  const url = year ? `/api/filter-data?year=${year}` : "/api/map-points";

  await loadPoints(url);
};
/* Выбор года */
</script>
<template>
  <div ref="mapContainer" class="map">
    <div class="toolbarFilter">
      <MapToolbar
        :years="years"
        :selected-year="selectedYear"
        @select-year="changeYear"
      />
    </div>
  </div>
</template>
