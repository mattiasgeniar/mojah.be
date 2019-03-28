require('../bootstrap');

window.Vue = require('vue');

import AuthorTopicsPaginator from './../components/AuthorTopicsPaginator'
import AuthorMessagesPaginator from './../components/AuthorMessagesPaginator'

const app = new Vue({
    el: '#app',

    components: {
        AuthorTopicsPaginator,
        AuthorMessagesPaginator,
    },
});
