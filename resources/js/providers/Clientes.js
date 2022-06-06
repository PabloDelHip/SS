import axios from 'axios'
export default class Clientes {
    
    /**
     * Function to get
     * @return Promise
     */
     get () {
        return axios.get(`/api/v1/clientes/get`)
    }

    find(clave) {
        return axios.get(`/api/v1/clientes/find/${clave}`)
    }

}