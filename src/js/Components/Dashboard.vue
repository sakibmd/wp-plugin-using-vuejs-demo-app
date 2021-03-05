<template>
  <div class="container">
    <h1 class="my-3 text-center">This is the plugin Dashboard</h1>

    <div class="row">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">Work Schedule Managing App<a href="" @click.prevent="resetForm()" class="btn btn-sm btn-warning float-right">Reset</a></div>
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


              <button v-if="edit" class="btn btn-success">Update</button>
              <button v-else class="btn btn-success">Save</button>
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
              <a
                href=""
                class="dashicons dashicons-edit"
                @click.prevent="editTask(index)"
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
      edit: false,
      editedId: null,

      newtask: "",
      date: "",
      tasksList: [
        {
          taskname: "Read WP Plugin Development",
          taskdate: "2021-03-07",
          createdAt: new Date(),
        },

        {
          taskname: "Go To Passport Office",
          taskdate: "2021-03-12",
          createdAt: new Date(),
        },

        {
          taskname: "Meet with my friends",
          taskdate: "2021-03-06",
          createdAt: new Date(),
        },
      ],
    };
  },
  methods: {
    saveTasks() {
      var isEdited = this.edit;
      if (isEdited) {
        console.log('inner function');
        (this.tasksList[this.editedId].taskname = this.newtask),
          (this.tasksList[this.editedId].taskdate = this.date);

        this.editedId = null;
        this.edit = false;
      } else {
        this.tasksList.push({
          taskname: this.newtask,
          taskdate: this.date,
          createdAt: new Date(),
        });
      }

      this.newtask = "";
      this.date = "";
    },

    removeTask(index) {
      this.tasksList.splice(index, 1);
    },

    editTask(index) {
      this.edit = true;
      this.editedId = index;

      this.newtask = this.tasksList[index].taskname;
      this.date = this.tasksList[index].taskdate;
    },
    resetForm(){
      this.edit = false;
      this.editedId = null;
      this.newtask = "";
      this.date = "";
    }
  },
};
</script>
