<template>
    <div class="conversation">
        <h1>{{ contact ? contact.name : 'Select a Contact' }}</h1>
        <MessagesFeed :contact="contact" :messages="messages"/>
        <MessageComposer @send="sendMessage"/>
    </div>
</template>

<script>
    import MessagesFeed from './MessagesFeed.vue';
    import MessageComposer from './MessageComposer.vue';
    import axios from 'axios';
    export default {
        props: {
            contact: {
                type: Object,
                default: null
            },
            messages: {
                type: Array,
                default: []
            }
        },
        methods: {
            sendMessage(text) {
                if (!this.contact) {
                    return;
                }
                axios.post('conversation/send', {
                    contact_id: this.contact.id,
                    text: text
                }, {
                    headers: {
                        'Accept': 'application/json',
                        'X-Socket-Id': pusher.connection.socket_id
                    }
                }).then((response) => {
                    this.$emit('new', response.data);
                })
            },
        },
        components: { MessagesFeed, MessageComposer }
    }
</script>

<style scoped>
    .conversation {
        flex: 5;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        h1 {
            font-size: 20px;
            padding: 10px;
            margin: 0;
            border-bottom: 1px dashed lightgray;
        }
    }
</style>