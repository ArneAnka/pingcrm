<template>
  <div :class="$attrs.class">
    <label v-if="label" class="form-label" :for="id">{{ label }}:</label>
    <textarea :id="id" @keyup="resize" ref="input" v-bind="{ ...$attrs, class: null }" class="form-textarea" :class="{ error: error }" :value="modelValue" @input="$emit('update:modelValue', $event.target.value)" />
    <div v-if="error" class="form-error">{{ error }}</div>
  </div>
</template>

<script>
import { v4 as uuid } from 'uuid'
import ResizetextareaVue from './Resizetextarea.vue'

export default {
  inheritAttrs: false,
  components:{
    ResizetextareaVue
  },
  props: {
    id: {
      type: String,
      default() {
        return `textarea-input-${uuid()}`
      },
    },
    error: String,
    label: String,
    modelValue: String,
  },
  mounted(){
    this.resize()
  },
  emits: ['update:modelValue'],
  methods: {
    focus() {
      this.$refs.input.focus()
    },
    select() {
      this.$refs.input.select()
    },
    resize() {
      const { input } = this.$refs;
      input.style.height = 'auto'
      input.style.height = `${input.scrollHeight + 2}px`
    }
  },
}
</script>
