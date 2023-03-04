<template>
    <div v-if="user !== null" class="p-8 border border-gray-200 rounded-lg shadow-xl">
        <h1 class="text-xl text-gray-500">{{ user.name }}</h1>

        <div v-if="user.weather">
            <p v-if="user.weather.location.name" class="mt-1 text-gray-500">
                <span v-if="user.weather.location.countryCode" class="mr-1 fi"
                    :class="`fi-${user.weather.location.countryCode.toLowerCase()}`">
                </span>
                {{ user.weather.location.name }}
            </p>

            <div class="flex items-center mt-2">
                <div class="flex items-center">
                    <img :src="user.weather.iconUrl" />
                    <p class="flex flex-col">
                        <span class="text-gray-400">{{
                            user.weather.description
                        }}</span>
                        <span class="text-2xl text-gray-500">{{ user.weather.temperature.value }}°</span>
                    </p>
                </div>

                <div class="ml-auto">
                    <p class="mb-1 text-gray-400">
                        Feels like
                        {{ user.weather.temperature.feelsLike }}°
                    </p>

                    <p class="mb-1 text-gray-400">
                        Min {{ user.weather.temperature.min }}°
                    </p>

                    <p class="text-gray-400">
                        Max {{ user.weather.temperature.max }}°
                    </p>
                </div>
            </div>

            <p class="mt-2 text-sm text-gray-400">
                Last updated {{ user.weather.updatedAt }}
            </p>
        </div>

        <p v-else class="text-gray-300">No weather data found for the user.</p>
    </div>
</template>

<script lang="ts" setup>
import { useUserStore } from '@/stores/user';
import { storeToRefs } from 'pinia';

const props = defineProps({
    id: { type: String, required: true },
});

const store = useUserStore();

await store.fetchUser(props.id);
const { user } = storeToRefs(store);
</script>
