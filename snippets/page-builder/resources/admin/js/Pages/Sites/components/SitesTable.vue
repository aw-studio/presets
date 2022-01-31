<template>
    <Index :table="table">
        <template v-slot:search>
            <div class="flex justify-between">
                <Search :table="table" placeholder="Seiten durchsuchen" />
            </div>
            <PagesTableFilterList :table="table" />
        </template>
        <Table :table="table">
            <template v-slot:thead>
                <SitesTableHead :table="table" />
            </template>
            <template v-slot:tbody>
                <SitesTableBody :table="table" />
            </template>
        </Table>
    </Index>
</template>

<script setup lang="ts">
import { useIndex } from '@macramejs/macrame-vue3';
import { Index, Table, Search } from '@macramejs/admin-vue3';
import SitesTableHead from './SitesTableHead.vue';
import SitesTableBody from './SitesTableBody.vue';

let table = useIndex({
    route: '/admin/sites/items',
    syncUrl: true,
    defaultPerPage: 30, // deprecated
    sortBy: [],
});

table.addSortBy('id', 'desc');

table.loadItems();
table.reloadOnChange([table.filters]);
table.reloadOnChange([table.sortBy]);
</script>
