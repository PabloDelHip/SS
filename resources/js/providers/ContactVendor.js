import axios from "axios";
export default class ContactVendor {
    /**
     * Function to Get current user
     * @return Promise
     */
    getContactsByVendorId(id) {
        return axios.get(`/api/v1/contactsvendors/vendorId/${id}`);
    }

    createContactVendor(formData) {
        return axios.post(`/api/v1/contactsvendors/create`, formData);
    }
}