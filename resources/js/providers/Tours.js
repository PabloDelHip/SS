import axios from 'axios'
export default class Tours {
    
    /**
     * Function to get
     * @return Promise
     */
     get () {
        return axios.get(`/api/v1/tours/get`)
    }

    find(clave) {
        return axios.get(`/api/v1/tours/find/${clave}`)
    }

}