<template>
  <div>

    <b-nav vertical>

      <b-nav-item v-b-toggle.adminCollapse
                  class="color-inherit collapse-toggle-button">{{ trans.get('__JSON__.Admin') }}
        <span class="float-right">
        <icon :name="adminCaret"
              scale="0.8"></icon></span>
      </b-nav-item>

      <b-collapse id="adminCollapse"
                  visible
                  @show="adminCaret = 'caret-up'"
                  @hide="adminCaret = 'caret-down'"
                  class="ml-4">


        <router-link
                tag="li"
                class="side-nav-link clearfix"
                :to="{ name: 'admin-users-table' }"
                size="sm">
          <icon name="users"
                class="mr-2"></icon>
          {{ trans.get('navigation.admin.users.table')}}
        </router-link>


      </b-collapse>
    </b-nav>
  </div>
</template>

<script>
    export default {
        name: 'admin-navigation-component',
        data() {

            return {

                adminCaret: 'caret-up',
                apiCaret:   'caret-up',
            };
        },
    };
</script>

<style scoped>

</style>