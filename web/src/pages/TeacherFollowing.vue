<template>
    <panel title="关注我的">
        <student-list-table api="following" :on-chat="onChat"></student-list-table>

        <chat :open="chatOpen"
              :teacher="chatTeacher"
              :student="chatStudent"
              @close="chatOpen = false"></chat>
    </panel>
</template>

<script>
    import Panel from "@/components/Panel";
    import StudentListTable from "@/components/StudentListTable";
    import Chat from "@/components/Chat";
    import {getUserInfo} from "@/utils/auth";

    export default {
        name: "TeacherFollowing",
        components: {Chat, StudentListTable, Panel},
        data() {
            return {
                chatOpen: false,
                chatTeacher: getUserInfo(),
                chatStudent: null,
            }
        },
        methods: {
            onChat(student) {
                this.chatStudent = student
                this.chatOpen = true
            },
            onClose() {
                this.chatOpen = false
            }
        }
    }
</script>

<style scoped>

</style>
