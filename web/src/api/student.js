import {authedApi} from "@/api/api";

export function createStudentApi(schoolId, data) {
    return authedApi().post(`schools/${schoolId}/students`, data)
}

export function getSchoolInfo() {
    return authedApi().get('/students/school')
}

export function getSchoolTeachers() {
    return authedApi().get(`/students/teachers`)
}

export function getFollowingTeachers() {
    return authedApi().get(`/students/subscribes`)
}

export function followApi(teacherId) {
    return authedApi().post(`/students/subscribes/${teacherId}`)
}

export function unfollowApi(teacherId) {
    return authedApi().delete(`/students/unsubscribes/${teacherId}`)
}
