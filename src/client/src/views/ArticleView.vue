<template>
    <div class="article">
        <h1 class="article__title">{{ article.title }}</h1>
        <div class="article__info">
            <span class="article__date">{{article.publicationDate | moment("LLL")}}</span>
            <span> · </span>
            <span>{{article.authorId}}</span>
        </div>
        <div class="article__general-material" >
            <div class="article__text" v-if="article.text" v-html="article.text">

            </div>
<!--            <p class="article__block-p">{{article.text}}</p>-->
<!--            <p class="article__block-p">{{article.text}}</p>-->
            <social-sharing url="https://vuejs.org/"
                            title="The Progressive JavaScript Framework"
                            description="Intuitive, Fast and Composable MVVM for building interactive interfaces."
                            quote="Vue is a progressive framework for building user interfaces."
                            hashtags="vuejs,javascript,framework"
                            inline-template>
                <div class="article__sharing">
                    <network style="padding: 0 10px; border-right: 1px solid #bebebe; cursor:pointer;" network="facebook">
                        <i class="fab fa-facebook"></i>
                    </network>
                    <network style="padding: 0 10px; border-right: 1px solid #bebebe; cursor:pointer;" network="odnoklassniki">
                        <i class="fab fa-odnoklassniki"></i>
                    </network>
                    <network style="padding: 0 10px; border-right: 1px solid #bebebe; cursor:pointer;" network="telegram">
                        <i class="fab fa-telegram"></i>
                    </network>
                    <network style="padding: 0 10px; border-right: 1px solid #bebebe; cursor:pointer;" network="twitter">
                        <i class="fab fa-twitter"></i>
                    </network>
                    <network style="padding: 0 10px; border-right: 1px solid #bebebe; cursor:pointer;" network="vk">
                        <i class="fab fa-vk"></i>
                    </network>
                </div>
            </social-sharing>
        </div>
    </div>
</template>

<script>
    import {mapState} from 'vuex'

    export default {
        created() {
            this.article = this.newsModule.newsList.find(el => el.id === +this.newsId)
            document.title = this.article.title
        },
        data() {
            return {
                newsId: this.$route.params.id,
                article: null
            }
        },
        computed: {
            ...mapState(['newsModule'])
        }
    }
</script>

<style lang="scss">
    .article {
        padding-top: 20px;

        &__title {
            font-family: "Times New Roman", Serif;
            margin-bottom: 15px;
            font-size: 36px;
            line-height: 40px;
        }

        &__text {
            p {
                font-family: "Times New Roman", Serif !important;
                margin: 0 0 20px !important;
                font-size: 20px !important;
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
            margin-bottom: 30px;
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