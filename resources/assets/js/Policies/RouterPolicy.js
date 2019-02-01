export default class RouterPolicy {

    static admin_users(user) {

        return user.isAdmin;
    }
}