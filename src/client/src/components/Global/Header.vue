<template>
    <div class="header" :style="{'backgroundColor': color}">
        <div class="header__container container">
            <div class="header__logo">
                <router-link to="/">
                    <h3 class="link">{{title}}</h3>
                </router-link>
            </div>
            <div class="header__menu">
<!--                <div class="header__search">-->
<!--                    <button-comp v-show="!searchFocused" :on-click="showSearch" :icon="'fas fa-search'"></button-comp>-->
<!--                    <input class="header__search-input" type="text" ref="search" v-show="searchFocused" @blur="searchFocused = false">-->
<!--                </div>-->
                <router-link to="/admin">
                    <a href="#" class="header__admin-button">АДМИН</a>
                </router-link>
            </div>
        </div>
    </div>
</template>

<script>
    // import Button from "../UI/Button"
    export default {
        props: {
            title: {
                type: String,
                required: true
            },
            color: {
                type: String,
                required: true
            }
        },
        components: {
            // 'button-comp': Button
        },
        data() {
            return {
                searchFocused: false
            }
        },
        methods: {
            // findArticles() {
            //
            // },
            // showSearch() {
            //     this.searchFocused = true
            //     setTimeout(() => {
            //         this.$refs.search.focus();
            //     }, 100)
            // }
        },
        computed: {

        }
    }
</script>

<style lang="scss" scoped>
    .header {
        width: 100%;
        height: 70px;
        color: #fff;
        @include flex(space-between, center, row);
        &__logo {
            font-size: 25px;
            font-weight: 600;
        }
        &__container {
            padding-top: 0;
        }
        &__admin-button {
            color: #fff;
            border: 1px solid #fff;
            border-radius: 3px;
            padding: 5px;
        }
        &__search {

        }
        &__menu {
            @include flex(space-between ,center, row)
        }
    }

    .link {
        color: #fff;
    }

    .container {
        @include flex(space-between, center, row);
    }

</style>