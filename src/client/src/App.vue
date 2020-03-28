<template>
    <div class="app">
        <page-header
                :color="pageModule.publisher.mainColor"
                :title="pageModule.publisher.title"
        />
        <rubrics
                v-if="isAdminPage"
                :color="pageModule.publisher.mainColor"
                :accent-color="pageModule.publisher.accentColor"
                :rubrics="pageModule.publisher.rubrics"
        />
        <div class="app__container container">
            <router-view/>
        </div>
    </div>
</template>

<script>
    import Header from './components/Global/Header.vue';
    import Rubrics from "./components/Global/Rubrics"
    import {mapState} from "vuex"

    export default {
        components: {
            'page-header': Header,
            'rubrics': Rubrics
        },
        created() {

        },
        data() {
            return {}
        },
        computed: {
            ...mapState(['pageModule']),
            isAdminPage() {
                return this.$route.name === 'AllFeed' || this.$route.name === 'RubricFeed' || this.$route.name === 'ArticleView'
            }
        }
    }
</script>

<style lang="scss">
    @import "./scss/reset.scss";

    .app {
        font-family: Avenir, Helvetica, Arial, sans-serif;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;

        &__container {
            height: 100vh;
            padding-top: 20px;
        }
    }

    .container {
        box-sizing: border-box;
        padding: 30px 20px 0 20px;
        @include container;
    }

    a {
        text-decoration: none;
        color: #000;
    }

    .title {
        font-size: 25px;
        font-weight: bold;
    }
</style>
