<template>
  <div class="container">
    <h4 class="text-center"> My Schedule Requests</h4>
    <div class="card">
      <div class="card-header p-4">
        <span class="float-start h3">Welcome <span class="fw-bolder">{{ name }}</span></span>
        <button class="btn btn-success float-end" @click="createModal = true">
          Request New Schedule
        </button>
      </div>
      <div class="card-body">
        <div class="card-body">
          <table class="table">
            <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Schedule Name</th>
              <th scope="col">Jobs</th>
              <th scope="col">Status</th>
              <th scope="col">Date</th>
              <th scope="col">Created</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(item , index) in items">
              <th scope="row">{{ index + 1 }}</th>
              <td>{{ item.name }}</td>
              <td>{{ item.jobs.toString() }}</td>
              <td><span :class="'text-'+ item.statusColor">{{ item.statusText }}</span></td>
              <td>{{ item.date }}</td>
              <td>{{ item.created_at }}</td>
            </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade "
       :class="{'d-block d-opacity': createModal}"
       tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content modal-lg">
        <div class="modal-header">
          <h5 class="modal-title">create</h5>
          <button type="button" class="btn-close" @click="createModal = false"></button>
        </div>
        <div class="modal-body">
          <div class="card mb-2 px-2 bg-gradient">
            <div class="card-text py-2">
              <div class="card-body">
                <div
                    v-for="(error,i) in errors"
                    class="mt-1 text-danger">
                  {{ error[0] }}
                </div>
                <div class="from-group mb-2">
                  <select v-model="newSchedule.jobs" class="form-control-lg" multiple>
                    <option v-for="(name , id) in jobs " :value="id">{{ name}}</option>
                  </select>
                </div>
                <div class="from-group mb-2">
                  <input placeholder="Name" type="text" class="form-control-lg" v-model="newSchedule.name">
                </div>
                <div class="from-group">
                  <datepicker placeholder="date" :lowerLimit="new Date()" class="form-control-lg"
                              v-model="newSchedule.date"/>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" @click="save">Save</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import api from "../Api/api";
import Datepicker from 'vue3-datepicker'


export default {
  name: "Employee",
  components: {
    Datepicker
  },
  data() {
    return {
      loading: false,
      createModal: false,
      items: [],
      jobs: [],
      newSchedule: {},
      name: '',
    }
  },
  methods: {
    async initials() {
      this.loading = true;
      api.get('/schedules/user')
          .then(({data}) => {
            this.items = data.data;
            this.jobs = data.jobs;
          })
          .catch((error) => {
            console.log(error)
            alert('error to get items')
          })
          .finally(() => this.loading = false)
    },
    save() {
      console.log(this.newSchedule)
      api.post('/schedules/user', Object.assign({}, this.newSchedule))
          .then(({data}) => {
            alert(data.message);
            this.initials();
            this.createModal = false;
          })
          .catch((error) => {
            const res = error.response;
            if (res) {
              this.errors = res.data.errors;
            }
            alert('Error to save')
          })
          .finally(() => this.loading = false)
    }
  },
  created() {
    this.name = localStorage.getItem('name');
    this.initials();
  }
}
</script>

<style scoped>

</style>
