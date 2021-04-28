import axios from 'axios'
export default class Nation {

    /**
     * Function to Getcountries
     * @return Promise
     */
    getCountries () {
        return axios.get(`/api/v1/countries/get`)
    }

    /**
     * Function to GetState
     * @return Promise
     */
    getState (id_country) {
        return axios.get(`/api/v1/states/get/${id_country}`)
    }

    /**
     * Function to GetCitys
     * @return Promise
     */
    getCity (id_state) {
        return axios.get(`/api/v1/citys/get/${id_state}`)
    }

}