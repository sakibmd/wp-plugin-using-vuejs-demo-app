<template>
  <div class="container" id="section">
    <div class="row">
      <div class="col-md-4">
        <div class="card">
          <h4>Get Github Details Easily</h4>
          <hr />
          <form @submit.prevent="get_details">
            <div class="form-group">
              <label for="username">Username:</label>
              <input
                placeholder="enter username"
                id="username"
                type="text"
                class="from-control"
                v-model="username"
              />
              <div class="buttons">
                <button type="submit" class="btn btn-success btn-sm">Get Details</button>
                <a href class="btn btn-warning btn-sm" @click.prevent="reset">Reset</a>
              </div>
            </div>
          </form>
        </div>
      </div>
      <div class="col-md-8" v-if="showresult">
        <div v-if="userinfo.name">
          <table class="table table-bordered mt-2">
            <tr>
              <th>Name</th>
              <td>{{ userinfo.name }}</td>
            </tr>
            <tr>
              <th>Profile Photo</th>
              <td>
                <img :src="userinfo.avatar_url" :alt="userinfo.name" height="250" width="250" />
              </td>
            </tr>
            <tr>
              <th>Username</th>
              <td>{{ userinfo.login }}</td>
            </tr>
            <tr>
              <th>Id</th>
              <td>{{ userinfo.id }}</td>
            </tr>
            <tr>
              <th>Email</th>
              <td>{{ userinfo.blog }}</td>
            </tr>
            <tr>
              <th>Organization</th>
              <td>{{ userinfo.company }}</td>
            </tr>
            <tr>
              <th>Location</th>
              <td>{{ userinfo.location }}</td>
            </tr>
            <tr>
              <th>Followers</th>
              <td>{{ userinfo.followers }}</td>
            </tr>
            <tr>
              <th>Following</th>
              <td>{{ userinfo.following }}</td>
            </tr>
            <tr>
              <th>Repository</th>
              <td>{{ userinfo.public_repos }}</td>
            </tr>
            <tr>
              <th>Twitter username</th>
              <td>{{ userinfo.twitter_username }}</td>
            </tr>
            <tr>
              <th>Account Created</th>
              <td>{{ userinfo.created_at.substring(0, 10) }}</td>
            </tr>
            <tr>
              <th>Repository</th>
              <td>{{ userinfo.public_repos }}</td>
            </tr>
          </table>
        </div>
        <div v-else>
          <div class="card">
            <h6>Invalid Result! Please Enter a valid username</h6>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      username: "",
      userinfo: [],
      showresult: false,
    };
  },
  methods: {
    get_details() {
      this.showresult = true;
      fetch("https://api.github.com/users/" + this.username)
        .then((res) => {
          return res.json();
        })
        .then((data) => {
          this.userinfo = data;
          console.log(this.userinfo.company);
        });
    },
    reset() {
      this.username = "";
      this.showresult = false;
      this.userinfo = [];
    },
  },
};
</script>

<style scoped>
</style>
