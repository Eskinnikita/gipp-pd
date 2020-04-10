<template>
    <article class="news-item" @click="goToArticle(newsInfo.id)">
        <h2 class="news-item__title">{{newsInfo.title}}</h2>
        <p class="news-item__text">{{splicedText(newsInfo.annotation)}}</p>
        <span class="news-item__date">{{ newsInfo.publicationDate | moment("from", "now", true)}} назад</span>
    </article>
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
                if(text) {
                    return text.split('').splice(0, 100).join('') + '...'
                }
            }
        }
    }
</script>

<style lang="scss" scoped>
    .news-item {
        width: 100%;
        cursor: pointer;
        box-sizing: border-box;
        border-radius: $border-radius;
        padding: 15px;
        text-align: left;
        border: 1px solid #bebebe;
        transition: opacity 0.2s;
        @include flex(flex-start, flex-start, column);

        &__text {
            line-height: 20px;
            font-size: 18px;
            font-family: 'Times New Roman', Serif;
        }

        &__title {
            /*font-size: 25px;*/
            margin-bottom: 10px;
            font-weight: bold;
        }

        &__date {
            font-size: 14px;
            margin-top: 10px;
            color: rgba(0,0,0,0.6)
        }

        &:hover {
            opacity: 0.6;
        }
    }

    .router-wrapper {
    }
</style>