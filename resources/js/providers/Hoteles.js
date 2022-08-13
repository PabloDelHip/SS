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

    update(params, clave) {
        return axios.put(`/api/v1/hotels/update/${clave}`, params);
    }

    delete(clave) {
        return axios.delete(`/api/v1/hotels/delete/${clave}`);
    }

    create(params) {
        return axios.post(`/api/v1/hotels/create`, params);
    }
    
}