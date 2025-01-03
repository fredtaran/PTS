<!-- <script setup>
import { onMounted, ref } from 'vue';
import ChatApp from './ChatApp.vue';

const user = ref()

onMounted(() => {
    user.value = JSON.parse(document.getElementById('user').value)
})
</script> -->

<template>
    <ChatApp></ChatApp>
</template>

<script>
import ChatApp from './ChatApp.vue';
export default {
    data() {
        return {
            user: null
        }
    },
    mounted() {
        this.user = JSON.parse(document.getElementById('user').value)
        // console.log(this.user)
    },
    components: {
        ChatApp
    }
}
</script>