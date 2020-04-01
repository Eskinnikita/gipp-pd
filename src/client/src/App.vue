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
        <div v-show="isLoading" class="loading">
            <loader :color="pageModule.publisher.accentColor"/>
            <h2 class="loading__message">{{loaderMessage}}</h2>
        </div>
        <div v-show="!isLoading" class="app__container container">
            <router-view/>
        </div>
    </div>
</template>

<script>
    import Header from './components/Global/Header.vue';
    import Rubrics from "./components/Global/Rubrics"
    import ScaleLoader from 'vue-spinner/src/ScaleLoader.vue'
    import {mapState} from "vuex"

    export default {
        components: {
            'page-header': Header,
            'rubrics': Rubrics,
            'loader': ScaleLoader
        },
        created() {

        },
        data() {
            return {}
        },
        computed: {
            ...mapState(['pageModule', 'isLoading', 'loaderMessage']),
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

    .loading {
        display: flex;
        flex-direction: column;
        align-items: center;
        padding-top: 17%;
        &__message {
            margin-top: 30px;
        }
    }

</style>
