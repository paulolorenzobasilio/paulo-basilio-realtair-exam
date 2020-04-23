<template>
  <card title="Tasks">
    <!-- <form @submit.prevent="register" @keydown="form.onKeydown($event)"> -->
    <form>
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

export default {
  middleware: "auth",

  data: () => ({
    form: new Form({
      title: "",
      description: ""
    })
  }),

  created: async function() {
    this.tasks = await axios.get("/api/task").then(response => {
      return response.data;
    });
  },

  methods: {
    isDone: function(task) {
      return task.done == 1;
    }
  }
};
</script>
