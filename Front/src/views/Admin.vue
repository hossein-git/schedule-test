<template>
  <div class="container">
    <div class="card">
      <div class="card-header h4">
        <span class="float-start">Pending Schedules</span>
      </div>
      <div class="card-body">
        <table class="table">
          <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Schedule Name</th>
            <th scope="col">Status</th>
            <th scope="col">Jobs</th>
            <th scope="col">Creator</th>
            <th scope="col">Date</th>
            <th scope="col">Created At</th>
            <th scope="col">Action</th>
          </tr>
          </thead>
          <tbody>
          <tr v-for="(item , index) in items">
            <th scope="row">{{ item.id }}</th>
            <td>{{ item.name }}</td>
            <td><span :class="'text-'+ item.statusColor">{{ item.statusText }}</span></td>
            <td>{{ item.jobs.toString() }}</td>
            <td>{{ item.user.name }} <br> <small>{{ item.user.email }}</small></td>
            <td>{{ item.date }}</td>
            <td>{{ item.created_at }}</td>
            <td>
              <button class="btn btn-sm btn-success me-2" @click="changeStatus(1,item.id)">
                ✓
              </button>
              <button class="btn btn-sm btn-danger" @click="changeStatus(2,item.id)">
                X
              </button>
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
      items: [],
      errors: [],
    }
  },
  methods: {
    async initials() {
      this.loading = true;
      api.get('/schedules/admin')
          .then(({data}) => {
            this.items = data.data;
          })
          .catch((error) => {
            console.log(error)
            alert('error to get employees')
          })
          .finally(() => this.loading = false)
    },
    changeStatus(status, id) {
      this.loading = true;
      api.put('/schedules/admin/' + id, {status: status})
          .then(({data}) => {
            alert(data.message);
            // this.items.find((x) => { x.id === id }).status
            this.initials()
          })
          .catch(error => {
            const res = error.response;
            if (res) {
              this.errors = res.data.errors;
            }
            alert('Error happend')
          })
          .finally(() => this.loading = false)
    }
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
