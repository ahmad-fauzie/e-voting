<template>
  <ul style="padding: 0px; list-style-type: none;">
    <li class="left clearfix" v-for="(message, index) in filteredGroup" :key="message.id">
      <div class="clearfix">
        <div class="d-flex justify-content-between align-items-start mb-2" style="background-color: #D6E4E5; border-radius: 10px; padding: 0.3rem 0.5rem 0 0.5rem;">
          <div>
            <div class="header">
              <strong>
                {{ message.user.name }}
              </strong>
            </div>
            <p style="margin-bottom: 0.5rem;">
              {{ message.message }}
            </p>
          </div>
          <div style="padding-bottom: 0.3rem;">
            <i class="bi bi-trash" v-if="user.level === 'admin' || message.user.id === user.id" @click="deleteMessageGroup(message.group_id)" style="height: fit-content; font-size: 15px; cursor: pointer;"></i>
          </div>
        </div>
          <ul style="list-style-type: none; padding-left: 1rem;">
            <li class="d-flex justify-content-between align-items-start mb-2" v-for="(repMessage, indexx) in filterReply(message.group_id)" v-if="indexx != 0" :key="repMessage.id" style="background-color: #BFEAF5; border-radius: 10px; padding: 0.3rem 0.5rem 0 0.5rem;">
              <div style="padding-right: 0.5rem;">
                <div class="clearfix">
                  <strong>{{ repMessage.user.name }}</strong>
                </div>
                <p style="margin-bottom: 0.5rem;">{{ repMessage.message }}</p>
              </div>
              <div style="padding-bottom: 0.3rem;">
                <i class="bi bi-trash" v-if="user.level === 'admin' || repMessage.user.id === user.id" @click="deleteMessage(repMessage.id)" style="height: fit-content; font-size: 15px; cursor: pointer;"></i>
              </div>
            </li>
          </ul>
        <div class="input-group" v-if="filterMessageId(user) <= 9">
          <input
            id="btn-input"
            type="text"
            name="reply"
            class="form-control input-sm"
            placeholder="Tulis pesan anda disini..."
            v-model="replyMessage[index]"
            @keyup.enter="sendMessage(message.group_id, index)"
          />
          
          <span class="input-group-btn">
            <button class="btn btn-primary btn-sm" id="btn-chat" @click="sendMessage(message.group_id, index)">
              Balas
            </button>
          </span>
        </div>
        <hr>
      </div>
    </li>
  </ul>
</template>

<script>

export default {
  props: ["user", "messages", "kandidat"],
  data() {
    return {
      replyMessage: {},
      last: 0,
    };
  },

  watch: {
    messages: {
      handler() {
        if (this.messages.length > 0){
          this.last = this.messages[this.messages.length - 1].id + 1;
        }
      },
      deep: true,
    },
  },

  computed: {
    filterMessages(){
      return this.messages.filter(message => {
        return message.kandidat_id == this.kandidat
      });
    },
    filteredGroup: function() {
        var filteredGroup = {}
        this.filterMessages.forEach(function(item) {
            if (!filteredGroup[item.group_id]) {
                filteredGroup[item.group_id] = item
            }
        })
        return filteredGroup
    },
  },
  
  methods: {
    sendMessage(group_id, index) {
      this.$emit("messagesent", {
        id: this.last,
        user: this.user,
        message: this.replyMessage[index],
        kandidat_id: this.kandidat,
        group_id: group_id,
      });
      this.replyMessage[index] = "";
    },
    filterReply(group_id) {
      return this.filterMessages.filter(message =>  {
        return message.group_id == group_id;
      })
    },
    filterMessageId(user){
      if(user.level === 'siswa'){
        let messages = this.filterMessages.filter(message => {
          return message.user.id == user.id;
        });
        return messages.length;
      }
      return 0;
    },
    initial(name){
      let rgx = new RegExp(/(\p{L}{1})\p{L}+/, 'gu');
      let initials = [...name.matchAll(rgx)] || [];
      initials = (
      (initials.shift()?.[1] || '') + (initials.pop()?.[1] || '')
      ).toUpperCase();
      return initials;
    },
    deleteMessage(message_id) {
      this.$swal({
        title: 'Apakah Kamu Yakin?',
        text: "Kamu tidak bisa mengembalikan pesan ini!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, hapus itu!'
      }).then((result) => {
        if (result.isConfirmed) {
          this.$emit("messagedelete", {
            id: message_id
          });
        }
      });
    },
    deleteMessageGroup(message_group){
      this.$swal({
        title: 'Apakah Kamu Yakin?',
        text: "Pesan Balasan Juga Akan Ikut Terhapus!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, hapus itu!'
      }).then((result) => {
        if (result.isConfirmed) {
          this.$emit("messagegroupdelete", {
            group_id: message_group
          });
        }
      });
    },
  },
};
</script>
