<template>

    <b-modal id="editUserModal"
             hide-footer
             lazy
             :modal-class="'mt-5'"
             ref="editUserModal"
             @hidden="onHidden"
             :title="trans('__JSON__.Edit User')">

        <b-form @submit.prevent="onSubmit">

            <b-form-group :label="trans('__JSON__.Name')">

                <b-form-input type="text"
                              v-model="user.name"
                              required
                              :placeholder="trans('__JSON__.Enter user name')">
                </b-form-input>

            </b-form-group>

            <b-form-group :label="trans('__JSON__.Email')">

                <b-form-input type="email"
                              v-model="user.email"
                              required
                              :placeholder="trans('__JSON__.Enter email address')">
                </b-form-input>

            </b-form-group>

            <select-field :label="trans('__JSON__.Role')"
                          v-model="user.role"
                          :text-field="'name'"
                          :value-field="'value'"
                          :items="roles"></select-field>


            <select-field :label="trans('__JSON__.Locale')"
                          v-model="user.locale"
                          :text-field="'label'"
                          :value-field="'value'"
                          :items="locales"></select-field>

            <b-button type="submit"

                      variant="primary">{{ trans('__JSON__.Submit') }}
            </b-button>

        </b-form>
    </b-modal>
</template>

<script>
    export default {
        name: 'edit-user-modal',
        props: {

            url: {

                default: '',
                type: String,
            },
            roles: {

                default: [],
                type: Array,
            },
            editUser: {

                default: {},
                type: Object,
            },
            index: {

                default: null,
                type: Number,
            },
            locales: {

                default: [],
                type: Array,
            },
        },
        data() {

            return {

                user: {},
            };
        },
        methods: {

            onSubmit() {

                let self = this;
                let url = self.url.replace(':id', self.user.id);

                self.$http.put(url, self.user).then(response => {


                    self.$parent.$emit('user-edited', response.data.user, self.index);
                    self.$refs.editUserModal.hide();


                }, response => {

                    _.each(response.data.errors, function (field, index) {

                        self.$toasted.show(field[0], {

                            type: 'error',
                            fullWidth: true,
                            duration: 5000,
                        });
                    });

                });
            },
            onHidden() {

                this.editUser = {};
            }
        },
        watch: {

            'editUser': function () {

                this.user = Object.assign({}, this.editUser);
            }
        }
    };
</script>

<style scoped>

</style>