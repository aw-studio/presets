<template>
    <Card>
        <div
            class="w-full col-span-full"
            @click="isOpen = true"
            @drop.prevent="dropOpen"
            @dragover.prevent
        >
            <img
                :src="`/storage/files/${selectedFile}`"
                class="rounded"
                v-if="selectedFile"
            />
            <Dropzone v-if="!selectedFile" />
        </div>
    </Card>
    <Modal :open="isOpen" @close="isOpen = false">
        <div>
            <progress
                v-if="form.progress"
                :value="form.progress.percentage"
                max="100"
            >
                {{ form.progress.percentage }}%
            </progress>
        </div>
        <FileExplorer :files="site.files" v-model="model.file">
            <div v-if="selectedFile">
                <img :src="`/storage/files/${selectedFile}`" class="rounded" />
            </div>
            <template v-slot:drop>
                <Dropzone
                    @drop.prevent="dropFile"
                    @dragover.prevent
                    class="my-4"
                />
            </template>
        </FileExplorer>
    </Modal>
</template>

<script setup lang="ts">
import { computed, ref, reactive, watch } from 'vue';
import { useForm, usePage } from '@inertiajs/inertia-vue3';
import { Modal, Card } from '@macramejs/admin-vue3';
import FileExplorer from './FileExplorer.vue';
import Dropzone from './Dropzone.vue';

const props = defineProps({
    modelValue: {
        type: Object,
        required: true,
        default: () => ({
            file: null,
        }),
    },
});

const model = reactive(props.modelValue);

const emit = defineEmits(['update:modelValue']);
watch(
    () => model,
    () => emit('update:modelValue', model),
    { deep: true }
);

const form = useForm({
    file: props.modelValue.file,
});

const site: any = computed(() => {
    return usePage().props.value?.site;
});

const submit = () => {
    form.post(`/admin/sites/${site.value.id}/upload`, {
        onSuccess: () => {
            form.reset();
        },
    });
};

const selectedFile: any = computed(() => {
    return site.value.files?.find((image: any) => image.id == model.file)
        ?.filepath;
});

const isOpen = ref(false);

const dropFile = (e: any) => {
    form.file = e.dataTransfer.files[0];
    submit();
};
const dropOpen = (e: any) => {
    form.file = e.dataTransfer.files[0];
    submit();
    isOpen.value = true;
};
</script>

<style>
.square {
    padding-bottom: 100%;
}
</style>
