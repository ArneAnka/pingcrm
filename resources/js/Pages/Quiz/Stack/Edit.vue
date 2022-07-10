<template>
  <div>
    <Head title="Quiz Management" />
    <h1 class="mb-8 text-3xl font-bold">{{ stack.name }}</h1>

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