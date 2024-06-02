<template>
  <section>
    <h2>All Exercises:</h2>
    <div class="flexcontainer">
      <div class="loader" v-show="!hasExercises">Loading...</div>

      <Exercise v-show="hasExercises" v-for="exercise in exercises" :key="exercise.exercise_id" :exercise="exercise">
      </Exercise>
    </div>
  </section>
</template>
  
<script>
import ExerciseService from '../services/ExerciseService'
import Exercise from './Exercise.vue'

export default {
  name: 'AllExercises',
  components: {
    Exercise
  },
  props: {
    language: String
  },
  data() {
    return {
      service: new ExerciseService(),
      exercises: [],
      loaded: false,
    }
  },
  watch: {
    language: {
      handler: async function () {
        if (!this.loaded) {
          return;
        }
        await this.loadAllExercises();
      },
      immediate: true
    }
  },
  computed: {
    hasExercises() {
      return this.exercises.length > 0
    }
  },
  async mounted() {
    await this.loadAllExercises();
    this.loaded = true;
  },
  methods: {
    async loadAllExercises() {
      this.exercises = await this.service.getAllExercises(this.language);
    }
  }
}
</script>
  
<style scoped>
.flexcontainer {
  display: flex;
  flex-wrap: wrap;
  justify-content: space-between;
  align-items: flex-start;
}

.loader {
  margin: 20px 0;
  font-size: 1.2rem;
  color: #333;
}

h2 {
  font-size: 1.5rem;
  margin-bottom: 10px;
}
</style>