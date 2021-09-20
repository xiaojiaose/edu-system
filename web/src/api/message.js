import {authedApi} from "@/api/api";


export function studentTalk(teacherId, content) {
    return authedApi().post(`/talk/student/${teacherId}`, {content})
}

export function teacherTalk(studentId, content) {
    return authedApi().post(`/talk/teacher/${studentId}`, {content})
}
