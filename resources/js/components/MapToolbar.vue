<script setup>
const props = defineProps({
    years: {
        type: Array,
        default: () => []
    },
     selectedYear: {
        type: [String, Number],
        default: null
    }
});

const emit = defineEmits(['select-year'])

function selectYear(year) {
    emit('select-year', year)
}

</script>

<template>
    <div class="map-toolbar">
        <button  class="year-button year-button--all"
            :class="{ active: selectedYear === null }"
            @click="selectYear(null)"
        >
            Все
        </button>

        <button class="year-button"
            v-for="year in years"
            :key="year"
            :class="{ active: selectedYear === year }"
            @click="selectYear(year)"
        >
            {{ year }}
        </button>
    </div>
</template>