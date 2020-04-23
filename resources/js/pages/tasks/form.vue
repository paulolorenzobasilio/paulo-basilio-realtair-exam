<template>
  <card title="Tasks">
    <form @submit.prevent="createTask" @keydown="form.onKeydown($event)">
      <!-- Title -->
      <div class="form-group row">
        <label class="col-md-3 col-form-label text-md-right">Title</label>
        <div class="col-md-7">
          <input
            v-model="form.title"
            :class="{ 'is-invalid': form.errors.has('title') }"
            class="form-control"
            type="text"
            name="title"
          />
          <has-error :form="form" field="title" />
        </div>
      </div>

      <!-- Description -->
      <div class="form-group row">
        <label class="col-md-3 col-form-label text-md-right">Description</label>
        <div class="col-md-7">
          <textarea
            v-model="form.description"
            :class="{ 'is-invalid': form.errors.has('description') }"
            class="form-control"
            name="description"
          ></textarea>
          <has-error :form="form" field="description" />
        </div>
      </div>

      <div class="form-group row">
        <div class="col-md-7 offset-md-3 d-flex">
          <v-button :loading="form.busy" class="mr-2">Create</v-button>
          <router-link :to="{ name: 'tasks'}" role="button" class="btn btn-secondary">Cancel</router-link>
        </div>
      </div>
    </form>
  </card>
</template>

<script>
import Form from "vform";
import axios from "axios";
import Swal from "sweetalert2";

export default {
  middleware: "auth",

  data: () => ({
    form: new Form({
      title: "",
      description: ""
    })
  }),

  async created() {
    this.tasks = await axios.get("/api/task").then(response => {
      return response.data;
    });
  },

  methods: {
    async createTask() {
      await this.form.post("/api/task");
      notie.alert({
        type: "success",
        text: "Successfully created task!",
        position: "bottom",
        time: 2
      });
    }
  }
};
</script>
