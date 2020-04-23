<template>
    <article class="news-item" @click="goToArticle(newsInfo.id)">
        <div v-if="newsInfo.previewImage" class="news-item__preview">
            <img :src="newsInfo.previewImage" >
        </div>
        <div class="news-item__info">
            <h2 class="news-item__title">{{newsInfo.title}}</h2>
            <p class="news-item__text">{{splicedText(newsInfo.annotation)}}</p>
            <span class="news-item__date">{{ newsInfo.publicationDate | moment("from", "now", true)}} назад</span>
        </div>
    </article>
</template>

<script>
    export default {
        props: {
            newsInfo: {
                required: true,
                type: Object
            },
            isAdminPage: {
                type: Boolean
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
        min-height: 150px;
        width: 100%;
        cursor: pointer;
        box-sizing: border-box;
        text-align: left;
        /*transition: opacity 0.2s;*/
        @include flex(flex-start, flex-start, column);

        &__text {
            line-height: 20px;
            font-size: 18px;
            font-family: 'Times New Roman', Serif;
        }

        &__preview {
            height: 240px;
            img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                border-top-left-radius: $border-radius;
                border-top-right-radius: $border-radius;
            }
        }

        &__info {
            height: 100%;
            border: 1px solid #bebebe;
            box-sizing: border-box;
            width: 100%;
            padding: 15px;
            border-bottom-left-radius: $border-radius;
            border-bottom-right-radius: $border-radius;
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