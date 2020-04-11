<template>
    <div class="admin-panel">
        <div class="admin-panel__top">
            <div class="top__left">
                <button>Моя статья</button>
                <button>Черновики</button>
            </div>
            <div class="top__right">
                <router-link to="/article-editor">
                    <button-comp class="admin-panel__button">Добавить статью <i class="fas fa-plus"></i></button-comp>
                </router-link>
                <router-link to="/edit-page">
                    <button-comp class="admin-panel__button">Редактировать сайт <i class="fas fa-edit"></i></button-comp>
                </router-link>
            </div>
        </div>
        <div class="admin-panel__filters">
            <input-comp v-model="search" :placeholder="'Поиск'"/>
        </div>
        <div class="admin-panel__news">
            <news-list/>
        </div>
    </div>
</template>

<script>
    import Button from '../../components/UI/Button'
    import NewsList from "../../components/NewsList"
    import Input from "../../components/UI/Input"

    export default {
        components: {
            'button-comp': Button,
            'news-list': NewsList,
            'input-comp': Input
        },
        created() {

        },
        data() {
            return {
                search: ''
            }
        },
        methods: {},
        computed: {},
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
    }

    .top {
        &__left {
            @include flex(flex-start, center, row);
        }
    }
</style>