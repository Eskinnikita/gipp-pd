<template>
    <div class="article-editor view-container">
        <modal name="article-preview"
               :width="900"
               :height="'auto'"
               :styles="{
                   'padding': '25px 30px 50px',
                   'margin': '10px 0'
                   }"
               :scrollable="true"
        >
            <article-preview :article="article"/>
        </modal>
        <div class="article-editor__block">
            <input-comp label="Название статьи" v-model="article.title"/>
        </div>
        <div class="article-editor__block">
            <label>Выберите рубрики:</label>
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
            <label>Аннотация к статье:</label>
            <textarea-comp v-model="article.annotation" :rows="5" :resize="false"/>
            <!--            <textarea v-model="article.annotation" name="annotation" id="" cols="30" rows="10"></textarea>-->
        </div>
        <div class="article-editor__block">
            <label>Текст статьи:</label>
            <quill-editor
                    ref="myQuillEditor"
                    v-model="article.text"
            />
        </div>
        <button-comp :on-click="showPreview">Показать статью</button-comp>
        <button-comp :on-click="saveChanges" v-if="this.newsModule.updatedArticle">Сохранить изменения</button-comp>
        <button-comp :on-click="addArticle" v-else>Опубликовать</button-comp>
        <button-comp :on-click="addDraft">В черновики</button-comp>
    </div>
</template>

<script>
    import {mapState} from 'vuex'
    import Input from "../../../components/UI/Input"
    import Textarea from "../../../components/UI/Textarea"
    import Button from "../../../components/UI/Button"
    import Multiselect from 'vue-multiselect'
    import 'quill/dist/quill.core.css'
    import 'quill/dist/quill.snow.css'
    import 'quill/dist/quill.bubble.css'

    import {quillEditor} from 'vue-quill-editor'
    import ArticlePreview from "../../../components/ArticlePreview"

    export default {
        components: {
            ArticlePreview,
            'input-comp': Input,
            'button-comp': Button,
            'textarea-comp': Textarea,
            'multiselect': Multiselect,
            'quill-editor': quillEditor
        },
        created() {
            if(this.newsModule.updatedArticle) {
                this.article = this.newsModule.updatedArticle
                this.parseRubricsToUpdate()
            }
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
                    previewImage: '',
                    annotation: ''
                },
                rubrics: []
            }
        },
        methods: {
            parseRubricsToUpdate() {
                this.pageModule.publisher.rubrics.forEach(el => {
                    if(this.article.rubricsUri.indexOf(el.uri) > -1) {
                        this.rubrics.push(el)
                    }
                })
            },
            parseRubrics() {
                this.rubrics.forEach(rubric => {
                    this.article.rubricsUri.push(rubric.uri)
                })
            },
            addArticle() {
                this.parseRubrics()
                this.$store.commit('ADD_ARTICLE', this.article)
            },
            addDraft() {
                this.parseRubrics()
                this.article.isDraft = true
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
            },
            showPreview() {
                this.$modal.show('article-preview');
            },
            saveChanges() {
                this.parseRubrics()
                this.$store.commit('UPDATE_ARTICLE', this.article)
            }
        },
        beforeDestroy() {
            this.$store.commit('RESET_UPDATED_ARTICLE')
        },
        computed: {
            ...mapState(['pageModule', 'newsModule'])
        },
        watch: {
            rubrics() {
                console.log(this.rubrics)
            }
        }
    }
</script>

<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
<style lang="scss">
    .article-editor {
        max-width: 750px;
        margin: 0 auto;
        padding-bottom: 40px;

        .vm--modal {
            font-family: Avenir, Helvetica, Arial, sans-serif;
        }

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