<template>
  <div class="container">
    <h1>Account</h1>
    <p>To start creating your own set of exercises, log in or create an account if you dont have one.</p>

    <div v-show="!loggedIn">
      <div v-show="hasAccount">
        <login></login>
        <p>No account yet?<span @click="toggleHasAccount"> Click here to register </span></p>
      </div>

      <div v-show="!hasAccount">
        <register></register>
        <p>Aleady have an account?<span @click="toggleHasAccount"> Click here to log in </span></p>
      </div>
    </div>

    <div v-show="loggedIn">
      <p>You are logged in.</p>
      <logout></logout>
    </div>
  </div>
</template>

<script>
import login from '../modules/fitusers/components/login.vue'
import register from '../modules/fitusers/components/register.vue'
import logout from '../modules/fitusers/components/logout.vue'

export default {
  name: 'LoginView',
  components: {
    login,
    register,
    logout
  },
  data() {
    return {
      hasAccount: true,
    }
  },
  computed: {
    loggedIn() {
      return localStorage.getItem('token') !== null;
    }
  },
  methods: {
    toggleHasAccount() {
      this.hasAccount = !this.hasAccount;
    }
  }
}
</script>

<style scoped>
.container {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  height: 100%;
}

h1 {
  font-size: 2rem;
  margin-bottom: 1rem;
}

p {
  font-size: 1.2rem;
  margin-bottom: 1rem;
  text-align: center;
}

span {
  color: blue;
  cursor: pointer;
}

.login,
.register {
  margin-bottom: 1rem;
}

.logout {
  margin-top: 1rem;
}
</style>