<template>
    <Admin>
        <div class="flex h-screen">
            <div class="m-auto">
                <h2>Hallo <b>Admin</b></h2>
            </div>
        </div>
    </Admin>
</template>

<script lang="ts">
import { defineComponent } from 'vue';
import { Admin } from '@admin/layout';

export default defineComponent({
    components: { Admin },
    props: {},
    setup() {
        //
    },
});
</script>
