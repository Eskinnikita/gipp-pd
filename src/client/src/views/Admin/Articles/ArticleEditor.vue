<template>
    <div class="article-editor">
        <input-comp  label="Название статьи" v-model="article.title"/>
        <label>
            Текст статьи <br/>
            <textarea style="width: 100%; min-height: 300px;" v-model="article.text"></textarea>
        </label>
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

    export default {
        components: {
            'input-comp': Input,
            'button-comp': Button
        },
        created() {

        },
        data() {
            return {
                article: {
                    id: 1,
                    rubricUri: 'putin',
                    authorId: 1,
                    title: '',
                    text: ''
                },
                rubrics: []
            }
        },
        methods: {
            addArticle() {
                console.log('placeholder')
                this.$store.commit('ADD_ARTICLE', this.article)
            }
        },
        computed: {
            ...mapState(['pageModule'])
        }
    }
</script>

<style scoped>

</style>