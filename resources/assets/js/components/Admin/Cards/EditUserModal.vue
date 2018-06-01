<template>

  <b-modal id="editUserModal"
           hide-footer
           lazy
           ref="editUserModal"
           title="Edit User">

    <b-form @submit.prevent="onSubmit">

      <b-form-group label="Name:">

        <b-form-input type="text"
                      v-model="user.name"
                      required
                      placeholder="Enter user name">
        </b-form-input>

      </b-form-group>

      <b-form-group label="Email:">

        <b-form-input type="email"
                      v-model="user.email"
                      required
                      placeholder="Enter email address">
        </b-form-input>

      </b-form-group>

      <b-form-group label="Role:">

        <b-form-select v-model="user.role"
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
</template>

<script>
    export default {
        name:    'edit-user-modal',
        props:   {

            url:   {

                default: '',
                type:    String,
            },
            roles: {

                default: [],
                type:    Array,
            },
            user:  {

                default: {},
                type:    Object,
            },
            index: {

                default: null,
                type:    Number,
            }
        },
        methods: {

            onSubmit() {

                let self = this;
                let url = self.url.replace( 0, self.user.id );

                self.$http.put( url, self.user ).then( response => {


                    self.$parent.$emit( 'user-edited', response.data.user, self.index );
                    self.$refs.editUserModal.hide();


                }, response => {

                    _.each( response.data.errors, function ( field, index ) {

                        self.$toasted.show( field[ 0 ], {

                            type:      'error',
                            fullWidth: true,
                            duration:  5000,
                        } );
                    } );

                } );
            },
        },
    };
</script>

<style scoped>

</style>