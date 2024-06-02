<template>
  <section>
    <h2>Exercise Filter:</h2>
    <div>
      <label for="searchOnName">Sort by Name: </label>
      <input type="text" id="searchOnName" :value="sortByName" @input="updateName">
    </div>
    <div>
      <label for="sortByReps">Sort by Reps: </label>
      <select id="sortByReps" :value="sortOrder" @change="updateReps">
        <option value="" disabled selected>Select an option</option>
        <option value="asc">Ascending</option>
        <option value="desc">Descending</option>
      </select>
    </div>
  </section>
</template>
  
<script>
export default {
  name: 'ExerciseFilter',
  props: {
    sortOrder: {
      type: String,
      default: '',
    },
    sortByName: {
      type: String,
      default: '',
    },
  },
  emits: ['update:sortOrder', 'update:sortByName'],

  methods: {
    updateName(event) {
      this.$emit('update:sortByName', event.target.value);
    },

    updateReps(event) {
      this.$emit('update:sortOrder', event.target.value);
    }
  },
  mounted() {
    this.$emit('update:sortOrder', this.sortOrder);
  }
};
</script>
  
<style scoped>
section {
  margin-top: 20px;
}

h2 {
  font-size: 1.5rem;
  margin-bottom: 10px;
}

label {
  font-size: 1rem;
  margin-right: 5px;
}

input[type="text"],
select {
  font-size: 1rem;
  padding: 5px;
  margin-bottom: 10px;
}
</style>