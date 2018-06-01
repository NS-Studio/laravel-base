<template>
  <div>

    <b-modal id="newUserModal"
             hide-footer
             ref="newUserModal"
             title="Create new User">

      <b-form @submit.prevent="onSubmit">

        <b-form-group label="Name:">

          <b-form-input type="text"
                        v-model="form.name"
                        required
                        placeholder="Enter user name">
          </b-form-input>

        </b-form-group>

        <b-form-group label="Email:">

          <b-form-input type="email"
                        v-model="form.email"
                        required
                        placeholder="Enter email address">
          </b-form-input>

        </b-form-group>

        <b-form-group label="Password:">

          <b-form-input type="password"
                        v-model="form.password"
                        required
                        placeholder="Enter user's password">
          </b-form-input>

        </b-form-group>

        <b-form-group label="Role:">

          <b-form-select v-model="form.role"
                         :options="roles"
                         :text-field="'name'"
                         :value-field="'value'"
          />

        </b-form-group>

        <b-button type="submit"

                  variant="primary">Submit
        </b-button>

      </b-form>

    </b-modal>

  </div>
</template>

<script>

    export default {

        name: 'new-user-modal',

        props:   {

            url:   {

                default: '',
                type:    String,
            },
            roles: {

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

                        name:  null,
                        email: null,
                        role:  'user',
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