<template>
    <div class="news-feed">
        <template v-if="newsModule.shownNews.length">
            <news-item
                    v-for="(newsInfo, index) in newsModule.shownNews"
                    :key="index"
                    :news-info="newsInfo"
            />
        </template>
        <template v-else>
            <h1>К сожалению, мы не нашли новостей для данной рубрики...</h1>
        </template>
    </div>
</template>

<script>
    import {mapState} from 'vuex';
    import NewsItem from "../components/NewsItem"
    export default {
        components: {
            'news-item': NewsItem
        },
        created() {
            console.log(this.$route)
            if(this.$route.path === '/') {
                this.$store.commit('GET_ALL_NEWS')
            }
            else {
                console.log(this.$route.params.name)
                // const rubric = this.pageModule.publisher.rubrics.find(el => el.uri === this.$route.params.name)
                this.$store.commit('GET_RUBRIC_NEWS', this.$route.params.name)
            }
        },
        data() {
            return {}
        },
        computed: {
            ...mapState(['newsModule', 'pageModule'])
        },
    }
</script>

<style lang="scss" scoped>
    .news-feed {
        width: 100%;
        display: flex;
        flex-wrap: wrap;
    }
</style>