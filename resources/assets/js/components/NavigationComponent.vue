<template>
  <div>

    <b-nav vertical>

      <b-nav-item v-b-toggle.pomodoroCollapse
                  class="color-inherit collapse-toggle-button">{{ trans.get('__JSON__.Pomodoro') }}
        <span class="float-right">
        <icon :name="pomodoroCaret"
              scale="0.8"></icon></span>
      </b-nav-item>

      <b-collapse id="pomodoroCollapse"
                  visible
                  @show="pomodoroCaret = 'caret-up'"
                  @hide="pomodoroCaret = 'caret-down'"
                  class="ml-4">

        <router-link
                tag="li"
                class="side-nav-link clearfix"
                :to="{ name: 'example' }"
                size="sm">
          <icon name="hourglass"
                class="mr-2"></icon>
          {{ trans.get('navigation.example')}}
        </router-link>

      </b-collapse>
    </b-nav>
  </div>
</template>

<script>
    export default {
        name: 'navigation-component',
        data() {

            return {

                pomodoroCaret: 'caret-up',
            };
        },
    };
</script>

<style scoped>

</style>