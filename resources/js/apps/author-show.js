require('../bootstrap');

window.Vue = require('vue');

import AuthorThreads from './../components/AuthorThreads'
import AuthorReplies from './../components/AuthorReplies'

const app = new Vue({
    el: '#app',

    components: {
        AuthorThreads,
        AuthorReplies,
    },
});
