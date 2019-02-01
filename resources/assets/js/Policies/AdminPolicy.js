export default class AdminPolicy {

    static access( user ) {

        return user.isAdmin;
    }

}