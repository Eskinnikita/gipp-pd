<template>
    <button v-if="icon" class="button icon-button" @click="onClick">
        <i :class="icon"></i>
    </button>
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
                default: () => {
                    console.log("button isn't working")
                }
            },
            icon: {
                type: String,
                default: null
            }
        },
        created() {
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
        /*width: 100%;*/
        border: none;
        background: none;
        color: #fff;
        margin: 10px 5px;
        padding: 10px 15px;
        box-sizing: border-box;
        border-radius: $border-radius;
        font-size: 15px;
        &:hover {
            cursor: pointer;
        }
    }

    .icon-button {
        padding: 0 10px;
        font-size: 20px;
    }
</style>