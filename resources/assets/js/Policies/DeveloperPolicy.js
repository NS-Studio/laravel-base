export default class DeveloperPolicy {

    static access(user) {

        return user.isDeveloper;
    }

}