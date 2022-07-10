<template>
    <Head title="Images" />
    <div class="grid grid-cols-3">
        <div v-for="(question, index) in questions" v-bind:key="index" class="p-1 border">
            <img class="hover:scale-110 ease-in duration-100" :src="`https://bkort.se.test/storage/${question.image}`" :alt="question.description" />
            <IconVue name="circle-arrow" class="block h-4 fill-green-500" /> {{ question.description }}
        </div>
    </div> 
</template>

<script>
import { Head, Link } from '@inertiajs/inertia-vue3'
import Layout from '@/Shared/Layout'
import IconVue from '@/Shared/Icon.vue'

export default {
    layout: Layout,
    props: {
        questions: Object
    },
    components: {
        Head, 
        IconVue,
    },
    data(){
        return {
            title: 'Bilder'
        }
    }
}
</script>