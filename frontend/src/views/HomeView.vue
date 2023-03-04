<template>
    <Suspense>
        <UsersList />

        <template #fallback>
            <div class="flex justify-center p-8">
                <Spinner />
            </div>
        </template>
    </Suspense>
</template>

<script setup lang="ts">
import Spinner from '@/components/Spinner.vue';
import UsersList from '@/components/UsersList.vue';
</script>
