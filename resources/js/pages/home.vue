<template>
  <card title="Home">Welcome {{ user.first_name }}!</card>
</template>

<script>
import { mapGetters } from "vuex";

export default {
  middleware: "auth",

  computed: mapGetters({
    user: 'auth/user'
  })
};
</script>
