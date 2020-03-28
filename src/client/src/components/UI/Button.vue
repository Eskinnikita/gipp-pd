<template>
    <a v-if="href" :href="href" class="button" :style="{'backgroundColor':pageModule.publisher.accentColor}">
        <slot/>
    </a>
    <button v-else class="button" @click="onClick" :style="{'backgroundColor':pageModule.publisher.accentColor}">
        <slot/>
    </button>
</template>

<script>
    import {mapState} from 'vuex'

    export default {
        props: {
            onClick: {
                type: Function,
                required: false
            },
            href: {
                type: String,
                default: null
            }
        },
        created() {
            // console.log(this.onClick)
        },
        methods: {

        },
        computed: {
            ...mapState(['pageModule'])
        }
    }
</script>

<style lang="scss" scoped>
    .button {
        height: 40px;
        text-align: center;
        width: 100%;
        border: none;
        background: none;
        color: #fff;
        margin: 5px 0;
        padding: 10px 15px;
        box-sizing: border-box;
        border-radius: $border-radius;
        font-size: 15px;
        &:hover {
            cursor: pointer;
        }
    }
</style>