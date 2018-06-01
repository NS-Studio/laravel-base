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
               @click.prevent="onEdit(data.item, data.index)">Edit
        </b-btn>

        <b-btn @click.prevent="onDelete(data.item, data.index)"
               variant="danger">Delete
        </b-btn>

      </template>

      <template slot="table-caption">
        All users - {{ users.length }}
        <b-btn class="float-right text-white"
               v-b-modal.newUserModal
               variant="warning">New user
        </b-btn>
      </template>

    </b-table>

    <b-pagination align="center"
                  :total-rows="users.length"
                  :per-page="perPage"
                  v-model="currentPage" />

    <new-user-modal :url="urls.users.store"
                    :roles="roles"></new-user-modal>

    <edit-user-modal :url="urls.users.update"
                     :roles="roles"
                     :user="edit.user"
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
        data() {

            return {

                fields:      [

                    { key: 'name', label: 'Name', sortable: true },
                    { key: 'email', label: 'Email', sortable: true },
                    { key: 'role', label: 'Role', sortable: true },
                    { key: 'actions', label: 'Actions' },
                ],
                users:       [],
                urls:        {

                    users: {

                        list:   window.Laravel.urls.ajax.admin.users.list,
                        store:  window.Laravel.urls.ajax.admin.users.store,
                        update: window.Laravel.urls.ajax.admin.users.update,
                        delete: window.Laravel.urls.ajax.admin.users.delete,
                    }
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
            }
        },
        mounted() {

            let self = this;

            self.getUsers();

            self.$on( 'user-created', function ( user ) {

                self.users.push( user );
            } );
        }
    };
</script>

<style scoped>

</style>