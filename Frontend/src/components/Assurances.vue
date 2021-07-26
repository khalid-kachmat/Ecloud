<template>


  <div class="flex">
    <div class="ml-20 w-2/3 overflow-x-auto h-1/2  font-sans overflow-hidden ">
      <div class="w-full py-3 lg:w-5/6">
        <!--        -->

        <div>
          <div class="relative mr-4 my-2 flex space-x-10 w-full	">
            <div class="flex justify-start w-1/2">
              <input type="search" v-model="search " class="bg-white shadow-lg rounded-xl  p-2 w-22 text-semibold"
                     placeholder="Search by name...">
            </div>
            <div class="flex justify-end w-1/2	">
              <button @click="addNewAssurance"
                      class=" flex item-center gap-2 w-30 px-8 py-2  bg-white hover:border-white shadow-lg rounded-xl hover:text-black text-gray-400 font-bold transition ease-in-out duration-700 ">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                     xmlns="http://www.w3.org/2000/svg">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                </svg>
                Add new
              </button>
            </div>
          </div>
          <div class=" table-bg rounded-xl  shadow-lg  my-6">
            <table class="min-w-max w-full rounded-xl table-auto">
              <thead>
              <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                <th class="py-3 px-6 text-left">assurance Name</th>
                <th class="py-3 px-6 text-center">Actions</th>
              </tr>
              </thead>
              <tbody v-for="(row) in  filter" :key="row.servr_id"
                     class="text-gray-600 bg-white text-sm font-semibold rounded-xl font-light">
              <tr class="border-b border-gray-200 hover:bg-gray-100">
                <td class="py-3 px-6 text-left whitespace-nowrap">
                  {{ row.assurance_name }}
                </td>



                <td class="py-3 px-6 text-center">
                  <div class="flex item-center justify-center">
                    <div class="w-4 mr-2 cursor-pointer transform hover:text-purple-500 hover:scale-110">
                      <svg @click="displayAssurance(row.assurance_id)" xmlns="http://www.w3.org/2000/svg"
                           fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                      </svg>
                    </div>
                    <div class="w-4 mr-2 cursor-pointer transform hover:text-purple-500 hover:scale-110">
                      <svg @click="editAssurance(row.assurance_id)" xmlns="http://www.w3.org/2000/svg"
                           fill="none"
                           viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                      </svg>
                    </div>
                    <div class="w-4 mr-2 cursor-pointer transform hover:text-purple-500 hover:scale-110">
                      <svg @click="deleteAssurance(row.assurance_id,row.assurance_name)"
                           xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                      </svg>
                    </div>
                  </div>
                </td>
              </tr>

              </tbody>
            </table>
          </div>
        </div>

      </div>
    </div>

    <div class="w-2/4 py-3  mr-10 flex mt-25 justify-center">

      <div class="w-full ">
        <div class="flex justify-center my-5 font-semibold text-gray-500 ">

          <h1 :class="displayVisibility ? 'hidden' : 'block'"><span>Assurance Information</span></h1>
          <h1 :class="editVisibility ? 'hidden' : 'block'"><span>Edit Assurance Information</span></h1>
          <h1 :class="addVisibility ? 'hidden' : 'block'"><span>Add new Assurance</span></h1>
        </div>
        <!--        edit and add form-->
        <form @submit.prevent="sendDataIntoDataBase" class=" bg-white rounded-xl p-4"
              :class="formVisibility ? 'hidden' : 'block'">

          <div class="items-center w-full py-4 space-x-4">
            <div class="flex w-1/2 flex-col justify-center">
              <label class="leading-loose font-semibold ">Assurance Name<span class="text-red-500">
        *
       </span></label>
              <input v-model="assuranceName" type="text" name="firstName" placeholder="Enter assurance Name"
                     class="px-4 py-2  w-2/3 sm:text-sm bg-gray-200 shadow-md focus:outline-none rounded-md ">
            </div>
            <input name="assurance_id" hidden v-model="assuranceId">



          </div>




          <div class="flex flex-col my-4 items-center justify-center w-full">
            <button
                type="submit"
                class="w-1/2 px-1 py-1    bg-gray-200 hover:text-black  text-gray-500 font-bold transition ease-in-out duration-700  rounded-xl shadow-md ">
              Save
            </button>
            <span class="m-4 text-red-500" v-show="errorField">{{ error }}</span>
          </div>
        </form>
        <!--        edit and add form-->

        <!--        displaying users data-->
        <div class=" bg-white rounded-xl p-4 w-full" :class="displayFormVisibility ? 'hidden' : 'block'">

          <div class="items-center w-full py-4 space-x-4">
            <div class="flex w-1/2 flex-col justify-center">
              <label class="leading-loose font-semibold ">Assurance Name</label>
              <input v-model="assuranceName" type="text" readonly
                     class="px-4 py-2 cursor-default w-2/3 sm:text-sm bg-gray-200 shadow-md focus:outline-none rounded-md ">
            </div>



          </div>

        </div>
        <!--        displaying users data-->

      </div>
    </div>
  </div>
</template>

<script>
export default {
  components: {},
  props: {},
  data() {
    return {
      //variables
      search: '',
      assuranceName:'',
      assuranceId:'',
      assuranceDuration:'',
      assurancePrice:'',
      error: 'All Field with * are requires',
      formVisibility: true,
      displayFormVisibility: true,
      displayVisibility: true,
      editVisibility: true,
      addVisibility: true,
      errorField: false,
      function: 'add',


      //objects
      assurancesData: '',
    }
  },
  computed: {
    filter() {
      const data = this.assurancesData
      return data && data.filter(item => {
        return item.assurance_name.toLowerCase().includes(this.search)
      })
    }
  },

  mounted() {
    this.getAssuranceData()
  },
  methods: {
    getAssuranceData() {
      fetch('http://127.0.0.1:8000/api/assurances', {
        method: 'get'
      }).then(res => res.json())
          .then(data => this.assurancesData = data)
    },


    editAssurance(servId) {
      this.function = 'edit'
      this.formVisibility = false;
      this.editVisibility = false;
      this.displayVisibility = true;
      this.addVisibility = true
      this.displayFormVisibility = true


      this.assurancesData.forEach(item => {
        if (item.assurance_id == servId) {
          this.assuranceId = item.assurance_id
          this.assuranceName = item.assurance_name;



        }
      })
    },
    displayAssurance(servId) {
      this.displayFormVisibility = false
      this.displayVisibility = false
      this.editVisibility = true;
      this.addVisibility = true
      this.formVisibility = true
      this.assurancesData.forEach(item => {
        if (item.assurance_id == servId) {
          this.assuranceName = item.assurance_name;
          this.assuranceId = item.assurance_id;

        }
      })
    },
    addNewAssurance() {
      this.function = 'add'
      if (this.servId === '') {
        this.servId = 0
      }
      this.addVisibility = false
      this.formVisibility = false
      this.displayFormVisibility = true
      this.displayVisibility = true;
      this.editVisibility = true
      this.assuranceName = this.assuranceId = '';
    },
    sendDataIntoDataBase() {
      if (this.assuranceName === '') {
        this.errorField = true
      } else {
        const data = {
          method: 'POST',
          body: JSON.stringify({
            function: this.function,
            assuranceId: this.assuranceId,
            assuranceName: this.assuranceName,
          })
        };
        fetch('http://127.0.0.1:8000/api/updateOrAddAssurance', data);
        this.getAssuranceData()
        this.addVisibility = this.formVisibility = this.displayFormVisibility = this.displayVisibility = this.editVisibility = true

      }

    },
    deleteAssurance(id,fullName) {
      this.$swal.fire({
        title: 'Do you want to Delete this ?',
        text: fullName,
        showDenyButton: true,
        showCancelButton: true,
        showConfirmButton: false,
        denyButtonText: `Delete`,
      }).then((result) => {
        if (result.isDenied) {
          let data = {
            method: 'POST',
            body: JSON.stringify({
              assuranceId: id,
            })
          }
          fetch('http://127.0.0.1:8000/api/deleteAssurance', data)
          this.$swal.fire('Deleted!', '', 'success')
          this.getAssuranceData()
        }
      })
    }
  }
}
</script>

<style scoped>

</style>