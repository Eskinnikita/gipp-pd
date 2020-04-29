<template>
    <div class="article">
        <h1 class="article__title">{{ article.title }}</h1>
        <div class="article__info" v-if="article.title">
            <span class="article__date">{{article.publicationDate | moment("LLL")}}</span>
            <span> · </span>
            <span>{{article.authorId}}</span>
        </div>
        <div class="article__general-material" >
            <div class="article__text" v-if="article.text" v-html="article.text"></div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['article']
    }
</script>

<style scoped>

</style>