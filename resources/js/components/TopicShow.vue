<template>
    <div>
        <topic-message
            v-for="(message, index) in messages"
            :key="`message-${index}`"
            :message="message"
        ></topic-message>
    </div>
</template>

<script>
import TopicMessage from './TopicMessage'

export default {

    components: {
        TopicMessage,
    },

    props: ['topic'],

    data: () => ({
        messages: [],
    }),

    created() {
        this.getMessages()
    },
    
    methods: {
        getMessages() {
            axios.get(this.topic.messages_api_url)
                .then(response => {
                    this.$set(this, 'messages', response.data)
                })
        },
    },

}
</script>

<style scoped>

</style>
