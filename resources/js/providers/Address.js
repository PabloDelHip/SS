import axios from 'axios'
export default class Address {
    /**
     * Function to get address of user
     * @return Promise
     */
    getAddress(id) {
        return axios.get(`/api/v1/address/${id}`)
    }

    createAddress(formData) {
        return axios.post(`/api/v1/address/create`, formData)
    }

    updateAddress(id, formData) {
        return axios.put(`/api/v1/address/update/${id}`, formData);
    }
}