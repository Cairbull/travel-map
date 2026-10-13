<script setup lang="ts">
import DashboardHeader from './DashboardHeader.vue';
</script>

<template>
    <div class="app">
        <DashboardHeader />
        <main class="app-content">
            <RouterView />
        </main>
    </div>
</template>