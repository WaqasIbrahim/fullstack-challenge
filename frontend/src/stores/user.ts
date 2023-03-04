import { defineStore } from 'pinia';
import axios from 'axios';
import { ref } from 'vue';
import type { User } from '@/types';

const BASE_URL = import.meta.env.VITE_API_BASE_URL;

export const useUserStore = defineStore('user', () => {
    const users = ref<Required<User>[]>([]);
    const user = ref<Required<User> | null>(null);

    async function fetchAllUsers() {
        const response = await axios.get<{ data: Required<User>[] }>(BASE_URL);
        users.value = response.data.data.map((user) => {
            if (user.weather) {
                user.weather.temperature.value = Math.round(
                    user.weather.temperature.value
                );
            }

            return user;
        });
    }

    async function fetchUser(id: string) {
        const response = await axios.get<{ data: Required<User> }>(
            `${BASE_URL}/${id}`
        );

        user.value = response.data.data;
    }

    return {
        users,
        user,
        fetchAllUsers,
        fetchUser,
    };
});
