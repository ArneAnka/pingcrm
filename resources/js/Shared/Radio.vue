<template>
<div class="text-xl">
  <slot />
</div>
  <div v-for="(choice, index) in answers" v-bind:key="choice.id">
    <div>
      <input type="radio" :id="choice.id" :value="choice.correct" :checked="choice.correct" @change="onChange(index)" />
      <label class="ml-1" for="one">{{ choice.choice}}</label>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    choices: Object
  },
  mounted(){
    this.choices.map((choice) => {
      this.answers.push(choice)
    })
  },
  data(){
    return {
      answers: []
    }
  },
  methods:{
    onChange: function(index){
      this.answers.map((choice) => {
        choice.correct = false
      })
      this.answers[index].correct = true
    }
  }
}

</script>
