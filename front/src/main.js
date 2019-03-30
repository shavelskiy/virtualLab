import Vue from 'vue'
import App from './App.vue'
import VueResources from 'vue-resource'

Vue.use(VueResources)

new Vue({
  el: '#app',
  render: h => h(App)
})
