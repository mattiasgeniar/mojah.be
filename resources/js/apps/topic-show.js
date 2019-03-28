require('../bootstrap');

window.Vue = require('vue');

import TopicShow from './../components/TopicShow'

const app = new Vue({
    el: '#app',

    components: {
        TopicShow,
    },
});
