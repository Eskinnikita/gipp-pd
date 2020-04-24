<template>
    <div class="admin-panel">
        <div class="admin-panel__top">
            <div class="admin-panel__rubrics">
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
            <div class="admin-panel__controls">
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
                <input-comp v-model.lazy="search" :placeholder="'Поиск'"/>
            </div>
            <div class="rubrics-filter">
                <v-select v-model="rubric" placeholder="Выберете рубрику" :options="pageModule.publisher.rubrics" label="title"/>
            </div>
        </div>
        <div class="admin-panel__news">
            <news-list :keyword="search.toLowerCase()" :rubric="rubric"/>
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
                rubric: null,
                selectedPanel: 'all',
                shownNews: []
            }
        },
        methods: {
            selectPanel(uri) {
                this.selectedPanel = uri
                this.search = ''
                this.rubric = ''
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
            ...mapState(['pageModule', 'newsModule'])
        },
        watch: {
        }
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

        &__filters {
            padding: 10px 0 5px;
            @include flex(flex-start, center, row);
        }

        &__search {
            @include flex(center, center, row);
            width: 25%;
            margin-right: 25px;
        }

        &__rubrics {
            @include flex(flex-start, center, row);
        }
    }

    .rubrics-filter {
        width: 25%;
    }
</style>