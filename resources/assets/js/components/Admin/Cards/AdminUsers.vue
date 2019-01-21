<template>
  <div>

    <b-table hover
             caption-top
             :fields="fields"
             :items="users"
             :per-page="perPage"
             :current-page="currentPage"
             striped>

      <template slot="actions"
                slot-scope="data">


        <b-btn variant="primary"
               @click.prevent="onEdit(data.item, data.index)">{{ trans.get('__JSON__.Edit') }}
        </b-btn>

        <b-btn @click.prevent="onDelete(data.item, data.index)"
               variant="danger">{{ trans.get('__JSON__.Delete') }}
        </b-btn>

      </template>

      <template slot="table-caption">
        {{ trans.get('__JSON__.All users') }} - {{ users.length }}
        <b-btn class="float-right text-white"
               v-b-modal.newUserModal
               variant="warning">{{ trans.get('__JSON__.New user') }}
        </b-btn>
      </template>

    </b-table>

    <b-pagination align="center"
                  :total-rows="users.length"
                  :per-page="perPage"
                  v-model="currentPage" />

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
        name:       'admin-users',
        title() {

            return this.trans.get( '__JSON__.Users' );
        },
        data() {

            return {

                fields:      [

                    { key: 'id', label: '#', sortable: true },
                    { key: 'name', label: this.trans.get( '__JSON__.Name' ), sortable: true },
                    { key: 'email', label: this.trans.get( '__JSON__.Email' ), sortable: true },
                    { key: 'role', label: this.trans.get( '__JSON__.Role' ), sortable: true },
                    { key: 'locale', label: this.trans.get( '__JSON__.Locale' ), sortable: true },
                    { key: 'actions', label: this.trans.get( '__JSON__.Actions' ) },
                ],
                users:       [],
                urls:        {

                    users: {

                        list:   window.Laravel.urls.ajax.admin.users.list,
                        store:  window.Laravel.urls.ajax.admin.users.store,
                        update: window.Laravel.urls.ajax.admin.users.update,
                        delete: window.Laravel.urls.ajax.admin.users.delete,
                    },
                },
                currentPage: 1,
                perPage:     100,
                edit:        {

                    user:  {},
                    index: null,
                },
                roles:       [

                    { name: 'User', value: 'user' },
                    { name: 'Admin', value: 'admin' },
                ],
                locales:     [

                    {
                        value: 'en',
                        label: 'English',
                    },
                    {
                        value: 'de',
                        label: 'Danish'
                    }
                ],
                pageTitle:   this.trans.get( '__JSON__.Users' ),
            };
        },
        methods:    {

            getUsers() {

                let self = this;

                self.$http.get( self.urls.users.list ).then( response => {

                    self.users = response.data.users;
                } );
            },
            onEdit( user, index ) {

                this.edit.index = null;
                this.edit.user = {};
                this.edit.index = index;
                this.edit.user = user;

                this.$root.$emit( 'bv::show::modal', 'editUserModal' );
            },
            onDelete( user, index ) {

                let self = this;
                let url = self.urls.users.delete.replace( 0, user.id );

                self.$http.delete( url ).then( response => {

                    self.users.splice( index, 1 );
                } );
            },
        },
        mounted() {

            let self = this;

            this.getUsers();

            self.$on( 'user-created', function ( user ) {

                self.users.push( user );
            } );
            self.$on( 'user-edited', function ( user, index ) {

                self.users.splice( index, 1, user );
            } );
        }
    };
</script>

<style scoped>

</style>