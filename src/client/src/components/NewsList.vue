<template>
    <div class="news-list">
        <template v-if="newsModule.adminNews.length">
            <news-item
                    v-for="(newsInfo, index) in newsModule.adminNews" :key="index"
                    :news-info="newsInfo"
                    :is-admin-page="true"
            />
        </template>
        <div v-else class="news-list__not-found">
            <h2>Мы ничего не нашли</h2>
        </div>
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
            ...mapState(['newsModule'])
        }
    }
</script>

<style lang="scss" scoped>
    .news-list {
        width: 100%;
        margin-top: 15px;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(210px, 1fr));
        grid-gap: 20px;
        grid-auto-flow: dense;
        &__not-found {
            margin-top: 30px;
            @include flex(center, center, row)
        }
    }
</style>