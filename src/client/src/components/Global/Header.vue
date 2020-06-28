<template>
    <div class="header" :style="{'backgroundColor': color}">
        <div class="header__container container">
            <div class="header__logo">
                <router-link to="/">
                    <h3 class="link">{{title}}</h3>
                </router-link>
            </div>
            <div class="header__menu">
                <router-link v-if="!isAuthenticated" to="/admin">
                    <a href="#" class="header__admin-button">Войти</a>
                </router-link>
                <div class="header__user user" v-if="isAuthenticated">
                    <router-link to="/admin">
                        <a href="#" class="header__admin-button header__admin-button_name">{{userModule.user.name}}</a>
                    </router-link>
                    <button @click="logout" class="user__logout">
                        выйти
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {mapState, mapGetters} from 'vuex'
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
        },
        data() {
            return {
                searchFocused: false
            }
        },
        methods: {
            logout() {
                this.$store.dispatch('logout')
                .then(() => {
                    this.$router.push('/')
                })
            }
        },
        computed: {
            ...mapState(['userModule']),
            ...mapGetters(['isAuthenticated'])
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

            &_name {
                margin-right: 10px;
            }
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

    .user {
        &__logout {
            font-size: 15px;
            background: none;
            border: none;
            color: #fff;
            &:hover {
                text-decoration: underline;
            }
        }
    }

    .container {
        @include flex(space-between, center, row);
    }

</style>