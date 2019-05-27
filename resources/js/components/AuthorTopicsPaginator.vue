<template>
    <div>
        <div class="bg-white max-w-3xl mx-auto mt-8 mb-8">
            <h2>Threads started by this user</h2>
        </div>

        <div v-if="topicPaginator.total > 0">
            <topic-list-item
                v-for="(topic, index) in topicPaginator.data"
                :key="`topic-${index}`"
                :topic="topic"
            ></topic-list-item>

            <div class="w-full h-2"></div>

            <paginate
                :pageCount="totalPages"
                :clickHandler="goToPage"
                prevText="Prev"
                nextText="Next"
                containerClass="pagination flex items-center list-reset mt-5 mb-4"
                active-class="bg-blue text-white px-2 py-1 rounded"
            >
            </paginate>
        </div>

        <div class="h-32 flex items-center justify-center" v-else>
            <span>
                No threads were found.
            </span>
        </div>
    </div>
</template>

<script>
import Paginate from 'vuejs-paginate'
import TopicListItem from './TopicListItem'

export default {

    components: {
        paginate: Paginate,
        TopicListItem,
    },

    props: ['author'],

    data: () => ({
        topicPaginator: {},
    }),

    created() {
        this.goToPage(1)
    },

    computed: {
        totalPages() {
            return this.topicPaginator.last_page || 1
        },
    },

    methods: {
        goToPage(pageNum) {
            axios.get(`/api/v1/authors/${this.author.id}/topics?page=${pageNum}`)
                .then(response => {
                    this.$set(this, 'topicPaginator', response.data)
                })
        },
    },

}
</script>

<style>

.pagination > li {
    margin-left: 20px;
}

.pagination > li:focus {
    outline: none;
}

</style>
