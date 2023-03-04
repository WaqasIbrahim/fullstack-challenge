<template>
    <RouterLink class="flex items-center p-4 border border-gray-200 rounded"
        :to="{ name: 'user', params: { id: user.id } }">
        <p class="font-semibold text-gray-500">
            {{ user.name }}
        </p>

        <div v-if="user.weather" class="flex items-center ml-auto">
            <img :src="user.weather.iconUrl" class="w-8 mr-1" />
            <p class="text-gray-400">
                {{ user.weather.condition }}
                ({{ user.weather.temperature.value }}°)
            </p>
        </div>

        <p v-else class="ml-auto text-gray-300">No weather data found.</p>
    </RouterLink>
</template>

<script lang="ts" setup>
import type { PropType } from 'vue';
import type { User } from '@/types';

defineProps({
    user: { type: Object as PropType<Required<User>>, required: true },
});
</script>
