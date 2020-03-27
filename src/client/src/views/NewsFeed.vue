<template>
    <div class="news-feed">
        <template v-if="newsModule.shownNews.length">
            <news-item
                    v-for="(newsInfo, index) in newsModule.shownNews"
                    :key="index"
                    :news-info="newsInfo"
            />
<!--            <div-->
<!--                 class="news-block"-->
<!--                 v-for="(newsItem, index) in newsModule.shownNews"-->
<!--                 :key="index"-->
<!--            >-->
<!--                <router-link :to="{path:`/news/${newsItem.id}`}">-->
<!--                    {{newsItem.title}}-->
<!--                </router-link>-->
<!--            </div>-->
        </template>
        <template v-else>
            А новостей-то и нет вовсе
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
                const rubric = this.pageModule.publisher.rubrics.find(el => el.uri === this.$route.params.name)
                this.$store.commit('GET_RUBRIC_NEWS', rubric.id)
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
        @include flex(flex-start, center, row);
        flex-wrap: wrap;
    }
    .news-block {
        flex: 1;
        padding: 20px;
        box-sizing: border-box;
        width: 25%;
        height: 200px;
        border: 1px solid #bebebe;
        font-size: 30px;
        font-weight: 600;
        margin: 20px;
    }
</style>