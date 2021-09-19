import {authedApi} from "@/api/api";

export function listFollowingApi(pageNumber = 0) {
    return authedApi().get('/teachers/students/subscribe', {
        params: {pageNumber}
    })
}

export function listTeachingApi(pageNumber = 0) {
    return authedApi().get('/teachers/students', {
        params: {pageNumber}
    })
}
