<template>
  <div class="container">
    <div class="card">
      <h4>
        Week #{{weekCounter}}
      </h4>
      <div class="card-header h4">
        <span class="float-start">Schedules</span>
        <button :disabled="loading" class="btn btn-sm float-end" @click="weekCounter++">></button>
        <button :disabled="loading" v-show="weekCounter !== 0" class="btn btn-sm ms-2 float-end" @click="weekCounter--"><</button>
      </div>
      <div class="card-body">
        <table class="table">
          <thead>
          <tr>
            <th scope="col">JOB</th>

            <th
                v-for="(date,dayName) in weeks"
                scope="col">
              {{ dayName }} <br>
              {{ date }}
            </th>
          </tr>
          </thead>
          <tbody>
          <tr v-for="(item , index) in items" :key="index + 'x'">
            <th scope="row" class="text-start">{{ item.name }}</th>
            <td
                v-for="(schedule , i ) in item.schedules"
                :key="i"
            >{{ schedule.name }}
            </td>
          </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>

</template>

<script>
import api from "../Api/api";

export default {
  name: "Manager",
  data() {
    return {
      loading: false,
      weekCounter: 0,
      items: [],
      weeks: [],
      errors: [],
    }
  },
  watch:{
    weekCounter(){
      this.initials();
    }
  },
  methods: {
    async initials() {
      this.loading = true;
      api.get('/schedules?week=' + parseInt(this.weekCounter))
          .then(({data}) => {
            this.items = data.data;
            this.weeks = data.weeks;
          })
          .catch((error) => {
            console.log(error)
            alert('error to get items')
          })
          .finally(() => this.loading = false)
    },
  },
  created() {
    this.initials();
  }
}
</script>

<style>
.d-opacity {
  opacity: 1 !important;
}
</style>
