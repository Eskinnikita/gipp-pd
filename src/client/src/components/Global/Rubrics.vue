<template>
    <div class="rubrics" :style="{'backgroundColor': color}">
        <div class=" rubrics__container container">
            <rubric-item
                    :border-color="accentColor"
                    :text-color="'#fff'"
                    :is-active="checkRubricActive('all')"
                    @click.native="selectRubric(0, 'all')">
                Главное
            </rubric-item>
            <rubric-item
                    v-for="(rubric, index) in rubrics"
                    :is-active="checkRubricActive(rubric.uri)"
                    @click.native="selectRubric(rubric.id, rubric.uri)"
                    :border-color="accentColor"
                    :text-color="'#fff'"
                    :key="index"
            >
                {{rubric.title}}
            </rubric-item>
<!--            <button-->
<!--                    class="rubrics__item"-->
<!--                    v-for="(rubric, index) in rubrics"-->
<!--                    :style="{'border-bottom-color': accentColor}"-->
<!--                    :class="{'rubrics__item_active': rubric.uri === selectedRubric}"-->
<!--                    @click="selectRubric(rubric.id, rubric.uri)"-->
<!--                    :key="index">-->
<!--                {{rubric.title}}-->
<!--            </button>-->
        </div>
    </div>
</template>

<script>
    import RubricItem from "./RubricItem"
    export default {
        components: {
            'rubric-item': RubricItem
        },
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
                if (id !== 0 && uri !== '') {
                    this.$store.commit('GET_RUBRIC_NEWS', uri)
                    this.$router.push(`/rubric/${uri}`, () => {
                    })
                } else {
                    this.$store.commit('GET_ALL_NEWS')
                    this.$router.push('/', () => {
                    })
                }
            },
            checkRubricActive(rubric) {
                return this.selectedRubric === rubric
            }
        },
        watch: {
            '$route.params.name': {
                handler: function(name) {
                    if(name === undefined) {
                        this.$store.commit('GET_ALL_NEWS')
                        this.selectedRubric = 'all'
                    }
                },
                deep: true,
                immediate: true
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