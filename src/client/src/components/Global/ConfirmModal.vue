<template>
    <modal name="confirm-modal" width="420" height="300">
        <div class="modal-container">
            <p class="confirm-modal__text">
                <slot/>
            </p>
            <div class="confirm-modal__controls controls">
                <button class="controls__button controls__button_confirm"
                        :style="{'backgroundColor': this.pageModule.publisher.accentColor}" @click="submitMethod">
                    Подтвердить
                </button>
                <button class="controls__button controls__button_reject">Отменить</button>
            </div>
        </div>
    </modal>
</template>

<script>
    import {mapState} from 'vuex'

    export default {
        props: {
            submitMethod: {
                type: Function,
                required: true
            }
        },
        computed: {
            ...mapState(['pageModule'])
        }
    }
</script>

<style lang="scss" scoped>
    .modal-container {
        height: 100%;
        width: 100%;
        @include flex(center, center, column);
        box-sizing: border-box;
        padding: 10px 30px;
    }

    .confirm-modal {
        &__text {
            font-size: 20px;
            text-align: center;
            width: 100%;
            height: 80px;
        }
    }

    .controls {
        width: 100%;
        @include flex(space-between, center, row);
        &__button {
            color: #fff;
            padding: 10px;
            width: 45%;
            border-radius: $border-radius;
            border: none;
            font-size: 13px;
            cursor: pointer;
            transition: opacity 0.3s;
            &_confirm {

            }

            &_reject {
                background-color: firebrick;
            }

            &:hover {
                opacity: 0.7;
            }
        }
    }
</style>