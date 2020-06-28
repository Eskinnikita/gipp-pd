<template>
    <div class="textarea-component">
        <textarea
                  :style="{'resize': resize ? 'both' : 'none'}"
                  :class="{'invalid': invalidCondition ? (invalidCondition) : false}"
                  :rows="rows"
                  :value="value"
                  @input="$emit('update', $event.target.value)"
        ></textarea>
        <span class="textarea-component__error" v-if="invalidCondition">{{invalidMessage}}</span>
    </div>
</template>

<script>
    export default {
        props: ['value','rows', 'resize', 'invalidCondition', 'invalidMessage'],
        model: {
            prop: "value",
            event: "update"
        }
    }
</script>

<style lang="scss" scoped>
    .textarea-component {
        width: 100%;
        textarea {
            font-family: Avenir, Helvetica, Arial, sans-serif;
            font-weight: normal;
            border-radius: $border-radius;
            border: 1px solid #bebebe;
            padding: 5px;
            font-size: 15px;
            width: 100%;
            box-sizing: border-box;
        }
        &__error {
            color: red;
            margin-top: 5px;
            font-size: 13px;
        }
    }
</style>