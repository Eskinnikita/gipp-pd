<template>
    <div class="login">
        <input-comp
                label="Почта"
                placeholder="example@mail.ru"
                v-model="name"
                type="text"
        />
        <input-comp
                label="Пароль"
                placeholder="123123"
                v-model="password"
                type="password"
        />
        <button-comp :onClick="goToAdminPanel">Войти</button-comp>
    </div>
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
                name: '',
                password: ''
            }
        },
        methods: {
            goToAdminPanel() {
                this.$router.push('/admin')
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