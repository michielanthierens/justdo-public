<script setup>
import { RouterLink, RouterView } from 'vue-router'
</script>

<template>
  <header>
    <h1>JustDO</h1>
    <div class="topbar">
      <nav>
        <ul>
          <li>
            <RouterLink to="/">Home</RouterLink>
          </li>
          <li>
            <RouterLink to="/login">Account</RouterLink>
          </li>
          <li>
            <RouterLink to="/exercises">Exercises</RouterLink>
          </li>
        </ul>
      </nav>
      <p> {{ username }}</p>
    </div>

  </header>

  <main>
    <RouterView />
  </main>
</template>

<script>

export default {
  name: 'App',
  data() {
    return {
      username: localStorage.getItem('username')
    }
  }
}

</script>

<style scoped>
header {
  background-color: #333;
  color: #fff;
  padding: 1rem;
}

h1 {
  font-size: 2rem;
  margin: 0;
}

.topbar {
  display: flex;
  justify-content: space-between;
}

nav ul {
  list-style-type: none;
  padding: 0;
  margin: 0;
}

nav ul li {
  display: inline-block;
  margin-right: 1rem;
}

nav ul li a {
  color: #fff;
  text-decoration: none;
}

main {
  margin-top: 2rem;
}
</style>
