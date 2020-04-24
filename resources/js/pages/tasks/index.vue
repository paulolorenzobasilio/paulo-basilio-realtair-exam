<template>
  <card title="Tasks">
    <router-link :to="{ name: 'tasks.form'}" role="button" class="btn btn-primary">Create</router-link>

    <table class="table table-borderless mt-2">
      <thead>
        <tr>
          <th scope="col"></th>
          <th scope="col">Title</th>
          <th scope="col">Description</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(task) in tasks" :key="task.id">
          <th scope="row">
            <div class="form-check">
              <input
                v-if="!isDone(task)"
                class="form-check-input"
                type="checkbox"
                @click="markAsDone(task.id)"
              />
            </div>
          </th>
          <td v-bind:class="{'strike-text': isDone(task)}">{{ task.title }}</td>
          <td v-bind:class="{'strike-text': isDone(task)}">{{ task.description }}</td>
          <td>
            <div class="btn-group">
              <router-link
                v-if="!isDone(task)"
                :to="{ name: 'tasks.show', params: {id: task.id} }"
                role="button"
                class="btn btn-secondary"
              >Update</router-link>
              <button type="button" class="btn btn-danger" @click="deleteTask(task.id)">Delete</button>
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

  async created() {
    this.tasks = await axios.get("/api/task").then(response => response.data);
  },

  methods: {
    isDone(task) {
      return task.done == 1;
    },

    async markAsDone(id) {
      await axios.put(`/api/task/${id}/done`);

      let task = this.tasks.find(task => task.id === id);
      task.done = true;
    },

    async deleteTask(id) {
      await axios.delete(`/api/task/${id}`);

      this.tasks = this.tasks.filter(task => task.id !== id);
    }
  }
};
</script>
