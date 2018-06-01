<template>
  <b-navbar toggleable="md"
            type="light"
            variant="info">

    <b-navbar-toggle target="nav_collapse"></b-navbar-toggle>

    <b-navbar-brand href="/">{{ app_name }}</b-navbar-brand>

    <b-collapse is-nav
                id="nav_collapse">

      <b-navbar-nav>
        <b-nav-item v-if="this.$gate.can('access', 'admin_policy', user)"
                    @click.prevent="accessAdminPanel">{{ trans.get('admin.panel')}}
        </b-nav-item>

        <b-nav-item v-if="this.$gate.can('access', 'admin_policy', user)"
                    href="/log-viewer">{{ trans.get('admin.log_viewer')}}
        </b-nav-item>

        <b-nav-item v-if="this.$gate.can('access', 'admin_policy', user)"
                    href="/translations">{{ trans.get('admin.translations')}}
        </b-nav-item>
      </b-navbar-nav>

      <!-- Right aligned nav items -->
      <b-navbar-nav class="ml-auto">

        <b-nav-item-dropdown right>
          <!-- Using button-content slot -->
          <template slot="button-content">
            <em>{{ user.name }}</em>
          </template>
          <b-dropdown-item href="#"
                           @click.prevent="onLogout">{{ trans.get('auth.logout') }}
          </b-dropdown-item>
        </b-nav-item-dropdown>
      </b-navbar-nav>

    </b-collapse>
  </b-navbar>

</template>

<script>
    export default {
        name:    'navbar',
        data() {

            return {

                logout:      window.Laravel.urls.logout,
                user:        window.user,
                app_name:    window.app_name,
                admin_panel: window.Laravel.urls.admin.panel,
            };
        },
        methods: {

            onLogout() {

                this.$http.post( this.logout ).then( response => {

                    window.location.replace( '/' );
                }, response => {

                    window.location.replace( '/' );
                } );
            },
            accessAdminPanel() {

                window.location.replace( this.admin_panel );
            }
        }
    };
</script>

<style scoped>

</style>