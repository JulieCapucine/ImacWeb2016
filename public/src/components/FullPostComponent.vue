<template>
  <div class="header_rubrique">
    <h1>{{ post.titre }}</h1>
    <h3 class="title_rubrique">Proposé par {{post.auteur}} il y a {{ post.date | fromNow }}</h3>
  </div>
  <div class="row">
  <article class="post col-sm-10 col-sm-offset-1">
    <div class="row">
      <div class="col-sm-6 img">
        <img :src="post.image">
      </div>
      <div class="col-sm-6 info">
        <div class="text">
          {{ post.texte }}
        </div>
        <div class="nb_likes">
          <span class="likes">
            {{ post.likes }} likes
          </span>
        </div>
        <div class="list_tags">
          <div class="tag" v-for="tag in tags">
            <span>#{{ tag.nom }}</span>
          </div>
        </div>
      </div>
    </div>
  </article>

  <div class="comments col-sm-10 col-sm-offset-1">
    <h3 class="title_rubrique_com">Commentaires</h3>
    <div class="line"></div>
    <comment-component v-for="comment in comments" :comment="comment"></comment-component>
  </div>

</div>
</template>

<script>
  import CommentComponent from './CommentComponent.vue'
  export default {
    name: "FullPostComponent",
    components: { CommentComponent },
    props: {
      post: {
        type: Object,
        required: true,
      },
      comments: Array,
      tags: Array
    },
    ready () {
      // this.$http.get('post/' + this.post.id + "/comments").then(
      //   (response) => {
      //     this.comments = response.data
      //   },
      //   (response) => {
      //     console.log("comment " + this.post.id + " fail " + response);
      //   }
      // )
    }
  }
</script>