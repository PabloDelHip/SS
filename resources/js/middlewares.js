import store from "./store";
import router from "./routes";
import axios from "axios";
import "./interceptors";
import Auth from "./providers/Auth";
import UserPermissions from "./providers/UserPermission";

const AuthResourse = new Auth();
const userPermissionResource = new UserPermissions();

let validate_jwt;

async function getUser() {
    return localStorage.getItem("data_user");
}

async function existToken() {
    if (await getUser()) {
        validate_jwt = true;
    } else {
        validate_jwt = false;
    }

    return validate_jwt;
}

router.beforeEach(async(to, from, next) => {
    let jwt = await existToken();
    let url = to.path.split("/");
    url = "/" + url[1];

    if (
        jwt === false &&
        to.path !== "/login" &&
        to.path !== "/restablecer-contrasena" &&
        url !== "/nueva-contrasena"
    ) {
        localStorage.removeItem("data_user");
        window.location.href = "/login";
    } else {
        if (
            jwt === true &&
            to.path === "/login" &&
            to.path === "/restablecer-contrasena" &&
            url === "/nueva-contrasena"
        ) {
            router.push({
                path: '/'
            });
        } else {
            if (await hasAccess(to)) {
                next();
            } else {
                router.push({
                    name: 'notauthorized'
                });
            }
        }
    }
});

async function hasAccess(to) {
    var user = null;
    if (await existToken()) {
        user = JSON.parse(await getUser()).user;
    }
    switch (to.name) {
        case 'Overview':
            return true;
        case 'ListUser':
        case 'CreateUser':
        case 'EditUser':
            var permission = await getPermissionModule("Usuarios");
            if (!permission.success) {
                return false;
            }
            permission = permission.data;
            switch (to.name) {
                case 'ListUser':
                    return permission.permission.read;
                case 'CreateUser':
                    return permission.permission.create;
                case 'EditUser':
                    return permission.permission.update || user.id;
            }
            break;
        case 'permisosUser':
            var permission = await getPermissionModule("Permisos");
            if (!permission.success) {
                return false;
            }
            permission = permission.data;
            return permission.permission.read;
        case 'ListVendor':
        case 'CreateVendor':
        case 'EditVendor':
            var permission = await getPermissionModule("Agencias");
            if (!permission.success) {
                return false;
            }
            permission = permission.data;
            switch (to.name) {
                case 'ListVendor':
                    if (user.vendor_id != null) {
                        return false;
                    }
                    return permission.permission.read;
                case 'CreateVendor':
                    if (user.vendor_id != null) {
                        return false;
                    }
                    return permission.permission.create;
                case 'EditVendor':
                    if (user.vendor_id != null && to.params.id != user.vendor_id) {
                        return false;
                    }
                    return permission.permission.update;
            }
            break;
        case 'profileVendor':
        case 'listContactsVendor':
        case 'createContactsVendor':
        case 'editContactsVendor':
            if (user.vendor_id != null && to.params.id != user.vendor_id) {
                return false;
            }
            break;
        case 'error':
        case 'internalError':
        case 'notfound':
        case 'notauthorized':
            return true;
    }
    return true;
} 

async function getPermissionModule(name) {
    var user = JSON.parse(await getUser()).user;

    var permission = (await userPermissionResource.UserPermissionsByModule(user.id, name)).data;
    return permission;
}