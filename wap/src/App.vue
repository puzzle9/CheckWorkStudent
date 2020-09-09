<template>
  <div class="App">
    <Index />
  </div>
</template>

<script>
  import Index from './views/index.vue'
  export default {
    name: 'App',
    components: {
      Index,
    },
    data() {
      return {}
    },
    mounted() {},
    methods: {},
  }
</script>

<style lang="stylus">
body
  background-color: #f7f8fa
</style>
