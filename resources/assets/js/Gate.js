/**
 * Here you should import all policies that you create and want to use through your application
 */
import DashboardPolicy from './Policies/DashboardPolicy';
import RouterPolicy from './Policies/RouterPolicy';
import AdminPolicy from './Policies/AdminPolicy';
import DeveloperPolicy from './Policies/DeveloperPolicy';


export default class Gate {
    constructor(user) {
        this.user = user;

        this.policies = {
            dashboard: DashboardPolicy,
            router: RouterPolicy,
            admin_policy: AdminPolicy,
            developer_policy: DeveloperPolicy,
        };
    }

    before() {
        return this.user.isAdmin || this.user.isDeveloper;
    }

    can(action, type, model = null) {
        if (this.before()) {
            return true;
        }

        if (this.policies[type][action] !== undefined) {

            return this.policies[type][action](this.user, model);
        }

        return false;


    }

    cant(action, type, model = null) {
        return !this.can(action, type, model);
    }

    hasAnyRole(roles) {

        if (roles === null || roles === undefined || roles === '') {

            return false;
        }

        if (Array.isArray(roles)) {

            roles.forEach(function (role) {

                if (this.user.role === role) {

                    return true;
                }
            });
        } else {

            if (this.user.role === role) {

                return true;
            }
        }

        return false;
    }
}