import {authedApi} from "@/api/api";


export function createApi(name) {
    return authedApi().post('/schools', {name})
}

export function createTeacher(schoolId, data) {
    return authedApi().post(`/schools/${schoolId}/invites`, data)
}

export function listApi() {
    return authedApi().get('/schools')
}

export function approveApi(schoolId) {
    return authedApi().put(`/schools/approve/${schoolId}/pass`)
}
