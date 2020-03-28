<template>
    <div class="page-edit">
        <div class="page-edit__block">
            <h1 class="title page-edit__title">Изменение названия:</h1>
            <input-comp label="Название издания" v-model="pageChanges.title"/>
        </div>
        <div class="page-edit__block">
            <h1 class="title page-edit__title">Добавление рубрик:</h1>
            <div class="page-edit__rubrics-container">
                <div
                        :style="{'backgroundColor': pageModule.publisher.mainColor}"
                        class="page-edit__rubric rubric"
                        v-for="(rubric, index) in pageChanges.rubrics"
                        :key="index"
                >
                    <span>{{rubric.title}}</span>
                    <button @click="removeRubric(index)" class="rubric__delete-button"
                            :style="{'backgroundColor': pageModule.publisher.accentColor}">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="page-edit__rubric-add">
                <input-comp label="Название рубрики" v-model="rubricName"/>
                <button-comp :on-click="addRubric">Добавить</button-comp>
            </div>
        </div>
        <div class="page-edit__block">
            <h1 class="title page-edit__title">Изменение цветов:</h1>
            <div class="page-edit__color-picker-container color-picker">
                <chrome-picker @input="setColor" v-model="colorPicker" />
                <div class="color-picker__preview">
                    <h2>Основной цвет</h2>
                    <div
                            class="color-picker__color color-picker__color_main"
                            :style="{'backgroundColor': pageChanges.mainColor}"
                            @click="isMainColorSelected = true"
                    >
                    </div>
                    <h2>Акцентный цвет</h2>
                    <div
                            class="color-picker__color color-picker__color_accent"
                            :style="{'backgroundColor': pageChanges.accentColor}"
                            @click="isMainColorSelected = false"
                    >
                    </div>
                </div>
            </div>
        </div>
        <button-comp class="page-edit__button" :on-click="saveChanges">Сохранить изменения</button-comp>
        <button-comp class="page-edit__button" :on-click="cancelChanges">Отменить</button-comp>
        <div v-if="changesSaved" class="success">Изменения сохранены</div>
    </div>
</template>

<script>
    import {mapState} from 'vuex'
    import Input from "../../components/UI/Input"
    import Button from "../../components/UI/Button"
    import { Chrome } from 'vue-color'
    export default {
        components: {
            'input-comp': Input,
            'button-comp': Button,
            'chrome-picker': Chrome
        },
        created() {
            this.pageChanges = JSON.parse(JSON.stringify(this.pageModule.publisher))
            this.prevVersion = JSON.parse(JSON.stringify(this.pageModule.publisher))
            console.log(this.pageChanges)
        },
        data() {
            return {
                pageChanges: {},
                prevVersion: {},
                rubricName: '',
                changesSaved: false,
                colorPicker: '',
                isMainColorSelected: true
            }
        },
        methods: {
            addRubric() {
                if(this.rubricName !== '') {
                    this.pageChanges.rubrics.push({
                        title: this.rubricName,
                        uri: this.rubricName
                    })
                    this.rubricName = ''
                }
            },
            removeRubric(id) {
                this.pageChanges.rubrics.splice(id, 1)
                // this.$store.commit('REMOVE_RUBRIC', id)
            },
            saveChanges() {
                this.$store.commit('SAVE_CHANGES', this.pageChanges)
                this.changesSaved = true
                setTimeout(() => {
                    this.changesSaved = false
                }, 2000)
            },
            cancelChanges() {
                this.pageChanges = JSON.parse(JSON.stringify(this.prevVersion))
            },
            setColor() {
                console.log(this.colorPicker)
                if(this.isMainColorSelected) {
                    this.pageChanges.mainColor = this.colorPicker.hex
                }
                else {
                    this.pageChanges.accentColor = this.colorPicker.hex
                }
            }
        },
        computed: {
            ...mapState(['pageModule'])
        }
    }
</script>

<style lang="scss" scoped>
    .page-edit {
        &__rubrics-container {
            display: flex;
            flex-wrap: wrap;
            margin: 0 0 15px 0;
        }

        &__rubric-add {

        }

        &__block {
            padding: 30px 15px 10px 15px;
            border-radius: $border-radius;
            margin-bottom: 20px;
        }

        &__title {
            margin-bottom: 10px;
        }

        &__color-picker-container {
            @include flex(flex-start, flex-start, row);
        }
    }

    .rubric {
        position: relative;
        padding: 10px;
        color: #fff;
        margin: 15px 20px 0 0;
        border-radius: $border-radius;

        &__delete-button {
            position: absolute;
            right: -10px;
            top: -10px;
            color: #fff;
            border-radius: 50%;
            width: 25px;
            height: 25px;
            border: none;
            cursor: pointer;
        }
    }

    .color-picker {
        &__color {
            width: 100px;
            height: 50px;
            background-color: red;
            margin: 5px 0 25px 0;
            cursor: pointer;
            border-radius: $border-radius;
        }

        &__preview {
            margin-left: 50px;
        }
    }

    .success {
        text-align: center;
        color: green;
        width: 100%;
        margin: 10px 0;
    }
</style>