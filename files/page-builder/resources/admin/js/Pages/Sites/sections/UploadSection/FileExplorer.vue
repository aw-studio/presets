<template>
    <div class="grid grid-cols-2 gap-4">
        <div class="col-span-1">
            <slot />
        </div>
        <div class="col-span-1">
            <div class="grid grid-cols-4 gap-4">
                <div
                    v-for="file in files"
                    class="relative col-span-1 overflow-hidden rounded square"
                    @click="value = file.id"
                    :class="{
                        ' ring-2 ring-primary': value == file.id,
                    }"
                >
                    <img
                        :src="`/storage/files/${file.filepath}`"
                        class="absolute top-0 left-0 object-cover w-full h-full"
                    />
                </div>
            </div>
            <slot name="drop" />
        </div>
    </div>
</template>

<script setup lang="ts">
import { computed, ref, PropType, watch } from 'vue';
const props = defineProps({
    modelValue: {
        type: Array as PropType<any>,
        required: true,
    },
    files: {
        type: Array as PropType<any[]>,
        default: null,
    },
});
const value = ref(props.modelValue);
const emit = defineEmits(['update:modelValue']);
watch(
    () => value,
    (state, prevState) => {
        emit('update:modelValue', value.value);
    },
    { deep: true }
);
</script>

<style>
.square {
    height: 0px;
    padding-bottom: 100%;
}
</style>
