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
            <label>Фото на превью:</label>
            <input ref="previewImageInput" @input="convertToBase64" type="file">
        </div>
        <div class="article-editor__block">
            <label>Текст статьи:</label>
            <quill-editor
                    ref="myQuillEditor"
                    v-model="article.text"
            />
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
    import 'quill/dist/quill.core.css'
    import 'quill/dist/quill.snow.css'
    import 'quill/dist/quill.bubble.css'

    import {quillEditor} from 'vue-quill-editor'

    export default {
        components: {
            'input-comp': Input,
            'button-comp': Button,
            'multiselect': Multiselect,
            'quill-editor': quillEditor
        },
        created() {

        },
        mounted() {

        },
        data() {
            return {
                article: {
                    id: Math.floor(Math.random() * (2000 - 10) + 10),
                    rubricsUri: [],
                    authorId: 1,
                    publicationDate: Date.now(),
                    title: '',
                    text: '',
                    previewImage: ''
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
            },
            getBase64(file) {
                return new Promise((resolve, reject) => {
                    const reader = new FileReader();
                    reader.readAsDataURL(file);
                    reader.onload = () => resolve(reader.result);
                    reader.onerror = error => reject(error);
                });
            },
            async convertToBase64() {
                const previewImageFile = this.$refs.previewImageInput.files[0];
                this.getBase64(previewImageFile).then(
                    data => this.article.previewImage = data
                );
                // console.log(this.getBase64(previewImageFile))
                // this.article.previewImage = await this.getBase64(previewImageFile)
                console.log(this.article)
            }
        },
        computed: {
            ...mapState(['pageModule'])
        },
        watch: {}
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

    .ql-editor {
        min-height: 350px;
    }
</style>