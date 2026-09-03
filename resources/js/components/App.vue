<script setup>
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