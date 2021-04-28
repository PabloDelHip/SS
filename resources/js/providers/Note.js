import axios from 'axios'
export default class Note {

    /**
     * Function to get notes user
     * @return Promise
     */
    
    getNotesUser (id_user, entity = 'users') {
        return axios.get(`/api/v1/notes/user/get/${id_user}/${entity}`)

    }

    saveNote(formData) {
        return axios.post(`/api/v1/notes/user/save`, formData)
    }
}