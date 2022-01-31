<template>
    <div class="grid grid-cols-5 flex-1 h-full">
        <div class="col-span-4 overflow-y-scroll bg-primary-50 p-4 space-y-4">
            <slot name="content" />
        </div>
        <div
            class="
                sticky
                top-0
                flex flex-col
                items-end
                justify-between
                col-span-1
                px-8
                py-4
                bg-white
            "
        >
            <div class="flex items-center flex-1 w-full">
                <div class="w-full">
                    <slot name="sidebar" />
                </div>
            </div>
        </div>
    </div>
</template>
<script setup lange="ts"></script>
