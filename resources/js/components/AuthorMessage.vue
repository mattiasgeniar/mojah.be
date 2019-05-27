<template>
    <div class="bg-white mx-auto max-w-3xl shadow-lg rounded-lg overflow-hidden mb-5 flex">
        <div class="w-full h-10 flex items-center justify-between">
                <div class="ml-4">
                    <a :href="message.message_url" class="text-green-darkest no-underline">
                        <span class="text-sm font-medium">{{ message.message_teaser }}</span>
                    </a>
                </div>

                <div class="text-xs text-grey flex items-center mr-4">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                         class="h-4 w-4 mr-1 feather feather-calendar">
                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                        <line x1="16" y1="2" x2="16" y2="6"></line>
                        <line x1="8" y1="2" x2="8" y2="6"></line>
                        <line x1="3" y1="10" x2="21" y2="10"></line>
                    </svg>
                    <span :title="message.created_at">{{ message.created_at_ago }}</span>
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

<style>

</style>
