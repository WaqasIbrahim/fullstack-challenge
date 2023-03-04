<template>
    <div class="max-w-md mx-auto">
        <h1 class="my-8 text-4xl text-center text-gray-600">
            Fullstack Challenge
        </h1>
        <main>
            <RouterView />
        </main>
    </div>
</template>

<script setup lang="ts">
import { RouterView } from 'vue-router';
</script>
