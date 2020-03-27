<template>
    <div class="admin-panel">
        <div class="admin-panel__top">
            <div class="top__left">
<!--                <router-link to="/article-editor">-->
<!--                    <button-comp :href="'#'">Мои статьи</button-comp>-->
<!--                </router-link>-->
<!--                <router-link to="/article-editor">-->
<!--                    <button-comp :href="'#'">Черновики</button-comp>-->
<!--                </router-link>-->
            </div>
            <div class="top__right">
                <router-link to="/article-editor">
                    <button-comp :href="'#'">добавить статью</button-comp>
                </router-link>
            </div>
        </div>
    </div>
</template>

<script>
    import Button from '../../components/UI/Button'

    export default {
        components: {
            'button-comp': Button
        },
        created() {

        },
        data() {
            return {}
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
    }

    .top {
        &__left {
            @include flex(flex-start, center, row);
        }
    }
</style>