<template>
    <b-col :cols="isMobile ? 12 : 10"
           offset-md="2"
           style="position: fixed; top: 54px; bottom: 0;">

        <router-view></router-view>
    </b-col>
</template>

<script>
    export default {
        name: 'main-content'
    };
</script>

<style scoped>

</style>