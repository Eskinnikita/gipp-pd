<template>
    <div class="input-component">
        <label class="input-component__label">
            {{label}} <br/>
            <input class="input-component__input"
                   v-bind="$attrs"
                   :type="type"
                   :placeholder="placeholder"
                   v-on="$listeners"
                   :value="value"
                   @input="$emit('update', $event.target.value)">
        </label>
    </div>
</template>

<script>
    export default {
        props: ['value', 'label', 'type', 'placeholder'],
        model: {
            prop: "value",
            event: "update"
        },
        data() {
            return {
                name: ''
            }
        }
    }
</script>

<style lang="scss" scoped>
    .input-component {
        margin: 10px 0;
        width: 100%;
        &__label {
            font-size: 16px;
        }

        &__input {
            margin-top: 5px;
            width: 100%;
            border-radius: $border-radius;
            border: 1px solid #bebebe;
            padding: 10px 8px;
            box-sizing: border-box;
            font-size: 15px;
        }
    }
</style>