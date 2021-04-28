import axios from "axios";
export default class Vendor {
    getVendorList() {
        return axios.get(`/api/v1/vendors/get`);
    }

    getVendor(id) {
        return axios.get(`/api/v1/vendors/get/${id}`);
    }

    createVendor(formData) {
        return axios.post(`/api/v1/vendors/create`, formData);
    }

    deleteVendor(id_vendor) {
        return axios.delete(`/api/v1/vendors/delete/${id_vendor}`);
    }

    updateVendor(id, formData) {
        return axios.put(`/api/v1/vendors/put/${id}`, formData);
    }
}