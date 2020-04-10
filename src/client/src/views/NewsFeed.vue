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
            <div class="news-feed__not-found">
                <h2>К сожалению, мы не нашли новостей для данной рубрики... <i class="fas fa-pencil-alt"></i></h2>
                <router-link to="/article-editor">
                    <button-comp class="news-feed__add-news">Добавить новость</button-comp>
                </router-link>
            </div>
        </template>
    </div>
</template>

<script>
    import {mapState} from 'vuex';
    import NewsItem from "../components/NewsItem"
    import Button from "../components/UI/Button"
    export default {
        components: {
            'news-item': NewsItem,
            'button-comp': Button
        },
        created() {
            if(this.$route.path === '/') {
                this.$store.commit('GET_ALL_NEWS')
            }
            else {
                const rubricName = this.$route.params.name
                this.$store.commit('GET_RUBRIC_NEWS', rubricName)
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
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(210px, 1fr));
        grid-gap: 20px;
        grid-auto-flow: dense;
        &__not-found {
            padding-top: 20px;
            text-align: center;
        }
    }

    .news-item:nth-child(1) {
        grid-column: 1/3;
    }

    .news-item:nth-child(3) {
        grid-column: 1/3;
    }

    @media (max-width: 576px) {
        .news-feed {
            display: flex;
            flex-direction: column;
        }

        .news-item {
            margin-bottom: 20px;
        }
    }



</style>