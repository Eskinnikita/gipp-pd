<template>
    <div class="admin-panel">
        <div class="admin-panel__top">
            <div class="top__left">
                <rubric-item
                        v-for="(panel, index) in panels"
                        :is-active="checkPanelActive(panel.uri)"
                        @click.native="selectPanel(panel.uri)"
                        :border-color="pageModule.publisher.accentColor"
                        :text-color="'#000'"
                        :key="index"
                >
                    {{panel.title}}
                </rubric-item>
            </div>
            <div class="top__right">
                <router-link to="/article-editor">
                    <button-comp class="admin-panel__button">Добавить статью <i class="fas fa-plus"></i></button-comp>
                </router-link>
                <router-link to="/edit-page">
                    <button-comp class="admin-panel__button">Редактировать сайт <i class="fas fa-edit"></i>
                    </button-comp>
                </router-link>
            </div>
        </div>
        <div class="admin-panel__filters">
            <div class="admin-panel__search">
                <input-comp v-model="search" :placeholder="'Поиск'"/>
            </div>
            <div class="admin-panel__rubrics">
                <v-select v-model="rubric" placeholder="Выберете рубрику" :options="pageModule.publisher.rubrics" label="title"/>
            </div>
        </div>
        <div class="admin-panel__news">
            <news-list/>
        </div>
    </div>
</template>

<script>
    import Button from '../../components/UI/Button'
    import NewsList from "../../components/NewsList"
    import vSelect from "vue-select";
    import Input from "../../components/UI/Input"
    import RubricItem from "../../components/Global/RubricItem"
    import {mapState} from 'vuex'
    import "vue-select/dist/vue-select.css";

    export default {
        components: {
            'button-comp': Button,
            'news-list': NewsList,
            'input-comp': Input,
            'rubric-item': RubricItem,
            'v-select': vSelect
        },
        created() {
            this.$store.commit('GET_PUBLISHED')
        },
        data() {
            return {
                panels: [
                    {
                        uri: 'all',
                        title: 'Мои статьи'
                    },
                    {
                        uri: 'drafts',
                        title: 'Черновики'
                    },
                    {
                        uri: 'authors',
                        title: 'Авторы'
                    }
                ],
                search: '',
                rubric: '',
                selectedPanel: 'all',
                shownNews: []
            }
        },
        methods: {
            selectPanel(uri) {
                this.selectedPanel = uri
                switch (uri) {
                    case 'all':
                        this.$store.commit('GET_PUBLISHED')
                        break;
                    case 'drafts':
                        this.$store.commit('GET_DRAFTS')
                        break;
                    case 'authors':
                        this.$store.commit('GET_AUTHORS_ARTICLES')
                        break;
                }
            },
            checkPanelActive(rubric) {
                return this.selectedPanel === rubric
            }
        },
        computed: {
            ...mapState(['pageModule', 'newsModule']),
            // filteredNews() {
            //     this.shownNews.filter(el => {
            //         return el.title.indexOf(this.search) > -1 || el.rubricsUri.indexOf(this.rubric) > -1
            //     })
            // }
        },
        watch: {}
    }
</script>

<style lang="scss" scoped>
    .admin-panel {
        &__top {
            @include flex(space-between, center, row);
        }

        &__button {
            margin: 0 5px;
        }

        &__news {

        }

        &__filters {
            padding: 10px 0 5px;
            @include flex(space-between, center, row);
        }

        &__search {
            @include flex(center, center, row);
            width: 30%;
            margin-right: 25px;
        }

        &__rubrics {
            width: 25%;
        }
    }

    .top {
        &__left {
            @include flex(flex-start, center, row);
        }
    }
</style>