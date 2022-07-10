<template>
  <div>
    <Head :title="`${form.name}`" />
    <div class="flex justify-start mb-8 max-w-3xl">
      <h1 class="text-3xl font-bold">
        <Link class="text-indigo-400 hover:text-indigo-600" href="/users">Users</Link>
        <span class="text-indigo-400 font-medium">/</span>
        {{ form.name }}
      </h1>
      <img v-if="user.photo" class="block ml-4 w-8 h-8 rounded-full" :src="user.photo" />
    </div>
    <trashed-message v-if="user.deleted_at" class="mb-6" @restore="restore"> This user has been deleted {{ deleted_at }}. </trashed-message>
    <div class="max-w-3xl bg-white rounded-md shadow overflow-hidden">
      <form @submit.prevent="update">
        <div class="flex flex-wrap -mb-8 -mr-6 p-8">
          <text-input v-model="form.name" :error="form.errors.name" class="pb-8 pr-6 w-full lg:w-1/2" label="Name" />
          <text-input v-model="form.email" :error="form.errors.email" class="pb-8 pr-6 w-full lg:w-1/2" label="Email" />
          <text-input v-model="form.password" :error="form.errors.password" class="pb-8 pr-6 w-full lg:w-1/2" type="password" autocomplete="new-password" label="Password" />
          <select-input v-model="form.email_verified_at" :error="form.errors.email_verified_at" class="pb-8 pr-6 w-full lg:w-1/2" label="Email verified">
            <option :value="true">Ja</option>
            <option :value="false">Nej</option>
          </select-input>
          <file-input v-model="form.photo" :error="form.errors.photo" class="pb-8 pr-6 w-full lg:w-1/2" type="file" accept="image/*" label="Photo" />
        </div>
        <div class="flex items-center px-8 py-4 bg-gray-50 border-t border-gray-100">
          <button v-if="!user.deleted_at" class="text-red-600 hover:underline" tabindex="-1" type="button" @click="destroy">Delete User</button>
          <loading-button :loading="form.processing" class="btn-indigo ml-auto" type="submit">Update User</loading-button>
        </div>
      </form>
    </div>    
  </div>
  
  <!-- Inloggningar -->
  <div class="max-w-3xl rounded-md bg-white shadow mt-5 p-8">
    <div class="">
      <h1 class="text-2xl text-gray-600">Senaste inloggningarna ({{user.ip_addresses.length}})</h1>
      <div v-for="(item, index) in user.ip_addresses" v-bind:key="index">
        <span class="underline decoration-dotted">{{ item.address }}</span>, {{ last_sign_in(item.created_at) }}<br>
      </div>
    </div>
</div>

</template>

<script>
import { Head, Link } from '@inertiajs/inertia-vue3'
import Layout from '@/Shared/Layout'
import TextInput from '@/Shared/TextInput'
import FileInput from '@/Shared/FileInput'
import SelectInput from '@/Shared/SelectInput'
import LoadingButton from '@/Shared/LoadingButton'
import TrashedMessage from '@/Shared/TrashedMessage'
import dayjs from 'dayjs'
import relativeTime from 'dayjs/plugin/relativeTime'
dayjs.extend(relativeTime)

export default {
  components: {
    FileInput,
    Head,
    Link,
    LoadingButton,
    SelectInput,
    TextInput,
    TrashedMessage,
  },
  layout: Layout,
  props: {
    user: Object,
  },
  remember: 'form',
  computed:{
    deleted_at: function(){
      return dayjs(this.user.deleted_at)
    },
    current_time: function(){
      return dayjs().format()
    }
  },
  data() {
    return {
      form: this.$inertia.form({
        _method: 'put',
        name: this.user.name,
        email: this.user.email,
        email_verified_at: this.user.email_verified_at ? true : false,
        password: '',
        photo: null,
      }),
    }
  },
  methods: {
    update() {
      this.form.post(`/users/${this.user.id}`, {
        onSuccess: () => this.form.reset('password', 'photo'),
      })
    },
    destroy() {
      if (confirm('Are you sure you want to delete this user?')) {
        this.$inertia.delete(`/users/${this.user.id}`)
      }
    },
    restore() {
      if (confirm('Are you sure you want to restore this user?')) {
        this.$inertia.put(`/users/${this.user.id}/restore`)
      }
    },
    last_sign_in(created_at){
      return dayjs(created_at).fromNow()
    }
  },
}
</script>
