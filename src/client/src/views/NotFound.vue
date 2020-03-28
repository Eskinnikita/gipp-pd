<template>
    <div class="not-found">
        <h1 class="not-found__text">
            Извините, мы не нашли такую страницу... <i class="far fa-sad-tear"></i>
        </h1>
    </div>
</template>

<script>
    export default {}
</script>

<style lang="scss" scoped>
    .not-found {
        padding: 40px 0;
        text-align: center;
        &__text {
            font-weight: bold;
            font-size: 30px;
        }
    }
</style>