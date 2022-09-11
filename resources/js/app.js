import './bootstrap';

import { createApp } from 'vue/dist/vue.esm-bundler.js';

import AppComponent from './vue/app.vue';

/* import the fontawesome core */
import { library } from '@fortawesome/fontawesome-svg-core'

/* import font awesome icon component */
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

/* import specific icons */
import { faPlus, faRemove, faSave, faSpinner } from '@fortawesome/free-solid-svg-icons'

/* add icons to the library */
library.add(faPlus, faRemove, faSave, faSpinner)

const app = createApp(AppComponent)
                .component('font-awesome', FontAwesomeIcon)
                .mount('#app');