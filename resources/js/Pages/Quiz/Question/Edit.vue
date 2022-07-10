<template>
  <div>
    <Head title="Quiz Management" />
    <h1 class="mb-8 text-3xl font-bold">Fråga #{{ question.id }}</h1>
  </div>

<div class="max-w-3xl bg-white rounded-md shadow overflow-hidden">
      <form @submit.prevent="update">
        <div class="grid gap-4 -mb-8 -mr-6 p-8">
          <TextareaInputVue v-model="form.description" :error="form.errors.description" class="pb-8 pr-6 w-full" label="Fråga" />
          <TextareaInputVue v-model="form.source" :error="form.errors.source" class="pb-8 pr-6 w-full" label="Förklaring" />
          <file-input v-model="form.photo" :error="form.errors.photo" class="pb-8 pr-6 w-full" type="file" accept="image/*" label="Photo" />
        </div>
        <div v-if="!question.is_info">
          <div class="flex flex-col space-y-2 mb-1 -pt-8 p-8">
            <RadioVue :choices="form.choices">Svarsalternativ</RadioVue>
            <button class="bg-green-200 shadow w-full rounded-full py-2" v-on:click.prevent="addChoiceItem" type="button">Lägg till svarsalternativ</button>
          </div>
          <div class="flex items-center px-8 py-4 bg-gray-50 border-t border-gray-100">
            <span>Senast uppdaterad {{ updated_at }}</span>
            <loading-button :loading="form.processing" class="btn-indigo ml-auto" type="submit">Uppdatera frågan</loading-button>
          </div>
        </div>
        <div v-if="question.is_info" class="-mb-8 -mr-6 p-8">
          <span class="text-2xl">
            Detta är en informations-tavla.
          </span>
        </div>
      </form>
  </div>


</template>

<script>
import Layout from '@/Shared/Layout'
import { Head, Link } from '@inertiajs/inertia-vue3'
import LoadingButton from '@/Shared/LoadingButton'
import TextareaInputVue from '@/Shared/TextareaInput'
import FileInput from '@/Shared/FileInput'
import RadioVue from '@/Shared/Radio.vue'
import dayjs from 'dayjs'
import { v4 as uuid } from 'uuid'
import axios from 'axios'

export default {
  components: {
    Head,
    Link,
    LoadingButton,
    TextareaInputVue,
    FileInput,
    RadioVue
  },
    layout: Layout,
    props: {
      question: Object
    },
    computed:{
      updated_at(){
        return dayjs(this.question.updated_at)
      }
    },
  data() {
    return {
      form: this.$inertia.form({
        _method: 'put',
        description: this.question.description,
        source: this.question.source,
        choices: this.question.choices
      }),
    }
  },
  methods: {
    update() {
      this.form.post(`/question/${this.question.id}`, {
        onSuccess: () => this.form.reset('photo'),
      })
    },
    addChoiceItem(){
      axios.post(`/question/${this.question.id}/choice/add`)
      .then(response => {
        this.form.choices = response.data.choices
        console.log(this.form.choices)
      })
      .catch(error => {
        console.log(error)
      })
    }
  }
}
</script>