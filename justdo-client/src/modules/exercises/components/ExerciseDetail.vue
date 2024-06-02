<template>
  <article v-if="!deleted">
    <header>
      <h3>{{ exercise.exercise.exercise }}</h3>
      <div class="buttons">
        <div v-show="!editMode" class="button-group">
          <button @click="toggleEdit">edit</button>
          <button @click="deleteExercise">delete</button>
        </div>
        <div v-show="editMode" class="button-group">
          <button @click="toggleEdit">cancel</button>
          <button @click="editExercise">save</button>
        </div>
      </div>
    </header>
    <p>{{ exercise.exercise.description }}</p>
    <div v-show="!editMode">
      <p>reps: {{ exercise.reps }}</p>
    </div>
    <div v-show="editMode" class="reps">
      <p>reps:</p>
      <input id="reps_input" v-show="editMode" type="number" v-model="exercise.reps" min="1" max="999">
    </div>
  </article>
</template>

<script>
import ExerciseService from '../services/ExerciseService'
export default {
  name: 'Exercise',
  props: {
    exercise: {
      type: Object,
      required: true
    }
  },
  data() {
    return {
      service: new ExerciseService(),
      editMode: false,
      deleted: false
    }
  },
  methods: {
    toggleEdit() {
      this.editMode = !this.editMode;
    },
    async editExercise() {
      this.editMode = false;

      const exercise_id = this.exercise.exercise.exercise_id;
      const newReps = this.exercise.reps;
      await this.service.editExercise(exercise_id, newReps);
    },
    async deleteExercise() {
      const exercise_id = this.exercise.exercise.exercise_id;
      const response = await this.service.deleteExercise(exercise_id);
      this.deleted = true;
    }
  }
}
</script>

<style scoped>
article {
  border: 1px solid #ccc;
  padding: 10px;
  margin-bottom: 10px;
  display: flex;
  flex-direction: column;
}

header {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

h3 {
  font-size: 1.2rem;
  margin-bottom: 5px;
}

p {
  font-size: 1rem;
  margin-bottom: 5px;
}

.button-group {
  display: flex;
  justify-content: flex-end;
}

button {
  font-size: 0.9rem;
  padding: 5px 10px;
  margin-right: 5px;
}

input[type="number"] {
  font-size: 1rem;
  padding: 5px;
  width: 50px;
}

.reps {
  display: flex;
  align-items: center;
}
</style>