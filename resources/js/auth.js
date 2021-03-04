export default class Auth {

    constructor(user) {
        this.user = user;
    }

    infoUser()
    {
        return this.user.user;
    }

    roles() {
        return this.user.roles.map(role => role.name);
        // return this.user.roles;
    }

    permissions() {
        return this.user.permission.map(permission => permission.name);
        // return this.user.permissions;
    }

    isAdmin() {
        return this.roles().includes("Admin");
    }

    can($permissionName) {
        return this.permissions().includes($permissionName);
    }
}
