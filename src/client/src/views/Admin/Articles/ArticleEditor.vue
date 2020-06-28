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
            <input-comp
                    label="Название статьи"
                    :required="true"
                    :invalid-condition="$v.article.title.$dirty && !$v.article.title.required"
                    :invalid-message="'Введите название статьи'"
                    v-model="article.title"
            />
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
            <label>Аннотация к статье: <span class="required-sign">*</span></label>
            <textarea-comp
                    :required="true"
                    :invalid-condition="$v.article.annotation.$dirty && !$v.article.annotation.required"
                    :invalid-message="'Введите аннотацию к статье'"
                    v-model="article.annotation"
                    :rows="5"
                    :resize="false"
            />
        </div>
        <div class="article-editor__block">
            <label>Текст статьи:<span class="required-sign">*</span></label>
            <quill-editor
                    ref="myQuillEditor"
                    v-model="article.text"
            />
            <span class="error" v-if="$v.article.text.$dirty && !$v.article.text.required">Введите текст статьи!</span>
        </div>
        <button-comp :on-click="showPreview">Показать статью</button-comp>
        <button-comp @click.native="openModal(1)" v-if="this.newsModule.updatedArticle">Сохранить изменения</button-comp>
        <button-comp @click.native="openModal(2)" v-if="!this.newsModule.updatedArticle || article.isDraft">Опубликовать</button-comp>
        <button-comp @click.native="openModal(3)" v-if="!article.isDraft">В черновики</button-comp>
        <confirm-modal v-if="modalNum === 1" :submit-method="saveChanges">Сохранить изменения?</confirm-modal>
        <confirm-modal v-if="modalNum === 2" :submit-method="addArticle">Вы уверены, что хотите опубликовать статью?</confirm-modal>
        <confirm-modal v-if="modalNum === 3" :submit-method="addDraft">Отложить статью в черновики?</confirm-modal>
    </div>
</template>

<script>
    import {mapState} from 'vuex'
    import {required} from 'vuelidate/lib/validators'
    import Input from "../../../components/UI/Input"
    import Textarea from "../../../components/UI/Textarea"
    import Button from "../../../components/UI/Button"
    import Multiselect from 'vue-multiselect'
    import 'quill/dist/quill.core.css'
    import 'quill/dist/quill.snow.css'
    import 'quill/dist/quill.bubble.css'

    import {quillEditor} from 'vue-quill-editor'
    import ArticlePreview from "../../../components/ArticlePreview"
    import ConfirmModal from "../../../components/Global/ConfirmModal"

    export default {
        components: {
            ConfirmModal,
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
                rubrics: [],
                modalNum: 1
            }
        },
        validations: {
            article: {
                title: {required},
                annotation: {required},
                text: {required}
            }
        },
        methods: {
            addArticle() {
                if (this.$v.$invalid) {
                    this.$v.$touch()
                } else {
                    this.parseRubrics()
                    this.$store.commit('ADD_ARTICLE', this.article)
                    this.$store.commit('SET_TOAST', {
                        message: 'Статья успешно опубликована!',
                        type: 'success'
                    })
                    this.$router.push('/')
                }
            },
            openModal(num) {
                if (this.$v.$invalid) {
                    this.$v.$touch()
                }
                else {
                    this.modalNum = num
                    this.$modal.show('confirm-modal')
                }
            },
            saveChanges() {
                if (this.$v.$invalid) {
                    this.$v.$touch()
                } else {
                    this.parseRubrics()
                    this.$store.commit('UPDATE_ARTICLE', this.article)
                    this.$store.commit('SET_TOAST', {
                        message: 'Изменения сохранены!',
                        type: 'success'
                    })
                    this.$router.push(`/news/${this.article.id}`)
                    this.$modal.hide('confirm-modal')
                }
            },
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
            addDraft() {
                this.parseRubrics()
                this.article.isDraft = true
                this.$store.commit('ADD_ARTICLE', this.article)
                this.$store.commit('SET_TOAST', {
                    message: 'Статья добавлена в черновики!',
                    type: 'success'
                })
                this.$modal.hide('confirm-modal')
                this.$router.push('/admin')
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

            .error {
                color: red;
                margin-top: 5px;
                font-size: 13px;
            }
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