<template>
    <div>
        <router-link to="/article-editor">
            <button-comp>Назад к редактору</button-comp>
        </router-link>
    </div>
</template>

<script>
    import Button from "../../../components/UI/Button"

    export default {
        components: {
            'button-comp': Button
        }
    }
</script>

<style scoped>

</style>