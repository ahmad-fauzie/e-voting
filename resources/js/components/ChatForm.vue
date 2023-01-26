<template>
  <div v-if="filterMessageId(user) <= 9">
    <div class="alert alert-light-warning color-warning" style="padding-bottom: 0.1rem;">
      <p class="m-0" style="font-size: 13px;">
  Peraturan:
  <ol style="padding-left: 0.8rem; line-height: 100%;">
    <li>Tidak boleh berkata kasar</li>
    <li>Jawaban harus sesuai dengan topik pembicaraan</li>
    <li>Maksimal 10x mengirim pesan</li>
  </ol></p>
    </div>
    <div class="input-group">
      <input
        id="btn-input"
        type="text"
        name="message"
        class="form-control input-sm"
        placeholder="Tulis pesan anda disini..."
        v-model="newMessage"
        @keyup.enter="sendMessage"
      />
      
      <span class="input-group-btn">
        <button class="btn btn-primary btn-sm d-flex" id="btn-chat" @click="sendMessage">
          <i class="bi bi-cursor d-block h-auto"></i><span class="d-none d-md-block ps-1">Kirim</span>
        </button>
      </span>
    </div>

  </div>
  
  <div v-else class="alert alert-light-warning color-warning"><i class="bi bi-exclamation-circle me-1"></i> Kamu telah mencapai batas pengiriman pesan 10x. Hapus pesan lama jika ingin mengirim pesan baru.</div>
</template>

<script>
export default {
  props: ["user", "kandidat", "messages"],

  data() {
    return {
      newMessage: "",
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
  },

  methods: {
    sendMessage() {
      this.$emit("messagesent", {
        id: this.last,
        user: this.user,
        message: this.newMessage,
        kandidat_id: this.kandidat,
        group_id: this.filteredLastGroup(this.messages),
      });
      this.newMessage = "";
    },
    filteredLastGroup(messagess) {
      var latestGroupId = 0;
      messagess.forEach(function(item) {
        if (item.group_id > latestGroupId) {
          latestGroupId = item.group_id;
        }
      });
      return latestGroupId + 1;
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
    
  },
};

</script>