<template>
  <div class="container">
    <h2>Register</h2>
    <p>create a new account.</p>
    <form @submit.prevent="register">
      <label for="login_username">Username</label>
      <input v-model="login_username" type="text" id="login_username" placeholder="username" name="login_username" />
      <label for="login_password">Password</label>
      <input v-model="login_password" type="password" id="login_password" placeholder="new safe password"
        name="login_password" />
      <button type="submit">register</button>
    </form>
    <p class="error">{{ error }}</p>
  </div>
</template>

<script>
import FituserService from '../services/FituserService';

export default {
  data() {
    return {
      login_username: '',
      login_password: '',
      error: '',
      fituserService: new FituserService()
    };
  },
  methods: {
    async register() {
      try {
        this.error = '';
        const response = await this.fituserService.register(this.login_username, this.login_password);
        if (response.status === 'success') {
          localStorage.setItem('token', response.authorisation.token);
          localStorage.setItem('user_id', response.user_id);
          localStorage.setItem('username', response.name);
          this.$router.go();
        }
      } catch (error) {
        this.error = 'this user already exists, or did you forget to enter a password?';
      }
    }
  }
};
</script>

<style scoped>
h2 {
  font-size: 1.5rem;
}

p {
  font-size: 1.2rem;
  margin-bottom: 1rem;
}

form {
  display: flex;
  flex-direction: column;
  align-items: center;
}

label {
  font-weight: bold;
}

input {
  margin-bottom: 1rem;
  padding: 0.5rem;
  width: 300px;
}

button {
  padding: 0.5rem 1rem;
  background-color: #333;
  color: #fff;
  border: none;
  cursor: pointer;
  margin-top: 1rem;

}

.error {
  color: red;
  margin-top: 1rem;
}

.register-link,
button {
  display: inline-block;
}

.container {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  height: 100%;
}
</style>
