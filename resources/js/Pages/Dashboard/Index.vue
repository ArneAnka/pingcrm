<template>
  <div>
    <Head title="Dashboard" />
    <h1 class="mb-8 text-3xl font-bold">Dashboard</h1>
      <div class="grid grid-rows-1 md:grid-cols-3 gap-4">
        <div class="bg-white rounded-md shadow overflow-hidden p-3">
          <h3>Antal användare</h3>
          <div class="mt-4 font-bold">
            <span class="text-2xl">{{ total_users }}</span>
          </div>
          <div class="mt-4">
            <div v-if="total_percentage < 0" class="flex items-center">
              <IconVue name="trend-down" class="block h-4 fill-red-500" />
              <span class="ml-1">{{ total_percentage }}% nedgång (30 dagar).</span>
            </div>
            <div v-else-if="total_percentage > 0" class="flex items-center">
              <IconVue name="trend-up" class="block h-4 fill-green-500" />
              <span class="ml-1">{{ total_percentage }}% uppgång (30 dagar).</span>
            </div>
          </div>
        </div>
        <div class="bg-white rounded-md shadow overflow-hidden p-3">
          <span>Antal svar</span>
          <div class="my-4">
            <span class="text-2xl font-bold">{{ total_answers }}</span>
            <div class="mt-4">
            <div v-if="total_percentage_answers < 0" class="flex items-center">
              <IconVue name="trend-down" class="block h-4 fill-red-500" />
              <span class="ml-1">{{ total_percentage_answers }}% nedgång (30 dagar).</span>
            </div>
            <div v-else-if="total_percentage_answers > 0" class="flex items-center">
              <IconVue name="trend-up" class="block h-4 fill-green-500" />
              <span class="ml-1">{{ total_percentage_answers }}% uppgång (30 dagar).</span>
            </div>
            </div>
          </div>
        </div>
        <div class="bg-white rounded-md shadow overflow-hidden p-3">
          <span>Reserv</span>
          <div>
            Reserv
          </div>
        </div>
        <div class="bg-white rounded-md shadow overflow-hidden p-3">
          <span>Inkomst månad</span>
          <div class="my-4">
            <span class="text-2xl font-bold">0</span>
          </div>
          <div class="flex items-center">
            <IconVue name="money" class="block h-4" /> 
            <span class="ml-1">0 iår.</span>
          </div>
        </div>
        <div class="bg-white rounded-md shadow overflow-hidden p-3">
          <span>Inkomst år</span>
          <div>
            <IconVue name="money" class="block h-4" />
          </div>
        </div>
        <div class="bg-white rounded-md shadow overflow-hidden p-3">
          <span>Senast registrerad användare</span>
          <div class="my-4 text-2xl font-bold"> {{ latest_registred_user.name }}</div>
          <div class="my-4"> {{ latest_registred_user.email }}</div>
        </div>
      </div>
  </div>
</template>

<script>
import { Head } from '@inertiajs/inertia-vue3'
import Layout from '@/Shared/Layout'
import IconVue from '@/Shared/Icon.vue'

export default {
  components: {
    Head,
    IconVue
  },
  layout: Layout,
  props:[
    'total_percentage',
    'total_percentage_answers',
    'total_users',
    'total_answers',
    'total_correct',
    'total_wrong',
    'latest_registred_user'
    ]
}
</script>
