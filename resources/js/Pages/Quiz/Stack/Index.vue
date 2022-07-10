<template>
  <div>
    <Head title="Quiz Management" />
    <h1 class="mb-8 text-3xl font-bold">{{ stack.name }}</h1>

    <div v-for="question in stack.questions" class="mb-1">
      <Link class="underline" :href="`/question/${question.id}/edit`">
        {{ question.description }}
      </Link>
    </div>
  </div>
</template>

<script>
import Layout from '@/Shared/Layout'
import { Head, Link } from '@inertiajs/inertia-vue3'

export default {
  components: {
    Head,
    Link
  },
  layout: Layout,
  props: {
    stack: Object
  }
}
</script>