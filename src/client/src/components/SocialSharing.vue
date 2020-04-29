<template>
    <social-sharing :url="url"
                    :title="article.title"
                    :description="article.annotation"
                    :quote="article.title"
                    hashtags="vuejs,javascript,framework"
                    inline-template>
        <div class="article__sharing">
            <network style="padding: 0 10px; border-right: 1px solid #bebebe; cursor:pointer;" network="facebook">
                <i class="fab fa-facebook"></i>
            </network>
            <network style="padding: 0 10px; border-right: 1px solid #bebebe; cursor:pointer;" network="odnoklassniki">
                <i class="fab fa-odnoklassniki"></i>
            </network>
            <network style="padding: 0 10px; border-right: 1px solid #bebebe; cursor:pointer;" network="telegram">
                <i class="fab fa-telegram"></i>
            </network>
            <network style="padding: 0 10px; border-right: 1px solid #bebebe; cursor:pointer;" network="twitter">
                <i class="fab fa-twitter"></i>
            </network>
            <network style="padding: 0 10px; border-right: 1px solid #bebebe; cursor:pointer;" network="vk">
                <i class="fab fa-vk"></i>
            </network>
        </div>
    </social-sharing>
</template>

<script>
    export default {
        props: ['url', 'article']
    }
</script>

<style scoped>

</style>