<template>
    <Tr
        v-for="(site, trKey) in table.items"
        :key="`th-${trKey}`"
        @click="Inertia.visit(`/admin/sites/${site.id}`)"
    >
        <Td>
            {{ site.name }}
        </Td>
        <Td> /{{ site.slug }} </Td>
    </Tr>
</template>

<script setup lang="ts">
import { Inertia } from '@inertiajs/inertia';
import { PropType } from 'vue';
import { Index } from '@macramejs/macrame-vue3';
import { Tr, Td } from '@macramejs/admin-vue3';

type Site = {
    id: number;
    name: string;
    slug: string;
    content: string;
};

defineProps({
    table: Object as PropType<Index<Site>>,
});
</script>
