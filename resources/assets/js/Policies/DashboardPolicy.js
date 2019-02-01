export default class DashboardPolicy {

    static access( user ) {

        return user.isAdmin || user.isUser;
    }

}