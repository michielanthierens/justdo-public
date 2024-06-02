<template>
    <div class="container">
      <h1> {{  username }} </h1>
      <p>Logout of your account.</p>
      <button @click="logout">Logout</button>
    </div>
</template>

<script>
import FituserService from '../services/FituserService';

    export default {
        data() {
            return {
                fituserService: new FituserService(),
                username: localStorage.getItem('username')
            };
        },
        methods: {
            async logout() {
                await this.fituserService.logout();
                localStorage.removeItem('token');
                localStorage.removeItem('user_id');
                localStorage.removeItem('username');
                this.$router.go();
                }
        }
    }

</script>

<style scoped>
h1 {
  font-size: 2rem;
  margin-bottom: 1rem;
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
  margin-top: 1rem;
  padding: 0.5rem 1rem;
  background-color: #333;
  color: #fff;
  border: none;
  cursor: pointer;
}

.container {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  height: 100%;
}
</style>
