<template>
    <DefaultLayout>
        <template v-slot:sidebar-header>
            <div class="flex items-center mb-16">
                <span class="uppercase"> Project Title </span>
            </div>
        </template>
        <template v-slot:sidebar="{ sidebar }">
            <Sidebar :sidebar="sidebar" />
        </template>
        <template v-slot:sidebar-secondary>
            <slot name="sidebar-secondary" />
        </template>
        <template v-slot:header><slot name="header" /></template>
        <template v-slot:header-secondary>
            <slot name="header-secondary" />
        </template>
        <slot />
    </DefaultLayout>
</template>

<script setup lang="ts">
import { DefaultLayout } from '@macramejs/admin-vue3';
import Sidebar from './Sidebar.vue';
</script>

