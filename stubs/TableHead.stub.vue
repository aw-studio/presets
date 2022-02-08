<template>
    <Tr>
        <Th :table="table">#</Th>
        <Th :table="table">Name</Th>
    </Tr>
</template>

<script setup lang="ts">
import { PropType } from 'vue';
import { Index } from '@macramejs/macrame-vue3';
import { Tr, Th } from '@macramejs/admin-vue3';
const props = defineProps({
    table: Object as PropType<Index>,
});
</script>
