<template>
  <div class="py-40 bg h-screen">
    <div class=" max-w-lg m-auto w-full text-gray-500 p-8 md:p-12 rounded-xl shadow-2xl bg-green-300">
      <section class="flex flex-col justify-center w-full">
        <img src="../assets/logoLogin.svg" class="w-32 ml-36" alt="">
        <h3 class="font-karla text-2xl font-semibold  text-center tracking-wider">Welcome to ECloud</h3>
        <p class=" pt-2 font-semibold text-center">Sign in to your account.</p>
      </section>

      <section class="mt-10">
        <form class="flex flex-col" @submit.prevent="login">
          <div class="mb-6 pt-3 rounded ">
            <label class=" block  text-sm font-semibold mb-2 ml-3">Email<span class="text-red-500">
        *
       </span></label>
            <input v-model="email"
                   type="email"
                   class="bg-white py-2 rounded-xl w-full text-gray-700 focus:outline-none border-b-4 border-t-4 border-green-400 focus:border-green-600 transition duration-500 px-3 pb-3"
                   placeholder="Please Enter You Email"
            />
          </div>
          <div class="mb-6 pt-3 rounded ">
            <label
                class="block text-sm font-semibold mb-2 ml-3 tracking-wide">Password<span
                class="text-red-500">
        *
       </span></label>
            <input v-model="password"
                   type="password"
                   class="bg-white py-2 rounded-xl w-full text-gray-700 focus:outline-none border-b-4 border-t-4 border-green-400 focus:border-green-600 transition duration-500 px-3 pb-3"
                   placeholder="Please Enter You Password"
            />
          </div>

          <button
              class="p-2 bg-white hover:text-black  text-gray-500 font-bold transition ease-in-out duration-700  rounded-xl shadow-md"
              type="submit">Sign In
          </button>
          <span class="m-4 text-red-500" v-show="errorField">{{ error }}</span>
          <span class="m-4 text-red-500" v-show="errorFieldLogin">{{ loginError }}</span>
        </form>
      </section>
    </div>
  </div>
</template>

<script>
export default {
  name: "Login",
  data() {
    return {
      //variables
      email: '',
      password: '',
      error: 'All Field with * are requires',
      loginError: 'email or password is incorrect',
      errorField: false,
      errorFieldLogin: false,


      //objects
      details: '',
    }
  },
  methods: {
    login() {
      if (this.email === '' || this.password === '') {
        this.errorField = true;
      } else {
        let data = {
          method: 'POST',
          body: JSON.stringify({
            email: this.email,
            password: this.password
          })
        };
        fetch('http://127.0.0.1:8000/api/login', data)
            .then(res => res.json())
            .then(data => this.details = data)
            .then(this.afterLogin)
      }
    },
    afterLogin() {
      if(this.details.message === 'failed'){
        this.errorFieldLogin = true
      }else {
        sessionStorage.setItem('name', this.details.user.name)
        sessionStorage.setItem('email', this.details.user.email)
        sessionStorage.setItem('position', this.details.user.type)
        sessionStorage.setItem('id', this.details.user.id);
        this.$router.push('/')
      }
    }
  }

}
</script>

<style scoped>

</style>