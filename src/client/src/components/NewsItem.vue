<template>
        <div class="news-item" @click="goToArticle(newsInfo.id)">
                <h2 class="news-item__title">{{newsInfo.title}}</h2>
                <p>{{splicedText(newsInfo.text)}}</p>
        </div>
</template>

<script>
    export default {
        props: {
            newsInfo: {
                required: true,
                type: Object
            }
        },
        methods: {
            goToArticle(id) {
                this.$router.push(`/news/${id}`)
            },
            splicedText(text) {
                return text.split(' ').splice(0, 10).join(' ') + '...'
            }
        }
    }
</script>

<style lang="scss" scoped>
    .news-item {
        width: calc(100% / 3 - 20px);
        cursor: pointer;
        box-sizing: border-box;
        border-radius: $border-radius;
        padding: 10px 20px 20px 20px;
        margin: 0 0 30px 0;
        text-align: left;
        &__title {
            font-size: 25px;
            margin-bottom: 10px;
            font-weight: bold;
        }
        &:hover &__title{
            text-decoration: underline;
        }
    }

    .router-wrapper {
    }
</style>