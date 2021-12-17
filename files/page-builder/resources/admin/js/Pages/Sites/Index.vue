<template>
    <Admin>
        <div class="m-10">
            <SitesTable />
        </div>
    </Admin>
</template>

<script setup lang="ts">
import { Admin } from '@admin/layout';
import SitesTable from './components/SitesTable.vue';
</script>
