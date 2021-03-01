<template>
  <div>
    <form @submit.prevent="submit" v-if="isAuthenticated">
      <div class="card-body">
        <textarea
          name="body"
          v-model="body"
          class="form-control border-0 bg-light"
          :placeholder="`Qué estás pensando ${currentUser.name}?`"
        ></textarea>
      </div>
      <div class="card-footer">
        <button id="create-status" class="btn btn-primary">
          <i class="fa fa-paper-plane mr-1"></i>
          Publicar
        </button>
      </div>
    </form>
    <div v-else class="card-body">
      <a href="/login">Login</a>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      body: "",
    };
  },
  methods: {
    submit() {
      axios
        .post("/statuses", { body: this.body })
        .then((res) => {
          this.emitter.emit("status-created", res.data.data);
          this.body = "";
        })
        .catch((err) => {
          console.log(err.response.data);
        });
    },
  },
};
</script>

<style>
</style>