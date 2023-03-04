<template>
    <div>
        <RouterLink :to="{ name: 'home' }" class="text-blue-500">
            &#8592; Back to home
        </RouterLink>

        <Suspense>
            <UserReport :id="id" class="mt-4" />

            <template #fallback>
                <div class="flex justify-center p-8">
                    <Spinner />
                </div>
            </template>
        </Suspense>
    </div>
</template>

<script lang="ts" setup>
import { useRoute } from 'vue-router';
import UserReport from '@/components/UserReport.vue';
import Spinner from '@/components/Spinner.vue';

const id = useRoute().params.id as string;
</script>
