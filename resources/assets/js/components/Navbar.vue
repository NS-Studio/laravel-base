<template>
    <b-navbar toggleable="md"
              fixed="top"
              variant="secondary">

        <b-navbar-toggle target="nav_collapse"></b-navbar-toggle>

        <b-navbar-brand href="/">{{ app_name }}</b-navbar-brand>

        <b-collapse is-nav
                    id="nav_collapse">

            <b-navbar-nav>

                <b-nav-item v-if="this.$gate.can('access', 'developer_policy', user)"
                            href="/log-viewer">{{ trans('__JSON__.Logs')}}
                </b-nav-item>

                <b-nav-item v-if="this.$gate.can('access', 'developer_policy', user)"
                            href="/translations">{{ trans('__JSON__.Translations')}}
                </b-nav-item>
            </b-navbar-nav>

            <!-- Right aligned nav items -->
            <b-navbar-nav class="ml-auto">

                <b-nav-item-dropdown right>
                    <!-- Using button-content slot -->
                    <template slot="button-content">
                        <em>{{ user.name }}</em>
                    </template>
                    <b-btn href="#"
                           @click.prevent="onLogout">{{ trans('__JSON__.Log out') }}
                    </b-btn>
                </b-nav-item-dropdown>
            </b-navbar-nav>

        </b-collapse>
    </b-navbar>

</template>

<script>
    export default {
        name: 'navbar',
        data() {

            return {

                logout: window.Laravel.urls.logout,
                user: window.user,
                app_name: window.app_name,
            };
        },
        methods: {

            onLogout() {

                this.$http.post(this.logout).then(response => {

                    window.location.replace('/');
                }, response => {

                    window.location.replace('/');
                });
            },
        }
    };
</script>

<style scoped>

</style>