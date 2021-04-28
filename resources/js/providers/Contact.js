import axios from 'axios'
export default class Contact {
    /**
     * Function to get Contact of user
     * @return Promise
     */
    getContact(id) {
        return axios.get(`/api/v1/contact/${id}`)
    }

    getContactVendors(id) {
        return axios.get(`/api/v1/contact/vendors/${id}`)
    }

    createContact(formData) {
        return axios.post(`/api/v1/contact/create`, formData)
    }

    updateContact(id, formData) {
        return axios.put(`/api/v1/contact/update/${id}`, formData);
    }

    UpdateStatusContact(id_user, status) {
        return axios.put(`/api/v1/contact/block/${id_user}/${status}`)
    }
}