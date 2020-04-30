<template>
    <div class="article">
        <h1 class="article__title" v-if="article.title">{{ article.title }}</h1>
        <div class="article__info">
            <span class="article__date">{{article.publicationDate | moment("LLL")}}</span>
            <span> · </span>
            <span>{{article.authorId}}</span>
        </div>
        <div class="article__general-material" >
            <div class="article__text" v-if="article.text" v-html="article.text"></div>
            <social-sharing-comp :url="url" :article="article"/>
        </div>
    </div>
</template>

<script>
    import {mapState} from 'vuex'
    import SocialSharing from "../components/SocialSharing"
    export default {
        components: {
            'social-sharing-comp': SocialSharing
        },
        created() {
            this.url = window.location.href
            this.article = this.newsModule.newsList.find(el => el.id === +this.newsId)
            document.title = this.article.title
        },
        mounted() {
        },
        data() {
            return {
                newsId: this.$route.params.id,
                article: null,
                url: null
            }
        },
        methods: {

        },
        computed: {
            ...mapState(['newsModule'])
        }
    }
</script>

<style lang="scss">
    .article {
        padding-top: 10px;
        &__title {
            margin-bottom: 15px;
            font-size: 36px;
            line-height: 40px;
            max-width: 700px;
        }

        &__text {
            font-family: "Times New Roman", Serif !important;
            p {
                line-height: 1.15em;
                margin: 0 0 20px !important;
                font-size: 20px !important;
                word-break: break-word;
            }

            a {
                font-weight: 600;
            }

            img {
                width: 100%;
                border-radius: $border-radius;
            }

            iframe {
                width: 100%;
                height: 350px;
            }

            blockquote {
                border-left: 4px solid #bebebe;
                padding-left: 5px;
                font-size: 18px;
            }

            .media {
                height: 360px;
                margin: 25px 0 20px;
            }
        }

        &__block-p {
            font-family: "Times New Roman", Serif;
            margin: 0 0 20px;
            font-size: 20px;
            line-height: 28px;
        }

        &__general-material {
            max-width: 650px;
        }

        &__info {
            font-size: 14px;
            color: rgba(0, 0, 0, 0.6);
            margin-bottom: 20px;
        }

        &__sharing {
            border-top: 1px solid #bebebe;
            padding: 15px 0;
            display: flex;
            justify-content: flex-start;
            font-size: 20px;
        }


    }
</style>