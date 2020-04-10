<template>
    <div class="article-editor view-container">
        <div class="article-editor__block">
            <input-comp label="Название статьи" v-model="article.title"/>
        </div>
        <div class="article-editor__block">
            <label>Выберете рубрики:</label>
            <multiselect
                    v-model="rubrics"
                    track-by="title"
                    label="title"
                    :multiple="true"
                    :taggable="true"
                    :hide-selected="true"
                    :options="pageModule.publisher.rubrics"
            >
            </multiselect>
        </div>
        <div class="article-editor__block">
            <label>Текст статьи:</label>
            <ckeditor
                    :editor="editor"
                    :config="editorConfig"
                    v-model="article.text"
            >
            </ckeditor>
        </div>
        <router-link to="/article-preview">
            <button-comp>Показать статью</button-comp>
        </router-link>
        <button-comp :on-click="addArticle">Опубликовать</button-comp>
    </div>
</template>

<script>
    import {mapState} from 'vuex'
    import Input from "../../../components/UI/Input"
    import Button from "../../../components/UI/Button"
    import Multiselect from 'vue-multiselect'
    import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
    // import Base64UploadAdapter from '@ckeditor/ckeditor5-upload/src/adapters/base64uploadadapter';

    export default {
        components: {
            'input-comp': Input,
            'button-comp': Button,
            'multiselect': Multiselect
        },
        created() {

        },
        mounted() {

        },
        data() {
            return {
                editor: ClassicEditor,
                editorConfig: {
                    height: '30px'
                },
                article: {
                    id: 1,
                    rubricsUri: [],
                    authorId: 1,
                    publicationDate: Date.now(),
                    title: '',
                    text: ''
                },
                rubrics: []
            }
        },
        methods: {
            addArticle() {
                this.rubrics.forEach(rubric => {
                    this.article.rubricsUri.push(rubric.uri)
                })
                console.log(this.article)
                this.$store.commit('ADD_ARTICLE', this.article)
            }
        },
        computed: {
            ...mapState(['pageModule'])
        },
        watch: {

        }
    }
</script>

<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
<style lang="scss">
    .article-editor {
        max-width: 750px;
        margin: 0 auto;
        padding-bottom: 40px;
        &__block {
            margin-bottom: 30px;
        }

        label {
            display: block;
            font-size: 16px;
            padding-bottom: 5px;
        }
    }

    .multiselect {
        &__tags {
            border-color: #bebebe !important;
        }
    }
</style>