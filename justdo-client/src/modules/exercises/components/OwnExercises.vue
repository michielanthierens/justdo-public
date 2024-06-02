<template>
  <section>
    <div>
      <h2 v-show="loggedIn">Logged in as: {{ username }}</h2>
      <h2 v-show="!loggedIn">You are not logged in.</h2>
    </div>
    <div v-show="loggedIn">
      <ExerciseFilter v-model:sortOrder="sortOrder" v-model:sortByName="sortByName" @update:sortOrder="setRepOrder"
        @update:sortByName="searchOnName"></ExerciseFilter>
      <h2>Own Exercises</h2>
      <h3>Add exercise:</h3>
      <div class="addExercise" v-show="loggedIn">
        <select v-model="selectedExercise">
          <option value="" disabled>Select an exercise</option>
          <option v-for="exercise in allExercises" :value="exercise">{{ exercise.translations.exercise }}</option>
        </select>
        <input type="number" v-model="reps" placeholder="Reps" min="1" max="999">
        <button @click="addExercise">Add Exercise</button>
      </div>
      <div class="loader" v-show="!hasExercises">Loading...</div>
      <p v-if="errorMessage" class="error-message">{{ errorMessage }}</p>
      <Exercise v-for="exercise in filteredExercises" :key="exercise.exercise_id" :exercise="exercise"></Exercise>
    </div>
  </section>
</template>

<script>
import { parseStringStyle } from '@vue/shared';
import ExerciseFilter from '../components/ExerciseFilter.vue';
import ExerciseService from '../services/ExerciseService';
import Exercise from './ExerciseDetail.vue';

export default {
  name: 'OwnExercises',
  components: {
    ExerciseFilter,
    Exercise
  },
  props: {
    language: String,
  },
  data() {
    return {
      service: new ExerciseService(),
      allExercises: [],
      exercises: [],
      filteredExercises: [],
      selectedExercise: '',
      username: "",
      loaded: false,
      loggedIn: false,
      reps: null,
      sortOrder: '',
      sortByName: '',
      errorMessage: null,
    }
  },
  watch: {
    language: {
      handler: async function () {
        if (!this.loaded) {
          return;
        }
        await this.loadExercisesById();
        await this.loadAllExercises();
      },
      immediate: true
    },
  },
  computed: {
    hasExercises() {
      return this.exercises.length > 0;
    }
  },
  async mounted() {
    await this.loadExercisesById();
    await this.loadAllExercises();
    this.loaded = true;
  },
  methods: {
    async loadExercisesById() {
      this.exercises = [];
      this.filteredExercises = [];
      if (localStorage.getItem('token') === null) {
        this.loggedIn = false;
        return;
      }
      const response = await this.service.getExercisesById(this.language);
      if (response === null) {
        this.loggedIn = false;
        return;
      }
      this.exercises = response.exercises;
      this.searchOnName(this.sortByName);
      this.username = response.name;
      this.loggedIn = true;
    },
    async loadAllExercises() {
      try {
        const response = await this.service.getAllExercises(this.language);
        this.allExercises = response;
      } catch (error) {
        this.errorMessage = "An error occurred while loading the exercises. Please try again later.";
      }
    },
    async addExercise() {
      this.errorMessage = '';
      try {
        await this.service.addExercise(this.selectedExercise.exercise_id, this.reps);
        this.selectedExercise = null;
        this.reps = null;
        await this.loadExercisesById()
      } catch (error) {
        this.errorMessage = "something went wrong, please provide a valid number and reps or valid exercise";
      }
    },
    searchOnName(searchTerm) {
      const filteredExercisesByName = this.exercises.filter(exercise => {
        const name = exercise.exercise.exercise.toLowerCase();
        const description = exercise.exercise.description.toLowerCase();
        const search = searchTerm.toLowerCase();
        return name.includes(search) || description.includes(search);
      });

      this.filteredExercises = filteredExercisesByName;
    },
    setRepOrder(sortOrder) {
      if (sortOrder === 'asc') {
        this.filteredExercises.sort((a, b) => a.reps - b.reps);
      } else if (sortOrder === 'desc') {
        this.filteredExercises.sort((a, b) => b.reps - a.reps);
      } else {
        return;
      }
    }
  }
}
</script>
  
<style scoped>
section {
  margin-top: 20px;
}

h2 {
  font-size: 1.5rem;
  margin-bottom: 10px;
}

select {
  font-size: 1rem;
  padding: 5px;
}

input[type="number"] {
  font-size: 1rem;
  padding: 5px;
}

div.addExercise {
  display: flex;
  justify-content: space-between;
  margin-bottom: 20px;
}

button {
  padding: 5px 10px;
  background-color: #333;
  color: #fff;
  border: none;
  cursor: pointer;
}

button:hover {
  background-color: #fff;
  color: #333;
  border: #333 solid 1px;
  transition: 0.3s;
}

.loader {
  margin-top: 20px;
}

.error-message {
  color: red;
  margin-top: 10px;
}

article {
  margin-bottom: 20px;
}

h3 {
  font-size: 1.2rem;
  margin-bottom: 5px;
}

p {
  font-size: 1rem;
  margin-bottom: 10px;
}
</style>