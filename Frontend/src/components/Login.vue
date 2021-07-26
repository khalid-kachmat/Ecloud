<template>
  <div class="py-40 bg h-screen">
    <div class="max-w-lg m-auto w-full p-8 md:p-12 rounded-xl shadow-2xl bg-white">
      <section>
        <h3 class="font-karla text-2xl text-center tracking-wider">Welcome to ECloud</h3>
        <p class="text-gray-600 pt-2 text-center">Sign in to your account.</p>
      </section>

      <section class="mt-10">
        <form class="flex flex-col" @submit.prevent="login">
          <div class="mb-6 pt-3 rounded ">
            <label class=" block text-gray-700 text-sm font-semibold mb-2 ml-3">Email<span class="text-red-500">
        *
       </span></label>
            <input v-model="email"
                   type="email"
                   class="bg-gray-200 py-2 rounded-xl w-full text-gray-700 focus:outline-none border-b-4 border-gray-400 focus:border-black transition duration-500 px-3 pb-3"
                   placeholder="Please Enter You Email"
            />
          </div>
          <div class="mb-6 pt-3 rounded ">
            <label
                class="block text-gray-700 text-sm font-semibold mb-2 ml-3 tracking-wide">Password<span
                class="text-red-500">
        *
       </span></label>
            <input v-model="password"
                   type="password"
                   class="bg-gray-200 py-2 rounded-xl w-full text-gray-700 focus:outline-none border-b-4 border-gray-400 focus:border-black transition duration-500 px-3 pb-3"
                   placeholder="Please Enter You Password"
            />
          </div>

          <button
              class="p-2 bg-gray-200 hover:text-black  text-gray-500 font-bold transition ease-in-out duration-700  rounded-xl shadow-md"
              type="submit">Sign In
          </button>
          <span class="m-4 text-red-500" v-show="errorField">{{ error }}</span>
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
      errorField: false,


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
          method: 'Post',
          body: JSON.stringify({
            email: this.email,
            password: this.password
          })
        };
        fetch('http://127.0.0.1:8000/api/login', data)
            .then(res => res.json())
            .then(data => this.details = data)
      }
    }
  }

}
</script>

<style scoped>

</style>