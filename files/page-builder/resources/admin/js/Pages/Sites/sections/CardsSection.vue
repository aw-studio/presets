<template>
    <Card>
        <Sections
            v-model="model.cards"
            :group="id"
            :sections="{ text: TextSection, cards: CardsSection }"
            class="w-full h-12"
        />

        <Cabinet class="w-full col-span-1 space-y-2" :group="id">
            <TextDrawer :draws="TextSection" />
            <div :draws="CardsSection" class="px-6 py-4 bg-gray-100 rounded">
                Cards
            </div>
        </Cabinet>
    </Card>
</template>
<script setup lang="ts">
import { Card } from '@macramejs/admin-vue3';
import { defineProps, watch, defineEmits, reactive } from 'vue';
import TextSection from './TextSection.vue';
import CardsSection from './CardsSection.vue';
import TextDrawer from './../drawers/TextDrawer.vue';
import { v4 as uuid } from 'uuid';
import { Sections, Cabinet } from '@macramejs/page-builder-vue3';

const emit = defineEmits(['update:modelValue']);

const props = defineProps({
    modelValue: {
        type: Object,
        required: true,
        default: () => ({
            cards: [],
        }),
    },
});

const model = reactive(props.modelValue);

const id = uuid();

emit('update:modelValue', model);

watch(
    () => model,
    () => emit('update:modelValue', model),
    { deep: true }
);
</script>
