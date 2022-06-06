import axios from 'axios'
export default class Hoteles {
    
    /**
     * Function to get
     * @return Promise
     */
     get () {
        return axios.get(`/api/v1/hotels/get`)
    }

    find(clave) {
        return axios.get(`/api/v1/hotels/find/${clave}`)
    }
    
}