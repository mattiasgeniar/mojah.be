require('../bootstrap');

window.Vue = require('vue');

import TopicsPaginator from './../components/TopicsPaginator'

const app = new Vue({
    el: '#app',

    components: {
        TopicsPaginator,
    },
});
