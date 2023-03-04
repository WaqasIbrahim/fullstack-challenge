<template>
    <div>
        <ul class="max-w-md mx-auto">
            <li v-for="user in store.users" :key="user.id" class="mb-4 cursor-pointer">
                <UserCard :user="user" />
            </li>
        </ul>
    </div>
</template>

<script lang="ts" setup>
import { useUserStore } from '@/stores/user';
import UserCard from './UserCard.vue';

const store = useUserStore();

await store.fetchAllUsers();
</script>
