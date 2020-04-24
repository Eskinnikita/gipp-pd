<template>
    <div class="textarea-component">
        <textarea
                  :style="{'resize': resize ? 'both' : 'none'}"
                  :rows="rows"
                  :value="value"
                  @input="$emit('update', $event.target.value)"
        ></textarea>
    </div>
</template>

<script>
    export default {
        props: ['value','rows', 'resize'],
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
            border-radius: $border-radius;
            border: 1px solid #bebebe;
            padding: 5px;
            font-size: 15px;
            width: 100%;
            box-sizing: border-box;
        }
    }
</style>