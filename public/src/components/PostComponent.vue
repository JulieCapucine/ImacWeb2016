<template>
  <article class="post">
    <div class="row">
        <div class="col-md-6 img">
          <img :src="post.image">
        </div>
        <div class="col-md-6 info">
          <div class="title_post"><h1 class="titre">{{ post.titre }}</h1></div>
          <div class="date"><span>Proposé par {{ post.auteur }} il y a {{ post.date | fromNow }}</span><br></div>
          <div class="text">
            {{ post.texte }}
          </div>
          <div class="nb_likes">
            <span class="likes">
              {{ post.likes }} likes
            </span>
          </div>
        </div>
    </div>
    <div class="row">
      <div class="col-md-12 button_post">
        <button>
            <span>Voir le post</span>
        </button>
      </div>
    </div>
  </article>
  
</template>

<script>
  export default {
    name: "PostComponent",
    props: {
      post: Object
    },
    data () {
      return {
        comments: []
      }
    }
  }


</script>