<template>
  <div class="chat-app">
    <Conversation
      :contact="selectedContact"
      :messages="messages"
      @new="saveNewMessage"
    />
    <ContactsList :contacts="contacts" @selected="startConversationWith" />
  </div>
</template>

<script>
import Conversation from "./Conversation.vue";
import ContactsList from "./ContactsList.vue";
import axios from "axios";
export default {
  data() {
    return {
      selectedContact: null,
      messages: [],
      contacts: [],
      user: null,
    };
  },
  mounted() {
    // console.log("wwwww!");
    const self = this
    this.user = JSON.parse(document.getElementById('user').value)
    channel.bind('chat', function(data) {
      self.handleIncoming(data.message);
    })
    axios.get("contacts").then((response) => {
      this.contacts = response.data;
    });
  },
  methods: {
    startConversationWith(contact) {
      this.updateUnreadCount(contact, true);
      axios.get(`conversation/${contact.id}`).then((response) => {
        this.messages = response.data;
        this.selectedContact = contact;
      });
    },
    saveNewMessage(message) {
      this.messages.push(message);
    },
    handleIncoming(message) {
      // console.log(message);
      if (this.selectedContact && message.from == this.selectedContact.id) {
        this.saveNewMessage(message);
        return;
      }
      this.updateUnreadCount(message.from_contact, false);
    },
    updateUnreadCount(contact, reset) {
      this.contacts = this.contacts.map((single) => {
        if (single.id !== contact.id) {
          return single;
        }
        if (reset) single.unread = 0;
        else single.unread += 1;
        return single;
      });
    },
  },
  components: { Conversation, ContactsList },
};
</script>

<style scoped>
.chat-app {
  display: flex;
}
</style>
