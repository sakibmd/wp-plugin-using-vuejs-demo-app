<template>
  <div class="container">
    <h1 class="my-3 text-center">This is the plugin Dashboard</h1>

    <div class="row">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            Work Schedule Managing App
          </div>
          <br />
          <div class="card-header">
            <form @submit.prevent="saveTasks">
              <div class="form-group">
                <label for="newtask">Task</label>
                <input
                  type="text"
                  v-model="newtask"
                  class="form-control"
                  placeholder="enter new task"
                  id="newtask"
                />
              </div>
              <div class="form-group">
                <label for="date">Date</label>
                <input
                  type="date"
                  v-model="date"
                  class="form-control"
                  placeholder="date"
                  id="date"
                />
              </div>

              <button class="btn btn-success">Save</button>
            </form>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card " v-for="(task, index) in tasksList" :key="index">
          <div class="d-flex justify-content-between">
            <div><h3 class="font-weight-bold">Details</h3></div>
            <div>
              <a
                href=""
                class="dashicons dashicons-trash"
                @click.prevent="removeTask(index)"
              ></a>
            </div>
          </div>
          <h6><strong>Task: </strong> {{ task.taskname }}</h6>
          <h6><strong>Date: </strong> {{ task.taskdate }}</h6>
          <h6>
            <strong>Created: </strong> {{ task.createdAt.toLocaleString() }}
          </h6>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  mounted() {
    this.fetchdata();
    console.log('ss');
  },
  name: "Dashboard",
  data() {
    return {
      newtask: "",
      date: "",
      tasksList: [],
    };
  },
  methods: {


    fetchdata(){
                const data = {
                    action: 'add_todos_data',
                    route: 'get-todos'
                }
                this.$get(data)
                .then(res =>{
                  this.tasksList =  res.data.todos;
                  console.log(this.tasksList);  

                })
            },

    saveTasks() {
    
      const myNewTask = {
        taskname: this.newtask,
        taskdate: this.date,
        createdAt: new Date(),
      };
      jQuery
        .post(ajaxurl, {
          action: "add_todos_data",
          route: "add-todo",
          myNewTask: JSON.stringify(myNewTask),
        })
        .then((response) => {
          console.log(response.data.message)
        });

      this.newtask = "";
      this.date = "";
    },

    removeTask(index) {
      this.tasksList.splice(index, 1);
    },

    resetForm() {
      this.newtask = "";
      this.date = "";
    },
  },
};
</script>
