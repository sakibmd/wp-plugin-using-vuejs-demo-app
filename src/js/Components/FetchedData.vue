<template>
  <div class="container" id="section">
    <h2 class="text-center my-5">All Posts List With Details</h2>

    <div
      class="row single-post col-md-12 card"
      v-for="(post, index) in posts"
      :key="index"
    >
      <div class="card-title">
        <span class="title">Title</span>
        {{ post.title }}
      </div>
      <hr />
      <div class="card-body">
        <span class="title">Description</span>
        {{ post.body }}
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      posts: [],
    };
  },
  mounted() {
    this.fetchData();
  },
  methods: {
    fetchData() {
      fetch("https://jsonplaceholder.typicode.com/posts")
        .then((res) => {
          console.log(res);
          return res.json();
        })
        .then((data) => {
          this.posts = data;
          console.log(this.posts);
        });
    },
  },
};
</script>

<style scoped>
.card {
  text-transform: capitalize;
}
span .title {
  font-weight: bold;
  font-size: 15px;
}

.row {
  width: 100%;
}
</style>
