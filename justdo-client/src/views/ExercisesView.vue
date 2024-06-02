<template>
  <div class="exercise-view">
    <header>
      <h1>Exercises</h1>
      <h2>Choose language</h2>
      <select v-model="language" @change="changeLanguage(language)">
        <option value="en">English</option>
        <option value="nl">Nederlands</option>
      </select>
    </header>

    <h2>View</h2>
    <div class="tabs">
      <button :class="{ active: view === 'all' }" @click="changeView('all')">
        All Exercises
      </button>
      <button :class="{ active: view === 'own' }" @click="changeView('own')">
        Own Exercises
      </button>
    </div>

    <component :is="view === 'all' ? 'AllExercises' : 'OwnExercises'" v-model:language="language"></component>

  </div>
</template>

<script>
import AllExercises from '../modules/exercises/components/AllExercises.vue'
import OwnExercises from '../modules/exercises/components/OwnExercises.vue';

export default {
  name: 'ExercisesView',
  components: {
    AllExercises,
    OwnExercises
  },
  data() {
    return {
      language: 'en',
      view: 'all'
    }
  },
  methods: {
    changeLanguage(language) {
      this.language = language;
    },
    changeView(view) {
      this.view = view;
    }
  }
}
</script>

<style scoped>
.exercise-view {
  max-width: 600px;
  margin: 0 auto;
  padding: 20px;
}

h1 {
  font-size: 2rem;
  margin-bottom: 1rem;
}

h2 {
  font-size: 1.5rem;
  margin-top: 20px;
}

select {
  font-size: 1rem;
  padding: 5px;
  margin-bottom: 10px;
}

input[type="checkbox"] {
  margin-bottom: 10px;
}

.tabs {
  display: flex;
  margin-bottom: 20px;
}

.tabs button {
  font-size: 1.2rem;
  padding: 10px 20px;
  background-color: #fff;
  color: #333;
  cursor: pointer;
  flex: 1;
  border: 2px solid #333;
}

.tabs button.active {
  background-color: #333;
  color: #fff;

}
</style>