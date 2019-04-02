<template>
    <div class="bg-white mx-auto max-w-lg shadow-lg rounded-lg overflow-hidden mb-5">
        <div class="h-16 px-2 flex items-center justify-between">
            <div class="ml-2">
                <a :href="topic.topic_url" class="text-black no-underline">
                    <span class="font-medium">{{ topic.topic }}</span>
                </a>
            </div>

            <div class="mr-2">
                <div class="text-xs text-grey flex items-center ">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                         class="h-4 w-4 mr-1 feather feather-calendar">
                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                        <line x1="16" y1="2" x2="16" y2="6"></line>
                        <line x1="8" y1="2" x2="8" y2="6"></line>
                        <line x1="3" y1="10" x2="21" y2="10"></line>
                    </svg>

                    <span :title="topic.created_at_ago">
                        {{ topic.created_at_ago }}
                    </span>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {

    props: ['topic'],

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
