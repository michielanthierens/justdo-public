<template>
  <article class="exercise-box">
    <h3>{{ exercise.translations.exercise }}</h3>
    <p>{{ exercise.translations.description }}</p>
  </article>
</template>

<script>
export default {
  name: 'Exercise',
  props: {
    exercise: {
      type: Object,
      required: true
    },
  },
}
</script>

<style scoped>
.exercise-box {
  border: 1px solid #ddd;
  border-radius: 5px;
  padding: 10px;
  margin-bottom: 10px;
  background-color: var(#333);
  color: var(#fff);
  width: 100%;
}

h3 {
  font-size: 1.2rem;
  margin-bottom: 5px;
}

p {
  font-size: 1rem;
  margin-bottom: 5px;
}
</style>