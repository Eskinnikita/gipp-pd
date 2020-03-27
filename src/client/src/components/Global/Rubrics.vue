<template>
    <div class="rubrics" :style="{'backgroundColor': color}">
        <div class=" rubrics__container container">
            <button
                    class="rubrics__item"
                    :style="{'border-bottom-color': accentColor}"
                    :class="{'rubrics__item_active': selectedRubric === 'all'}"
                    @click="selectRubric(0, 'all')">
                Главная
            </button>
            <button
                    class="rubrics__item"
                    v-for="(rubric, index) in rubrics"
                    :style="{'border-bottom-color': accentColor}"
                    :class="{'rubrics__item_active': rubric.uri === selectedRubric}"
                    @click="selectRubric(rubric.id, rubric.uri)"
                    :key="index">
                {{rubric.title}}
            </button>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            rubrics: {
                type: Array,
                required: true
            },
            color: {
                type: String,
                required: true
            },
            accentColor: {
                type: String,
                required: true
            }
        },
        mounted() {
            this.selectedRubric = this.$route.params.name ? this.$route.params.name : 'all'
        },
        data() {
            return {
                selectedRubric: 'all'
            }
        },
        methods: {
            selectRubric(id, uri) {
                this.selectedRubric = uri
                if (id !== 0) {
                    this.$store.commit('GET_RUBRIC_NEWS', id)
                    this.$router.push(`/rubric/${uri}`, () => {
                    })
                } else {
                    this.$store.commit('GET_ALL_NEWS')
                    this.$router.push('/', () => {
                    })
                }
            }
        },
        computed: {

        }
    }
</script>

<style lang="scss" scoped>
    .rubrics {
        color: #fff;

        &__container {
            padding-top: 0;
            height: 100%;
            @include flex(flex-start, center, row);
        }

        &__item {
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

            &_active {
                padding-top: 4px;
                border-bottom-style: solid;
                border-bottom-width: 4px;
            }
        }
    }
</style>