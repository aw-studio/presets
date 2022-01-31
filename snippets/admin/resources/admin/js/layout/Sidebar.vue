<template>
    <nav class="space-y-6 tracking-widest">
       
    </nav>
</template>

<script setup lang="ts">
import { PropType, computed } from 'vue';
import { TSidebar } from '@macramejs/admin-vue3';
import { Link } from '@inertiajs/inertia-vue3';
import { usePage } from '@inertiajs/inertia-vue3';

defineProps({
    sidebar: Object as PropType<TSidebar>,
});

const page = computed(() => {
    return usePage().url.value;
});
</script>
