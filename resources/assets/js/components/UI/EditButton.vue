<template>

    <b-btn @click.stop="$emit('clicked')"
           :variant="variant">

        <template v-if="!isMobile">{{ buttonText }}</template>
        <icon v-else
              :name="icon"></icon>
    </b-btn>
</template>

<script>
    export default {
        name: 'edit-button',
        props: {

            icon: {

                default: 'pencil',
                type: String,
            },
            variant: {

                default: 'info',
                type: String
            },
            text: {

                default: null,
                type: String,
            }
        },
        data() {

            return {

                buttonText: this.text || trans('__JSON__.Edit')
            };
        }
    };
</script>

<style scoped>

</style>