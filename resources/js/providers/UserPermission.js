import axios from 'axios'
export default class UserPermission {

    /**
     * Function to Get current user
     * @return Promise
     */

    UserPermissions(id) {
        return axios.get(`/api/v1/users/permission/${id}`);
    }

    UserPermissionsByModule(id, nameModule) {
        return axios.get(`/api/v1/users/permission/${id}/${nameModule}`);
    }

    updatePermits(formData) {
        return axios.put(`/api/v1/users/permission/put`, formData);
    }
}