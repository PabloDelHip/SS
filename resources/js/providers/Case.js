import axios from 'axios'
export default class Case {
    
    /**
     * Function to getCase
     * @return Promise
     */
     getCase (id_case) {
        return axios.get(`/api/v1/cases/get/${id_case}`)
    }

    /**
     * Function to getCaseHistory
     * @return Promise
     */
     getCaseHistory (id_case) {
        return axios.get(`/api/v1/cases/history/get/${id_case}`)
    }

    /**
     * Function to getCaseHistory
     * @return Promise
     */
     createCaseHistory (formData) {
        return axios.post(`/api/v1/cases/history/create`, formData)
    }

    /**
     * Function to getCase
     * @return Promise
     */
     updateCase (id_case, formData) {
        return axios.put(`/api/v1/cases/update/${id_case}`, formData)
    }
    
    /**
     * Function to SaveCase
     * @return Promise
     */
     createCase (formData) {
        return axios.post(`/api/v1/cases/create`, formData)
    }

    /**
     * Function to Update Case
     * @return Promise
     */
     updateStatusCase (id_case , status) {
        return axios.put(`/api/v1/cases/${id_case}/status/${status}`)
    }

    /**
     * Function to getCasesVendors
     * @return Promise
     */
    getListCaseVendor ($id_vendor) {
        return axios.get(`/api/v1/cases/get/vendor/${$id_vendor}`)
    }

}