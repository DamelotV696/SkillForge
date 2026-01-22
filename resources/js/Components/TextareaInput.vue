<script setup>
import { onMounted, ref } from 'vue';

const model = defineModel({
    type: String,
    required: true,
});

const input = ref(null);


defineExpose({ focus: () => input.value.focus() });
</script>

<template>
    <textarea class="rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500" v-model="model">

    </textarea>
</template>
