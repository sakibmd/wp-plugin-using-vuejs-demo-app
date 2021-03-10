<template>
  <div class="container">
    <h1 class="my-3 text-center">Work Schedule Managing App</h1>

    <div class="row">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header bg-success text-white">
            <div class="d-flex justify-content-between">
              <div>
                <h4 v-if="!editedId">Add New Task</h4>
                <h4 v-else>Update Task</h4>
              </div>
              <div>
                <a
                  href=""
                  class="btn btn-sm btn-warning float-right"
                  @click.prevent="resetForm()"
                  >Reset</a
                >
              </div>
            </div>
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

              <button v-if="!editedId" class="btn btn-success">Save</button>
              <button v-else class="btn btn-success">Update</button>
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
                class="dashicons dashicons-edit"
                @click.prevent="editTodo(index)"
              ></a>
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
  name: "Dashboard",

  data() {
    return {
      newtask: "",
      date: "",
      tasksList: [],
      editedId: null,
    };
  },
  mounted() {
    this.fetchdata();
  },
  methods: {
    editTodo(index) {
      //console.log(index);

      this.newtask = this.tasksList[index].taskname;
      this.date = this.tasksList[index].taskdate;
      this.editedId = this.tasksList[index].id;
    },

    fetchdata() {
      const data = {
        action: "add_todos_data",
        route: "get-todos",
      };
      this.$get(data).then((res) => {
        this.tasksList = res.data.todos;
        //console.log(this.tasksList);
      });
    },

    saveTasks() {
      const myNewTask = {
        taskname: this.newtask,
        taskdate: this.date,
        createdAt: new Date(),
        editedId: this.editedId,
      };
      jQuery
        .post(ajaxurl, {
          action: "add_todos_data",
          route: "add-todo",
          myNewTask: JSON.stringify(myNewTask),
        })
        .then((response) => {
          //console.log(response.data.message);
          this.fetchdata();
        });

      this.newtask = "";
      this.date = "";
      this.editedId = null;
    },

    removeTask(index) {
      const deleteInfo = {
        deletedId: this.tasksList[index].id,
      };
      jQuery
        .post(ajaxurl, {
          action: "add_todos_data",
          route: "delete-todo",
          id: JSON.stringify(deleteInfo),
        })
        .then((response) => {
          //console.log(response.data.message);
          this.fetchdata();
        });
    },

    resetForm() {
      this.newtask = "";
      this.date = "";
      this.editedId = null;
    },
  },
};
</script>
