<template>
  <div class="card mb-3 border-0 shadow-sm">
    <div class="card-body d-flex flex-column">
      <div class="d-flex align-items-center mb-3">
        <img
          class="rounded mr-3 shadow-sm"
          width="45"
          :src="status.user_avatar"
          alt=""
        />
        <div class="">
          <h5 class="mb-1"> <a :href="status.user_link" v-text="status.user_name"></a></h5>
          <div class="small text-muted" v-text="status.ago"></div>
        </div>
      </div>
      <p class="card-text text-secondary" v-text="status.body"></p>
    </div>
    <div
      class="card-footer p-2 d-flex justify-content-between align-items-center"
    >
      <like-btn
        :url="`/statuses/${status.id}/likes`"
        :model="status"
        dusk="like-btn"
      ></like-btn>

      <div class="mr-2 text-secondary">
        <i class="far fa-thumbs-up"></i>
        <span dusk="likes-count">{{ status.likes_count }}</span>
      </div>
    </div>

    <div class="card-footer">
      <div v-for="comment in comments" :key="comment.id" class="mb-3">
        <div class="d-flex">
          <img
            :src="comment.user_avatar"
            :alt="comment.user_name"
            width="34"
            height="34"
            class="rounded shadow-sm mr-2"
          />

          <div class="flex-grow-1">
            <div class="card border-0 shadow-sm">
              <div class="card-body p-2 text-secondary">
                <a :href="comment.user_link"
                  ><strong>{{ comment.user_name }}</strong></a
                >||
                {{ comment.body }}
              </div>
            </div>
            <small
              class="float-right badge badge-primary badge-pill py-1 pc-2 mt-1"
              dusk="comment-likes-count"
              >
              <i class="fa fa-thumbs-up"></i>
              {{ comment.likes_count }}
            </small>
            <like-btn
              :url="`/comments/${comment.id}/likes`"
              :model="comment"
              dusk="comment-like-btn"
              class="comments-like-btn"
            ></like-btn>
          </div>
        </div>
      </div>
      <form v-if="isAuthenticated" @submit.prevent="addComment">
        <div class="d-flex align-items-center">
          <img
            :src="currentUser.user_avatar"
            :alt="currentUser.name"
            width="34"
            class="rounded shadow-sm mr-2"
          />
          <div class="input-group">
            <textarea
              v-model="newComment"
              name="comment"
              rows="1"
              placeholder="Escribe un comentario..."
              class="form-control border-0 shadow-sm"
              required
            ></textarea>
            <div class="input-group-append">
              <button dusk="comment-btn" class="btn btn-primary">Enviar</button>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import LikeBtn from "./LikeBtn";

export default {
  components: { LikeBtn },
  props: {
    status: {
      type: Object,
      required: true,
    },
  },
  data() {
    return {
      newComment: "",
      comments: this.status.comments,
    };
  },
  methods: {
    addComment() {
      axios
        .post(`/statuses/${this.status.id}/comments`, { body: this.newComment })
        .then((res) => {
          this.comments.push(res.data.data);
          this.newComment = "";
        })
        .catch((err) => {
          console.log(err.response.data);
        });
    },
  },
  mounted(){
      console.log(this.comments)
  }
};
</script>

<style>
</style>
