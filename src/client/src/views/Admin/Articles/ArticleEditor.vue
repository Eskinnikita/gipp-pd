<template>
    <div>
        <input-comp  label="Название статьи"/>
        <label>
            Текст статьи <br/>
            <textarea style="width: 100%; min-height: 300px;"></textarea>
        </label>
        <button-comp>Опубликовать</button-comp>
    </div>
</template>

<script>
    import Input from "../../../components/UI/Input"
    import Button from "../../../components/UI/Button"

    export default {
        components: {
            'input-comp': Input,
            'button-comp': Button
        },
        data() {
            return {

            }
        },
        methods: {

        }
    }
</script>

<style scoped>

</style>