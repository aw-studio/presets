<template>
    <Admin>
        <template v-slot:header>
            <Button sm @click="form.submit()"> Save Changes </Button>
        </template>
        <Layout>
            <template v-slot:debug>
                <pre class="mb-2">{{ form.content }}</pre>
            </template>
            <template v-slot:content>
                <Sections v-model="form.content" :sections="sections" />
            </template>
            <template v-slot:actions> </template>
            <template v-slot:sidebar>
                <Cabinet class="w-full col-span-1 space-y-2">
                    <TextDrawer :draws="TextSection" />
                    <div
                        :draws="CardsSection"
                        class="px-6 py-4 bg-gray-100 rounded"
                    >
                        Cards
                    </div>
                    <div
                        :draws="UploadSection"
                        class="px-6 py-4 bg-gray-100 rounded"
                    >
                        Image
                    </div>
                </Cabinet>
            </template>
        </Layout>
    </Admin>
</template>

<script setup lang="ts">
import { defineProps } from 'vue';
import { Admin } from '@admin/layout';
import Layout from './package/Layout.vue';
import { useForm } from '@macramejs/macrame-vue3';
import { Button } from '@macramejs/admin-vue3';
import TextSection from './sections/TextSection.vue';
import CardsSection from './sections/CardsSection.vue';
import UploadSection from './sections/UploadSection/UploadSection.vue';
import TextDrawer from './drawers/TextDrawer.vue';
import { Sections, Cabinet } from '@macramejs/page-builder-vue3';

const props = defineProps({
    site: {
        type: Object,
        required: true,
    },
});

const form = useForm(
    `/admin/sites/${props.site.id}`,
    {
        content: props.site.content,
    },
    { method: 'post' }
);

const sections = {
    text: TextSection,
    cards: CardsSection,
    upload: UploadSection,
};
</script>
