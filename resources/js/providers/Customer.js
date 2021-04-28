import axios from 'axios'
export default class Customer {

    /**
     * Function to SaveCustomers
     * @return Promise
     */
    saveCustomer (formData) {
        return axios.post(`/api/v1/customer/create`, formData)
    }

    /**
     * Function to SaveCustomers
     * @return Promise
     */
    updateCustomer (formData) {
        return axios.put(`/api/v1/customer/update/${formData.id}`, formData)
    }

    /**
     * Function to Get Customers
     * @return Promise
     */
    getListCustomer (id_provider) {
        return axios.get(`/api/v1/customer/get/list/${id_provider}`)
    }

    getCustomer (id_customer) {
        return axios.get(`/api/v1/customer/get/${id_customer}`)
    }

    deleteCustomer (id_customer) {
        return axios.delete(`/api/v1/customer/delete/${id_customer}`)
    }

}