<template>
    <form class="login" @submit.prevent="login">
        <input-comp
                label="Почта"
                placeholder="example@mail.ru"
                v-model="user.login"
                type="text"
        />
        <input-comp
                label="Пароль"
                placeholder="123123"
                v-model="user.password"
                type="password"
        />
        <button-comp type="submit">Войти</button-comp>
    </form>
</template>

<script>
    import Input from "../../components/UI/Input"
    import Button from "../../components/UI/Button"

    export default {
        components: {
            'input-comp': Input,
            'button-comp': Button
        },
        data() {
            return {
                user: {
                    login: '',
                    password: ''
                }
            }
        },
        methods: {
            login() {
                this.$store.dispatch('loginUser', this.user)
                .then(() => {
                    this.$router.push('/admin')
                })
            }
        }
    }
</script>

<style lang="scss" scoped>
    .login {
        padding-top: 20px;
        margin: 0 auto;
        width: 360px;
        max-width: 100%;
        @include flex(center, center, column);
    }
</style>