<template>
  <ul style="padding: 0px; list-style-type: none;">
    <li class="left clearfix" v-for="(message, index) in filteredGroup" :key="message.id">
      <div class="clearfix">
        <div class="d-flex justify-content-between align-items-start mb-2" style="border-radius: .267rem; box-shadow: 0 2px 6px 0 rgba(0,0,0,.3); background: #5a8dee; color: #fff; padding: 0.3rem 0.5rem 0 0.5rem;">
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
            <li class="d-flex justify-content-between align-items-start mb-2" v-for="(repMessage, indexx) in filterReply(message.group_id)" v-if="indexx != 0" :key="repMessage.id" style="background-color: #fafbfb; box-shadow: 0 2px 6px 0 rgba(0,0,0,.3); border-radius: .267rem; color: #525361; padding: 0.3rem 0.5rem 0 0.5rem;">
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
            <button class="btn btn-primary btn-sm d-flex" id="btn-chat" @click="sendMessage(message.group_id, index)">
              <i class="bi bi-cursor d-block h-auto"></i><span class="d-none d-md-block ps-1">Balas</span>
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
  props: ["user", "messages", "kandidats"],
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
        console.log(this.kandidats.id);
        return message.kandidat_id == this.kandidats.id
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
      console.log(this.last);
      this.$emit("messagesent", {
        id: this.last,
        user: this.user,
        message: this.replyMessage[index],
        kandidat_id: this.kandidats.id,
        group_id: group_id,
      });
      console.log(this.messages);
      this.replyMessage[index] = "";
    },
    filterReply(group_id) {
      return this.filterMessages.filter(message =>  {
        return message.group_id == group_id;
      })
    },
    filterMessageId(user){
      if(user.level === 'siswa' && user.nis !== this.kandidats.nis){
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
      console.log(message_id);
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
