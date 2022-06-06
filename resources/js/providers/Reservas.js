import axios from 'axios'
export default class Reservas {
    
    /**
     * Function to save
     * @return Promise
     */
     create(formData) {
        return axios.post(`/api/v1/reservas`, formData);
    }

    update(formData, clave) {
        return axios.put(`/api/v1/reservas/put/${clave}`, formData);
    }

    find(fecha) {
        return axios.get(`/api/v1/reservas/${fecha}`)
    }

    findReservas(clave) {
        return axios.get(`/api/v1/reservas/info/${clave}`)
    }
}