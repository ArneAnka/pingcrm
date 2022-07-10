<template>
  <div>
    <Head title="Quiz Management" />
    <h1 class="mb-8 text-3xl font-bold">Quiz Management</h1>
  </div>

  <!-- Sök -->
  <div class="rounded-md bg-white shadow mt-5 p-8 max-w-3xl">
    <div class="">
      <h1 class="text-2xl text-gray-600">Sök</h1>
      <TextInputVue v-model="searchQuestion" @input="loading = true"></TextInputVue>
        <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-black" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" v-if="loading">
        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
      </svg>

      <div v-if="searchResult">
        <div v-for="result in searchResult" class="flex items-center space-x-3 p-2 border bg-slate-100 rounded-md m-1" v-bind:key="result.id">
          <div><img v-if="result.image" class="w-20 border shadow-md shrink-0" :src="`http://bkort.se.test/storage/${result.image}`" /></div>
            <div class="text-slate-400">
              {{ result.id }}, {{ result.description }}
            <div>
          <Link class="" :href="`/question/${result.id}/edit`">
            {{ result.created_at }} &middot; {{ result.updated_at }} &middot; <span :class="`${result.flagged ? 'text-yellow-400' : ''}`">Flaggad</span> &middot; <span class="fa-solid fa-power-off" :class="`${result.enabled ? 'text-green-400' : 'text-red-400'}`">{{ `${result.enabled ? 'Påslagen' : 'Avstängd'}`}}</span> &middot; {{ result.stack.name }}
          </Link>
              </div>
          </div>
        </div>
      </div>
    </div>
</div>


  <div v-for="(subject, index) in objects" v-bind:key="subject.id">
    <div class="max-w-3xl rounded-md bg-white shadow mt-5 p-8">
        <h2 class="text-2xl">
            <Link class="underline" :href="`/subject/${subject.slug}/edit`">
                <span>{{subject.name}}</span>
            </Link>
        </h2>
        <div class="ml-5">
            <h3 v-for="(stack, index) in subject.stacks" v-bind:key="stack.id" class="flex items-center gap-1">
                <Icon v-if="stack.published" name="eye" class="flex-shrink-0 h-3 fill-green-500" />
                <Icon v-if="!stack.published" name="eye-slash" class="flex-shrink-0 h-3 fill-yellow-700" />
                <Link class="underline" :href="`/stack/${stack.slug}`">
                    <span>{{stack.name}}</span>
                </Link>
                ({{ stack.questions_count }})
            </h3>
        </div>
    </div>
  </div>
</template>

<script>
import Layout from '@/Shared/Layout'
import { Head, Link } from '@inertiajs/inertia-vue3'
import TextInputVue from '../../Shared/TextInput.vue'
import _ from 'lodash'
import axios from 'axios'
import dayjs from 'dayjs'
import Icon from '@/Shared/Icon.vue'

export default {
  components: {
    Head,
    Link,
    TextInputVue,
    Icon
  },
  layout: Layout,
  data(){
    return {
      searchQuestion: '',
      debouncedText: '',
      loading: false,
      searchResult: null
    }
  },
  props: {
    objects: Object
  },
  watch:{
    searchQuestion: 'doSearchDebounced'
  },
  methods: {
    doSearchDebounced:
        _.debounce(function() {
          this.doSearchQuestion()
          this.loading = false
        }, 600),
    doSearchQuestion() {
      axios.get('question/search', {
        params: {
          search: this.searchQuestion
        }
          })
          .then(response => {
            this.searchResult = response.data
          })
          .catch(error => {
            console.log(error)
          })
    }
  },
}
</script>