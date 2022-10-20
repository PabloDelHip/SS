import axios from 'axios'
export default class Gastos {
    
    /**
     * Function to get
     * @return Promise
     */
     getClaveClientesTours (clave_clientes_tours) {
        return axios.get(`/api/v1/gastos/get/by-clave-clientes-tours/${clave_clientes_tours}`)
    }

    create(params) {
        return axios.post(`/api/v1/gastos/create`, params)
    }

    delete(clave) {
        return axios.delete(`/api/v1/gastos/delete/${clave}`);
    }

    update(params, clave) {
        return axios.put(`/api/v1/gastos/update/${clave}`, params);
    }

    find(clave) {
        return axios.get(`/api/v1/gastos/find/${clave}`)
    }

}