<template>
    <div>
        <div class="bg-white max-w-xl mx-auto mt-8 mb-8">
            <h2>Replies posted by this user</h2>
        </div>

        <div v-if="messagePaginator.total > 0">
            <author-message
                v-for="(message, index) in messagePaginator.data"
                :key="`message-${index}`"
                :message="message"
            ></author-message>

            <div class="w-full h-2"></div>

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

        <div class="h-32 flex items-center justify-center" v-else>
            <span>
                No threads were found.
            </span>
        </div>
    </div>
</template>

<script>
    import Paginate from 'vuejs-paginate'
    import AuthorMessage from './AuthorMessage'

    export default {

        components: {
            paginate: Paginate,
            AuthorMessage,
        },

        props: ['author'],

        data: () => ({
            messagePaginator: {},
        }),

        created() {
            this.goToPage(1)
        },

        computed: {
            totalPages() {
                return this.messagePaginator.last_page || 1
            },
        },

        methods: {
            goToPage(pageNum) {
                axios.get(`/api/v1/authors/${this.author.id}/messages?page=${pageNum}`)
                    .then(response => {
                        this.$set(this, 'messagePaginator', response.data)
                    })
            },
        },

    }
</script>

<style scoped>

</style>
