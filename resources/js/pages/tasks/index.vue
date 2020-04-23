<template>
  <card title="Tasks">
    <router-link :to="{ name: 'tasks.form'}" role="button" class="btn btn-primary">
      Create
    </router-link>

    <table class="table mt-2">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Title</th>
          <th scope="col">Description</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(task, index) in tasks" :key="task.id">
          <th scope="row">{{ index + 1 }}</th>
          <td v-bind:class="{'strike-text': isDone(task)}">{{ task.title }}</td>
          <td v-bind:class="{'strike-text': isDone(task)}">{{ task.description }}</td>
          <td>
            <div class="btn-group">
              <template v-if="!isDone(task)">
                <button type="button" class="btn btn-primary">Done?</button>
                <button type="button" class="btn btn-secondary">Update</button>
              </template>
              <button type="button" class="btn btn-danger">Delete</button>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
  </card>
</template>

<style scoped>
.strike-text {
  text-decoration: line-through;
}
</style>

<script>
import { mapGetters } from "vuex";
import axios from "axios";

export default {
  middleware: "auth",

  data: () => ({
    tasks: []
  }),

  computed: mapGetters({
    user: "auth/user"
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
