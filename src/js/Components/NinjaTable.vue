<template>
  <div class="container" id="section">
    <h2 class="text-center my-5">Our Team</h2>
    <div class="row search-area">
      <div class="col-md-6">
        <div class="form-group">
          <label>Marital Status</label><br />
          <select
            v-model="position_wise_search"
            class="form-control"
            @change="searchResult()"
          >
            <option value="all">All Position</option>
            <option value="sfd">Software Developer</option>
            <option value="sfe">Software Engineer</option>
            <option value="spe">Support Engineer</option>
            <option value="tl">Team Leader</option>
            <option value="dm">Digital Marketer</option>
          </select>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label>Country</label><br />
          <select
            class="form-control"
            v-model="country_wise_search"
            @change="searchResult()"
          >
            <option value="all">All</option>
            <option value="bangladesh">Bangladesh</option>
            <option value="india">India</option>
            <option value="germany">Germany</option>
          </select>
        </div>
      </div>
    </div>
    <div class="row">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Name</th>
            <th>Position</th>
            <th>Age</th>
            <th>Country</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(person, index) in result" :key="index">
            <td>{{ person.name }}</td>
            <td>{{ person.position }}</td>
            <td>{{ person.age }}</td>
            <td class="capitalized">{{ person.country }}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
  <!-- 
    Software Developer = sfd
    Software Engineer = sfe
    Support Engineer = spe
    Digital Marketer = dm
    Team Leader = tl 
-->
</template>

<script>
export default {
  data() {
    return {
      result: [],
      position_wise_search: "all",
      country_wise_search: "all",
      tabledata: [
        {
          name: "Sakib Mohammed",
          position: "Software Developer",
          position_slug: "sfd",
          age: 24,
          country: "bangladesh",
        },
        {
          name: "Sumon Sarkar",
          position: "Software Developer",
          position_slug: "sfd",
          age: 28,
          country: "india",
        },
        {
          name: "Jafor Ahmed",
          position: "Support Engineer",
          position_slug: "spe",
          age: 30,
          country: "bangladesh",
        },
        {
          name: "Uthpol Deb Nath",
          position: "Software Developer",
          position_slug: "sfd",
          age: 29,
          country: "india",
        },
        {
          name: "Ruhen Khan",
          position: "Software Engineer",
          position_slug: "sfe",
          age: 40,
          country: "germany",
        },
        {
          name: "Lahin Ahmed",
          position: "Software Engineer",
          position_slug: "sfe",
          age: 28,
          country: "bangladesh",
        },
        {
          name: "Sadiq Ahmed",
          position: "Digital Marketer",
          position_slug: "dm",
          age: 30,
          country: "bangladesh",
        },
        {
          name: "Kawsar Chy",
          position: "Digital Marketer",
          position_slug: "dm",
          age: 35,
          country: "bangladesh",
        },
        {
          name: "Touhid Ahmed",
          position: "Digital Marketer",
          position_slug: "dm",
          age: 28,
          country: "bangladesh",
        },
        {
          name: "Shahjahan Juwel",
          position: "Team Leader / Guide",
          position_slug: "tl",
          age: 32,
          country: "bangladesh",
        },
        {
          name: "Mahmudul Arif",
          position: "Team Leader / Guide",
          position_slug: "tl",
          age: 33,
          country: "bangladesh",
        },
        {
          name: "Sheikh Hira",
          position: "Team Leader / Guide",
          position_slug: "tl",
          age: 48,
          country: "germany",
        },
      ],
    };
  },
  created() {
    this.result = this.tabledata;
  },
  methods: {
    searchResult() {

       
      if (
        this.position_wise_search == "all" &&
        this.country_wise_search == "all"
      ) {
        this.result = this.tabledata;
      } else {
        if (
          this.position_wise_search != "all" &&
          this.country_wise_search != "all"
        ) {
          this.result = this.tabledata.filter((el) => {
            return (
              el.position_slug == `${this.position_wise_search}` &&
              el.country == `${this.country_wise_search}`
            );
          });
        } else if (
          this.position_wise_search == "all" &&
          this.country_wise_search != "all"
        ) {
          this.result = this.tabledata.filter((el) => {
            return el.country == `${this.country_wise_search}`;
          });
        } else if (
          this.position_wise_search != "all" &&
          this.country_wise_search == "all"
        ) {
          this.result = this.tabledata.filter((el) => {
            return el.position_slug == `${this.position_wise_search}`;
          });
        }
      }
    },
  },
};
</script>

<style scoped>
.search-area {
  justify-content: center;
}
.capitalized {
  text-transform: capitalize;
}
</style>
