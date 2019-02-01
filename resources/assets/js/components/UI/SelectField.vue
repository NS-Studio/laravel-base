<template>

    <b-form-group :label="fieldLabel">

        <b-form-select @select="$emit('select', item)"
                       @input="$emit('input', item)"
                       :options="items"
                       v-model="item"
                       :text-field="textField"
                       :value-field="valueField"/>

    </b-form-group>
</template>

<script>
    export default {
        name: 'select-field',
        props: {

            label: {

                default: null,
                type: String,
            },
            textField: {

                default: 'name',
                type: String,
            },
            valueField: {

                default: 'id',
                type: String,
            },
            items: {

                default() {

                    return [];
                },
                type: Array
            },
            value: {

                default() {

                    return {};
                },
                type: [
                    Object,
                    String
                ],
            }
        },
        data() {

            return {

                fieldLabel: this.label || '',
                item: this.value || null,
            };
        },
        watch: {

            item: function (newItem) {

                this.$emit('input', newItem);
            }
        }
    };
</script>

<style scoped>

</style>