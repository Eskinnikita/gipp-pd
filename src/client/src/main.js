import Vue from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'
import Tabs from 'vue-tabs-component';
import Vuelidate from 'vuelidate'
const moment = require('moment')

Vue.use(Tabs);
Vue.use(Vuelidate)
require('moment/locale/ru')

Vue.use(require('vue-moment'), {
  moment
})


export default function transliterate(word){
  const a = {"Ё":"YO","Й":"I","Ц":"TS","У":"U","К":"K","Е":"E","Н":"N","Г":"G","Ш":"SH","Щ":"SCH","З":"Z","Х":"H","Ъ":"'","ё":"yo","й":"i","ц":"ts","у":"u","к":"k","е":"e","н":"n","г":"g","ш":"sh","щ":"sch","з":"z","х":"h","ъ":"'","Ф":"F","Ы":"I","В":"V","А":"a","П":"P","Р":"R","О":"O","Л":"L","Д":"D","Ж":"ZH","Э":"E","ф":"f","ы":"i","в":"v","а":"a","п":"p","р":"r","о":"o","л":"l","д":"d","ж":"zh","э":"e","Я":"Ya","Ч":"CH","С":"S","М":"M","И":"I","Т":"T","Ь":"'","Б":"B","Ю":"YU","я":"ya","ч":"ch","с":"s","м":"m","и":"i","т":"t","ь":"'","б":"b","ю":"yu"};
  return word.split('').map(function (char) {
    return a[char] || char;
  }).join("");
}


const SocialSharing = require('vue-social-sharing');
Vue.use(SocialSharing);

Vue.config.productionTip = false

new Vue({
  router,
  store,
  render: h => h(App)
}).$mount('#app')
