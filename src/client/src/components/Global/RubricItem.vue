<template>
    <button
            class="rubric-item"
            :style="{'border-bottom-color': borderColor, 'color': textColor}"
            :class="{'rubric-item active': isActive}"
           >
        <slot/>
    </button>
</template>

<script>
    export default {
        props: {
            'isActive':{
                type: Boolean,
                required: true
            },
            'borderColor': {
                type: String
            },
            'textColor': {
                type: String,
                default: '#000'
            },
        },
        created() {
            console.log(
                `isActive:${this.isActive},
                onClick:${this.onClick},
                borderColor:${this.borderColor},
                textColor:${this.textColor}`
            )
        }
    }
</script>

<style lang="scss" scoped>
    .rubric-item {
        cursor: pointer;
        position: relative;
        box-sizing: border-box;
        padding: 0 15px 10px 15px;
        color: #fff;
        background: none;
        border: none;
        font-size: 18px;
        display: block;
        height: 100%;
    }

    .active {
         padding-top: 4px;
         border-bottom-style: solid;
         border-bottom-width: 4px;
     }
</style>