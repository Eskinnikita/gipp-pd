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
        <div v-show="!isLoading" class="container app__container">
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

    .container {
        box-sizing: border-box;
        padding: 30px 20px 0 20px;
        @include container;
    }

    .app {
        font-family: Avenir, Helvetica, Arial, sans-serif;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;

        &__container {
            padding-bottom: 40px;
        }
    }

    .view-container {
        max-width: 750px;
        margin: 0 auto;
        padding-bottom: 40px;
    }

    a {
        text-decoration: none;
        color: #000;
    }

    .button {
        height: 40px;
        text-align: center;
        /*width: 100%;*/
        border: none;
        background: none;
        color: #fff;
        margin: 10px 5px;
        padding: 10px 15px;
        box-sizing: border-box;
        border-radius: $border-radius;
        font-size: 15px;
        &:hover {
            cursor: pointer;
        }
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

    .required-sign {
        color: red;
    }

    .invalid {
        border: 1px solid red !important;
    }

    .toast {
        font-family: 'Open Sans', sans-serif;
        background-color: #fff !important;
        &-success {
            color: #000 !important;
        }
        &-error {
            color: red !important;
        }
    }

</style>
