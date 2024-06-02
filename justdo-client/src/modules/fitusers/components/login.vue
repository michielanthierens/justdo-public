<template>
  <div class="container">
    <h2>Login</h2>
    <p>Login to your account.</p>
    <form @submit.prevent="login">
      <label for="username">Username</label>
      <input type="text" id="username" name="username" placeholder="username" v-model="username" />
      <label for="password">Password</label>
      <input type="password" id="password" name="password" placeholder="password" v-model="password" />
      <button type="submit">Login</button>
    </form>
    <p class="error">{{ error }}</p>
  </div>
</template>
  
<script>
import FituserService from '../services/FituserService';

export default {
  data() {
    return {
      username: '',
      password: '',
      error: '',
      fituserService: new FituserService()
    };
  },
  methods: {
    async login() {
      try {
        this.error = '';
        const response = await this.fituserService.login(this.username, this.password);
        if (response.status === 'success') {
          const token = response.authorisation.token;
          const user_id = response.user_id;
          const username = response.name;
          localStorage.setItem('token', token);
          localStorage.setItem('user_id', user_id);
          localStorage.setItem('username', username);
          this.$router.go();
        }
      } catch (error) {
        this.error = 'invalid username or password';
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



.error {
  color: red;
  margin-top: 1rem;
}

button {
  padding: 0.5rem 1rem;
  background-color: #333;
  color: #fff;
  border: none;
  cursor: pointer;
  margin-top: 1rem;
}

.container {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  height: 100%;
}
</style>
