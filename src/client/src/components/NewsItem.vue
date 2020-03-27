<template>
        <div class="news-item">
            <router-link :to="{path:`/news/${newsInfo.id}`}">
                   {{newsInfo.title}}
            </router-link>
        </div>
</template>

<script>
    export default {
        props: {
            newsInfo: {
                required: true,
                type: Object
            }
        }
    }
</script>

<style lang="scss" scoped>
    .news-item {
        width: 25%;
        border: 1px solid #bebebe;
        box-sizing: border-box;
        border-radius: $border-radius;
        margin: 10px;
        text-align: left;
        @include flex(center, flex-start, column);
        &__title {
            font-size: 20px;
            font-weight: bold;
        }
        a {
            padding: 10px;
            width: 100%;
            height: 100%;
        }
    }

    .router-wrapper {
    }
</style>