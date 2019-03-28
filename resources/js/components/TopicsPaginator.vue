<template>
    <div>
        <topic-list-item
            v-for="(topic, index) in topicPaginator.data"
            :key="`topic-${index}`"
            :topic="topic"
        >
        </topic-list-item>



        <paginate
            :pageCount="totalPages"
            :clickHandler="goToPage"
            prevText="Prev"
            nextText="Next"
            containerClass="pagination flex items-center list-reset mt-5"
            active-class="bg-blue text-white px-2 py-1 rounded"
        >
        </paginate>
    </div>
</template>

<script>
import Paginate from 'vuejs-paginate'
import TopicListItem from './TopicListItem'

export default {

    components: {
        paginate: Paginate,
        TopicListItem
    },

    props: ['initialTopicPaginator', 'mailingListSlug'],

    data: () => ({
        topicPaginator: {},
    }),

    mounted() {
        this.$set(this, 'topicPaginator', this.initialTopicPaginator)
    },

    computed: {
        totalPages() {
            return this.topicPaginator.last_page || 1
        },
    },

    methods: {
        goToPage(pageNum) {
            axios.get(`/api/v1/mailing-lists/${this.mailingListSlug}?page=${pageNum}`)
                .then(response => {
                    this.$set(this, 'topicPaginator', response.data)
                })
        },
    },

}
</script>

<style >

.pagination > li {
    margin-left: 20px;
}

.pagination > li:focus {
    outline: none;
}
</style>
