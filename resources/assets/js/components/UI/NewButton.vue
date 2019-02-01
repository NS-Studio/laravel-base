<template>

    <b-btn :class="classes"
           @click="$emit('clicked')"
           :variant="variant">

        <template v-if="!isMobile">{{ buttonText }}</template>
        <icon v-else
              :name="icon"></icon>
    </b-btn>
</template>

<script>
    export default {
        name: 'new-button',
        props: {

            classes: {

                default: 'ml-2 mb-2',
                type: String,
            },
            variant: {

                default: 'warning',
                type: String,
            },
            icon: {

                default: 'plus',
                type: String,
            },
            text: {

                default: null,
                type: String,
            }
        },
        data() {

            return {

                buttonText: this.text || trans('__JSON__.New')
            };
        }
    };
</script>

<style scoped>

</style>