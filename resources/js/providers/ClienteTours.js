import axios from 'axios'
export default class ClienteTours {
    
    /**
     * Function to get
     * @return Promise
     */
    get () {
      return axios.get(`/api/v1/clients_tours/get`)
    }

    getTours (clave) {
      return axios.get(`/api/v1/clients_tours/tours/${clave}`)
    }

    find(clave) {
        return axios.get(`/api/v1/clients_tours/find/${clave}`)
    }
    create(params) {
      return axios.post(`/api/v1/clients_tours/create`, params);
    }

    delete(clave) {
      return axios.delete(`/api/v1/clients_tours/delete/${clave}`);
    }

    update(params, clave) {
      return axios.put(`/api/v1/clients_tours/update/${clave}`, params);
    }

}