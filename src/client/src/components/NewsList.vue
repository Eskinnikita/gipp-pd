<template>
    <div class="news-list">
        <template>
            <news-item
                    v-for="(newsInfo, index) in newsModule.newsList" :key="index"
                    :news-info="newsInfo"
                    :is-admin-page="true"
            />
        </template>
    </div>
</template>

<script>
    import NewsItem from "./NewsItem"
    import {mapState} from 'vuex'
    export default {
        components: {
            'news-item': NewsItem
        },
        data() {
            return {
            }
        },
        computed: {
            ...mapState(['newsModule']),

        }
    }
</script>

<style scoped>
    .news-list {
        width: 100%;
        margin-top: 15px;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(210px, 1fr));
        grid-gap: 20px;
        grid-auto-flow: dense;
    }
</style>