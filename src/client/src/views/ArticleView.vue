<template>
    <div class="article">
        <h1 class="article__title">{{ news.title }}</h1>
        <p class="article__text">{{news.text}}</p>
    </div>
</template>

<script>
    import {mapState} from 'vuex'

    export default {
        created() {
            this.news = this.newsModule.newsList.find(el => el.id === +this.newsId)
        },
        data() {
            return {
                newsId: this.$route.params.id,
                news: null
            }
        },
        computed: {
            ...mapState(['newsModule'])
        }
    }
</script>

<style lang="scss" scoped>
    .article {
        &__title {
            font-size: 30px;
            font-weight: 600;
            margin-bottom: 20px;
        }

        &__text {
            font-family: "Times New Roman";
            font-size: 20px;
        }
    }
</style>