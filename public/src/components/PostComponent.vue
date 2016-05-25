<template>
  <article class="post">
    <div class="row">
        <div class="col-md-6 img">
          <img :src="post.image">
        </div>
        <div class="col-md-6 info">
          <div class="title_post"><h1 class="titre">{{ post.titre }}</h1></div>
          <div class="date"><span>Proposé par <b>{{ post.auteur }}</b> il y a <b>{{ post.date | fromNow }}</b></span><br></div>
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
        <a href="../post/{{post.id}}">
          <button>
              <span>Voir le post</span>
          </button>
        </a>
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
        comments: [],
        topics: []
      }
    }
    route: {
      data ({to}) {
        this.$http.get('topics').then(
          (response) => {
            this.topics = response.data
          },
          (response) => {
            console.log("topics all fail" + response);
          }

        )
      }
    }
  }


</script>