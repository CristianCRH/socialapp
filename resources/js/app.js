require('./bootstrap')
import {createApp} from 'vue'   
import mitt from 'mitt'
import auth from './mixins/auth'

const emitter = mitt()

const  app = createApp({
    
})
app.config.globalProperties.emitter = emitter
app.component('status-form', require('./components/StatusForm.vue').default);
app.component('status-list', require('./components/StatusList.vue').default);

app.mixin(auth)

app.mount("#app")

/*require('./bootstrap');

window.Vue = require('vue').default;


Vue.component('status-form', require('./components/StatusForm.vue').default);
Vue.component('statuses-list', require('./components/StatusesList.vue').default);


const app = new Vue({
    el: '#app',
});
*/