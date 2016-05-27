<template>
  <div class="comment col-sm-11 col-sm-offset-1">
    <div class="info">
      <span class="date">Publié le {{ comment.date }} par </span>
      <span class="author">{{ comment.auteur }}</span>
    </div>
    <div class="text">
      {{ comment.texte }}
    </div>

    <div class="sub-comments col-sm-10 col-sm-offset-2">
      <comment-component v-for='childComment in childComments' :comment='childComment' v-show="childComments != []">
    </div>

  </div>
</template>

<script>
  export default {
    name: "CommentComponent",
    props: {
      comment: Object
    },
    data () {
      return {
        childComments: []
      }
    },
    ready () {
      console.log(this.comment)
      //let ids = _.map(this.comment.childComments, _.property('id'))
      this.$http.get('comment/' + this.comment.id).then(
        (response) => {
          this.childComments = response.data
        },
        (response) => {
          console.log("fetching subcomments failed")
        }
      )
    }
  }
</script>