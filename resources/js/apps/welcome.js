require('../bootstrap');

window.Vue = require('vue');

import BaseCard from './../components/BaseCard'

const app = new Vue({
    el: '#app',

    components: {
        BaseCard,
    },
});
