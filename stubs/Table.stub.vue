<template>
    <Index :table="table">
        <Table :table="table">
            <template v-slot:thead>
                <{{ Resource }}TableHead :table="table" />
            </template>
            <template v-slot:tbody>
                <{{ Resource }}TableBody :table="table" />
            </template>
        </Table>
    </Index>
</template>

<script setup lang="ts">
import { useIndex } from '@macramejs/macrame-vue3';
import { Index, Table, Search } from '@macramejs/admin-vue3';
import { {{ Resource }} } from '@admin/modules/resources';
import {{ Resource }}TableBody from './{{ Resource }}TableBody.vue';
import {{ Resource }}TableHead from './{{ Resource }}TableHead.vue';

let table = useIndex<{{ Resource }}>({
    route: '/admin/{{ routeResource }}/items',
    syncUrl: true,
    sortBy: [],
});
</script>
