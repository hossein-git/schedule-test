<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card p-md-5">
          <div class="card-title h3">
            LOGIN
          </div>
          <div class="card-body">
            <div
                v-for="(error,i) in errors"
                class="mt-1 text-danger">
              {{ error[0] }}
            </div>
            <div class="mt-1 text-danger">
              {{ error }}
            </div>
            <div class="form-group">
              <input type="text" placeholder="user name" class="form-control form-control-lg" v-model="user.email">
            </div>
            <div class="form-group mt-5">
              <input type="password" placeholder="Password" class="form-control form-control-lg"
                     v-model="user.password">
            </div>

            <div class="form-group mt-5">

              <button class="btn btn-success w-100 btn-lg" @click="login">LOGIN</button>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</template>

<script>
import api from "../Api/api";

export default {
  name: "login",
  data() {
    return {
      loading: false,
      user: {
        email: 'hossein@t.co',
        password: '12345678',

      },
      errors: [],
      error: '',
    }
  },
  methods: {
    login() {
      this.loading = true;
      this.errors = [];
      this.error = '';
      api.post('/login', Object.assign({}, this.user))
          .then(({data}) => {
            if (!data.success) return;
            const accessToken = data.access_token;
            localStorage.setItem('name', data.name);
            localStorage.setItem('api_token', accessToken);
            api.defaults.headers.common['Authorization'] = `Bearer ${accessToken}`;

            if (data.type === 'admin') {
              this.$router.push({name: 'admin'});
              return;
            }
            this.$router.push({name: 'worker'});
          })
          .catch((error) => {
            const res = error.response;
            if (res) {
              if (res.data.error) {
                this.error = res.data.error;
              }
              this.errors = res.data.errors;
            }


          })
          .finally(() => this.loading = false)
    }
  }
}
</script>
