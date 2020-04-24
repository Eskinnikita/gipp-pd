<template>
    <div class="news-item-wrapper"
         @mouseenter="showControls = true"
         @mouseleave="showControls = false"
    >
        <div class="news-item__controls" v-if="showControls && isAdminPage">
            <button v-if="!newsInfo.isDraft"
                    class="news-item__button"
                    :style="backgroundAccentColor"
                    @click="toggleDraft(newsInfo.id, 'GET_PUBLISHED')"
            >
                В черновики
            </button>
            <button v-else
                    class="news-item__button"
                    :style="backgroundAccentColor"
                    @click="toggleDraft(newsInfo.id, 'GET_DRAFTS')"
            >
                Опубликовать
            </button>
            <div class="news-item__icon-buttons">
                <button class="news-item__button" :style="backgroundAccentColor">
                    <i class="fas fa-pen"></i>
                </button>
                <button class="news-item__button" :style="backgroundAccentColor">
                    <i class="fas fa-trash"></i>
                </button>
            </div>
        </div>
        <article class="news-item"
                 @click="goToArticle(newsInfo.id)"
        >
            <div v-if="newsInfo.previewImage" class="news-item__preview">
                <img :src="newsInfo.previewImage">
            </div>
            <div class="news-item__info">
                <h2 class="news-item__title">{{newsInfo.title}}</h2>
                <p class="news-item__text">{{splicedText(newsInfo.annotation)}}</p>
                <div class="news-item__date">{{ newsInfo.publicationDate | moment("from", "now", true)}} назад</div>
            </div>
        </article>
    </div>
</template>

<script>
    import {mapState} from 'vuex';

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
        data() {
            return {
                showControls: false
            }
        },
        methods: {
            goToArticle(id) {
                this.$router.push(`/news/${id}`)
            },
            splicedText(text) {
                if (text) {
                    return text.split('').splice(0, 100).join('') + '...'
                }
            },
            toggleDraft(id, commit) {
                this.$store.dispatch('toggleDraft', {id, commit})
            }

        },
        computed: {
            ...mapState(['pageModule']),
            backgroundAccentColor() {
                return `background-color: ${this.pageModule.publisher.accentColor}`
            }
        }
    }
</script>

<style lang="scss" scoped>
    .news-item-wrapper {
        position: relative;
    }

    .news-item {
        position: relative;
        min-height: 150px;
        width: 100%;
        cursor: pointer;
        box-sizing: border-box;
        text-align: left;
        transition: opacity 0.2s;
        @include flex(flex-start, flex-start, column);

        &__button {
            cursor: pointer;
            font-size: 15px;
            border: none;
            color: #fff;
            box-sizing: border-box;
            padding: 10px;
            border-radius: $border-radius;
            margin: 0 5px;
            transition: transform 0.2s;

            &:hover {
                transform: scale(1.04);
            }
        }

        &__controls {
            @include flex(space-between, center, row);
            position: absolute;
            box-sizing: border-box;
            padding: 5px 10px;
            z-index: 1000;
            top: 0;
            left: 0;
            width: 100%;
            height: 70px;
            background-color: rgba(0, 0, 0, 0.8);
        }

        &__text {
            line-height: 20px;
            font-size: 18px;
            font-family: 'Times New Roman', Serif;
        }

        &__preview {
            width: 100%;
            height: 240px;

            img {
                border-right: 1px solid #bebebe;
                border-left: 1px solid #bebebe;
                border-top: 1px solid #bebebe;
                box-sizing: border-box;
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
            color: rgba(0, 0, 0, 0.6)
        }

        &:hover {
            opacity: 0.6;
        }
    }

    .router-wrapper {
    }
</style>