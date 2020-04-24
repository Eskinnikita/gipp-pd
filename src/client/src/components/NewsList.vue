<template>
    <div class="news-list">
        <template v-if="filteredNews.length">
            <news-item
                    v-for="(newsInfo, index) in filteredNews" :key="index"
                    :news-info="newsInfo"
                    :is-admin-page="true"
            />
        </template>
        <div v-else class="news-list__not-found">
            <h2>Мы ничего не нашли...</h2>
        </div>
    </div>
</template>

<script>
    import NewsItem from "./NewsItem"
    import {mapState} from 'vuex'

    export default {
        components: {
            'news-item': NewsItem
        },
        props: {
            keyword: {
                type: String
            },
            rubric: {
                type: Object
            }
        },
        data() {
            return {}
        },
        computed: {
            ...mapState(['newsModule']),
            rubricUri() {
                return this.rubric ? this.rubric.uri : null
            },
            filteredNews() {
                if (this.keyword || this.rubricUri) {
                    return this.newsModule.adminNews
                        .filter(el => {
                            console.log(this.rubricUri)
                            if(this.rubricUri !== null) {
                                console.log('1')
                                return el.rubricsUri.includes(this.rubricUri)
                            }
                            else {
                                console.log('2')
                                return this.newsModule.adminNews
                            }
                        })
                        .filter(el => {
                            if (this.keyword) {
                                return el.title.toLowerCase().trim().includes(this.keyword.trim()) ||
                                    el.text.toLowerCase().trim().includes(this.keyword.trim())
                            }
                            else {
                                return this.newsModule.adminNews
                            }
                        })
                } else {
                    return this.newsModule.adminNews
                }
            }
        }
    }
</script>

<style lang="scss" scoped>
    .news-list {
        width: 100%;
        margin-top: 15px;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(210px, 1fr));
        grid-gap: 20px;
        grid-auto-flow: dense;

        &__not-found {
            margin-top: 30px;
            @include flex(center, center, row)
        }
    }
</style>