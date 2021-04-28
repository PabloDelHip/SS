import axios from "axios";
export default class Auth {
    /**
     * Function to logout
     * @return Promise
     */
    logout() {
        return axios.get(`/api/v1/auth/logout`);
    }

    me() {
        return axios.get(`/api/v1/me`);
    }

    login(formData) {
        return axios.post(`/api/v1/auth/login`, formData);
    }
}