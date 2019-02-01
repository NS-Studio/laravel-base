<template>
  <div>

    <b-modal id="newUserModal"
             hide-footer
             :modal-class="'mt-5'"
             ref="newUserModal"
             :title="trans('__JSON__.Create new User')">

      <b-form @submit.prevent="onSubmit">

        <b-form-group :label="trans('__JSON__.Name')">

          <b-form-input type="text"
                        v-model="form.name"
                        required
                        :placeholder="trans('__JSON__.Name')">
          </b-form-input>

        </b-form-group>

        <b-form-group :label="trans('__JSON__.Email')">

          <b-form-input type="email"
                        v-model="form.email"
                        required
                        :placeholder="trans('__JSON__.Email')">
          </b-form-input>

        </b-form-group>

        <b-form-group :label="trans('__JSON__.Role')">

          <b-form-select v-model="form.role"
                         :options="roles"
                         :text-field="'name'"
                         :value-field="'value'"
          />

        </b-form-group>

        <b-form-group :label="trans('__JSON__.Locale')">

          <b-form-select v-model="form.locale"
                         :options="locales"
                         :text-field="'label'"
                         :value-field="'value'"
          />

        </b-form-group>

        <b-button type="submit"

                  variant="primary">{{ trans('__JSON__.Submit') }}
        </b-button>

      </b-form>

    </b-modal>

  </div>
</template>

<script>

    export default {

        name: 'new-user-modal',

        props:   {

            url:     {

                default: '',
                type:    String,
            },
            roles:   {

                default: [],
                type:    Array,
            },
            locales: {

                default: [],
                type:    Array,
            },
        },
        data() {

            return {

                form: {

                    name:     null,
                    email:    null,
                    role:     'user',
                    password: null,
                    locale:   'en',
                },
            };
        },
        methods: {

            onSubmit() {

                let self = this;

                self.$http.post( self.url, self.form ).then( response => {


                    self.$parent.$emit( 'user-created', response.data.user );
                    self.$refs.newUserModal.hide();
                    self.form = {

                        name:     null,
                        email:    null,
                        role:     'user',
                        password: null,
                        locale:   'en',
                    };

                }, response => {

                    _.each( response.data.errors, function ( field, index ) {

                        self.spinner = false;

                        self.$toasted.show( field[ 0 ], {

                            type:      'error',
                            fullWidth: true,
                            duration:  5000,
                        } );
                    } );

                } );
            }
        },

    };
</script>

<style scoped>

</style>