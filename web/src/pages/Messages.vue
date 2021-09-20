<template>
    <panel title="我的消息">
        <li v-for="(message, idx) in messages" :key="idx">
            {{ message }}
        </li>
    </panel>
</template>

<script>
    import Panel from "@/components/Panel";
    import {createEcho} from "@/utils/echo";

    export default {
        name: "Messages",
        components: {Panel},
        data() {
            return {
                messages: [],
            }
        },
        created() {
            createEcho()
                .channel('my-channel')
                .listen('', function (data) {
                    alert(JSON.stringify(data));
                    this.messages.push(JSON.stringify(data));
                });
        }
    }
</script>

<style scoped>

</style>
