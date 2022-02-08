<template>
    <Tr
        v-for="(user, trKey) in table.items"
        :key="`th-${trKey}`"
        @click="Inertia.visit(`/admin/{{ routeResource }}/${{{ resource }}.id}`)"
    >
        <Td slim>
            <strong>{{ {{ resource }}.id }}</strong>
        </Td>
        <Td slim> {{ {{ resource }}.name }} </Td>
    </Tr>
</template>

<script setup lang="ts">
import { Inertia } from '@inertiajs/inertia';
import { PropType } from 'vue';
import { Index } from '@macramejs/macrame-vue3';
import { Tr, Td } from '@macramejs/admin-vue3';
import { {{ Resource }} } from '@admin/modules/resources';
defineProps({
    table: Object as PropType<Index<{{ Resource }}>>,
});
</script>
