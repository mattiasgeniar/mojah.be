<template>
    <div>

        <a :name="message.id"></a>

        <div class="bg-white max-w-xl mx-auto my-8 border border-grey-light rounded">
            <div class="flex pt-4 px-4">
                <div class="w-16 mr-2">
                    <img class="p-2 rounded rounded-full" :src="message.author.gravatar">
                </div>

                <div class="px-2 pt-2 flex-grow w-full">
                    <header>
                        <a :href="message.author.author_url" class="text-black no-underline">
                            <span class="font-medium">{{ message.author.display_name }}</span>
                        </a>

                        <div class="text-xs text-grey flex items-center my-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                 class="h-4 w-4 mr-1 feather feather-calendar">
                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                <line x1="16" y1="2" x2="16" y2="6"></line>
                                <line x1="8" y1="2" x2="8" y2="6"></line>
                                <line x1="3" y1="10" x2="21" y2="10"></line>
                            </svg>
                            <span>{{ message.created_at }} ({{ message.created_at_ago }})</span>
                        </div>

                    </header>

                    <article
                        class="py-4 text-grey-darkest break-words flex-wrap leading-normal text-lg"
                        v-html="message.message_body"
                    >
                    </article>

                </div>
            </div>
        </div>

    </div>
</template>

<script>
export default {

    props: ['message'],

    data: () => ({
    
    }),

    mounted() {
    
    },
    
    methods: {
    
    },

}
</script>

<style scoped>

</style>
