<template>
    <div>

        <b-row class="mt-2">

            <b-col>

                {{ trans('__JSON__.Users') }} - {{ users.length }}

                <new-button class="float-right"
                            v-b-modal.newUserModal></new-button>
            </b-col>

        </b-row>
        <b-table hover
                 caption-top
                 :fields="fields"
                 :items="users"
                 :per-page="perPage"
                 responsive
                 :stacked="isMobile"
                 :current-page="currentPage"
                 striped>

            <template slot="actions"
                      slot-scope="data">


                <b-btn-group>

                    <edit-button @clicked="onEdit(data.item, data.index)"></edit-button>
                    <delete-button @clicked="onDelete(data.item, data.index)"></delete-button>
                </b-btn-group>


            </template>

        </b-table>

        <b-pagination align="center"
                      :total-rows="users.length"
                      :per-page="perPage"
                      v-model="currentPage"/>

        <new-user-modal :url="urls.users.store"
                        :locales="locales"
                        :roles="roles"></new-user-modal>

        <edit-user-modal :url="urls.users.update"
                         :roles="roles"
                         :editUser="edit.user"
                         :locales="locales"
                         :index="edit.index"></edit-user-modal>

    </div>
</template>

<script>
    import NewUserModal from './NewUserModal';
    import EditUserModal from './EditUserModal';

    export default {
        components: {
            EditUserModal,
            NewUserModal
        },
        name: 'admin-users',
        title() {

            return trans('__JSON__.Users');
        },
        data() {

            return {

                fields: [

                    {key: 'id', label: '#', sortable: true},
                    {key: 'name', label: trans('__JSON__.Name'), sortable: true},
                    {key: 'email', label: trans('__JSON__.Email'), sortable: true},
                    {key: 'role', label: trans('__JSON__.Role'), sortable: true},
                    {key: 'locale', label: trans('__JSON__.Locale'), sortable: true},
                    {key: 'actions', label: trans('__JSON__.Actions')},
                ],
                users: [],
                urls: {

                    users: {

                        list: window.Laravel.urls.ajax.admin.users.list,
                        store: window.Laravel.urls.ajax.admin.users.store,
                        update: window.Laravel.urls.ajax.admin.users.update,
                        delete: window.Laravel.urls.ajax.admin.users.delete,
                    },
                },
                currentPage: 1,
                perPage: 100,
                edit: {

                    user: {},
                    index: null,
                },
                roles: [

                    {name: 'User', value: 'user'},
                    {name: 'Admin', value: 'admin'},
                ],
                locales: [

                    {
                        value: 'en',
                        label: 'English',
                    },
                    {
                        value: 'de',
                        label: 'Danish'
                    }
                ],
                pageTitle: trans('__JSON__.Users'),
            };
        },
        methods: {

            getUsers() {

                let self = this;

                self.$http.get(self.urls.users.list).then(response => {

                    self.users = response.data.users;
                });
            },
            onEdit(user, index) {

                this.edit.index = null;
                this.edit.user = {};
                this.edit.index = index;
                this.edit.user = user;

                this.$root.$emit('bv::show::modal', 'editUserModal');
            },
            onDelete(user, index) {

                let self = this;
                let url = self.urls.users.delete.replace(0, user.id);

                self.$http.delete(url).then(response => {

                    self.users.splice(index, 1);
                });
            },
        },
        mounted() {

            let self = this;

            this.getUsers();

            self.$on('user-created', function (user) {

                self.users.push(user);
            });
            self.$on('user-edited', function (user, index) {

                self.users.splice(index, 1, user);
            });
            this.$on('edit-button-clicked', (item, index) => {
                this.onEdit(item, index);
            });
        }
    };
</script>

<style scoped>

</style>