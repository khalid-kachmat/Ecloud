<template>
  <section class="flex  ">
    <div class="ml-20 w-2/3 overflow-x-auto h-1/2  font-sans overflow-hidden ">
      <div class="w-full py-20 lg:w-5/6">
        <div class="relative mr-4 my-2 flex space-x-10 w-full	">
          <div class="flex justify-start w-1/2">
            <input type="search" v-model="search " class="bg-white shadow-lg rounded-xl  p-2 w-22 text-semibold"
                   placeholder="Search by name...">
          </div>
          <div class="flex justify-end w-1/2	">
            <button @click="addNewPatient"
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
              <th class="py-3 px-6 text-left">First Name</th>
              <th class="py-3 px-6 text-left">Last Name</th>
              <th class="py-3 px-6 text-center">Cin</th>
              <th class="py-3 px-6 text-center">Appointments</th>
              <th class="py-3 px-6 text-center">Actions</th>
            </tr>
            </thead>
            <tbody v-for="(row) in  filter" :key="row.patientId"
                   class="text-gray-600 bg-white text-sm font-semibold rounded-xl font-light">
            <tr class="border-b border-gray-200 hover:bg-gray-100">
              <td class="py-3 px-6 text-left whitespace-nowrap">
                {{ row.patientFirst }}
              </td>
              <td class="py-3 px-6 text-left">
                {{ row.patientLast }}
              </td>
              <td class="py-3 px-6 text-center">
                {{ row.patientCin }}
              </td>
              <td class="py-3 px-6 text-center">
                <span class="bg-gray-300 text-black font-bold py-1 px-3 rounded-full text-xs">{{ row.appNbr }}</span>
              </td>
              <td class="py-3 px-6 text-center">
                <div class="flex item-center justify-center">
                  <div class="w-4 mr-2 cursor-pointer transform hover:text-purple-500 hover:scale-110">
                    <svg @click="displayPatient(row.patientId,row.patientAssurance)" xmlns="http://www.w3.org/2000/svg"
                         fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                  </div>
                  <div class="w-4 mr-2 cursor-pointer transform hover:text-purple-500 hover:scale-110">
                    <svg @click="editPatient(row.patientId,row.patientAssurance)" xmlns="http://www.w3.org/2000/svg"
                         fill="none"
                         viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                    </svg>
                  </div>
                  <div class="w-4 mr-2 cursor-pointer transform hover:text-purple-500 hover:scale-110">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
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
        <div class="w-full flex justify-center my-4 font-semibold text-gray-500">
          <h1><span>Appointments</span></h1>
        </div>
        <div class="flex flex-wrap space-x-3 space-y-3 ">
          <div v-for="(row,index) in appointments" :key="index"
               class="min-w-min max-w-max min-h-min rounded-xl shadow-xl   bg-white p-5">
            <div class="w-full pb-5 flex justify-center space-x-2 text-xl text-gray-400 font-semibold ">
              <h2>Appointment</h2><span
                class="bg-gray-300 text-black font-bold py-1 px-3 rounded-full text-xs">{{ index + 1 }}
            </span></div>
            <div class="space-y-2 text-xs font-semibold">
              <p>Doctor: {{ row.doc }}</p>
              <p>Service: {{ row.service }}</p>
              <p>Date: {{ row.startDate }}</p>
            </div>

          </div>
        </div>

      </div>
    </div>

    <div class="w-2/4 py-20  mr-10 flex mt-25 justify-center">

      <div class="w-full ">
        <div class="flex justify-center my-5 font-semibold text-gray-500 ">

          <h1 :class="displayVisibility ? 'hidden' : 'block'"><span>Patient Information</span></h1>
          <h1 :class="editVisibility ? 'hidden' : 'block'"><span>Edit Patient Information</span></h1>
          <h1 :class="addVisibility ? 'hidden' : 'block'"><span>Add new Patient</span></h1>
        </div>
        <form @submit="sendDataIntoDataBase" class=" bg-white rounded-xl p-4"
              :class="formVisibility ? 'hidden' : 'block'">

          <div class="flex items-center justify-center w-full py-4 space-x-4">
            <div class="flex w-1/2 flex-col justify-center">
              <label class="leading-loose font-semibold ">First Name<span class="text-red-500">
        *
       </span></label>
              <input v-model="patientFirst" type="text" name="firstName"
                     class="px-4 py-2  w-2/3 sm:text-sm bg-gray-200 shadow-md focus:outline-none rounded-md ">
            </div>
            <input name="patient_id" hidden v-model="patientId">
            <input name="assurance_id" hidden v-model="assuranceId">
            <div class="flex w-1/2 flex-col justify-center">
              <label class="leading-loose font-semibold ">Date of birth<span class="text-red-500">
        *
       </span></label>
              <div class="flex items-center space-x-4">
                <input @change="ageCalculator" v-model="patientBirth" type="date" name="birthDate"
                       class="px-4 py-2  w-2/3 sm:text-sm bg-gray-200 shadow-md focus:outline-none rounded-md ">

              </div>
            </div>
            <div class="flex flex-col 1/4 justify-center">
              <label class="leading-loose font-semibold ">Age</label>
              <input v-model="patientAge" type="number" readonly name="age"
                     class="px-4 py-2 cursor-default w-16 sm:text-sm bg-gray-200 shadow-md focus:outline-none rounded-md ">
            </div>

          </div>
          <div class="flex items-center justify-center w-full py-4 space-x-4">
            <div class="flex w-1/2 flex-col justify-center">
              <label class="leading-loose font-semibold ">Last Name<span class="text-red-500">
        *
       </span></label>
              <input v-model="patientLast" type="text"
                     class="px-4 py-2  w-2/3 sm:text-sm bg-gray-200 shadow-md focus:outline-none rounded-md ">
            </div>
            <div class="flex w-1/2 flex-col justify-center">
              <label class="leading-loose font-semibold ">Cin<span class="text-red-500">
        *
       </span></label>

              <input v-model="patientCin" type="text"
                     class="px-4 py-2  w-2/3 sm:text-sm bg-gray-200 shadow-md focus:outline-none rounded-md ">

            </div>
          </div>
          <div class="flex items-center justify-center w-full py-4 space-x-4">
            <div class="flex w-1/2 flex-col justify-center">
              <label class="leading-loose font-semibold ">Note</label>
              <textarea v-model="patientNote" rows="4" name="note" id="note" placeholder="Note"
                        class="px-4 py-2  w-full sm:text-sm bg-gray-200 shadow-md focus:outline-none rounded-md "></textarea>
            </div>
            <div class="flex w-1/2 flex-col justify-center">
              <label class="leading-loose font-semibold p-2 ">Assurance</label>
              <div class="flex items-center space-x-4">
                <label>Yes</label>
                <input type="radio" name="assuranceVisibility" v-model="assuranceVisibility" value="Yes" class="">
                <label>No</label>
                <input type="radio" v-model="assuranceVisibility" value="No" name="assuranceVisibility" class="">

              </div>
            </div>
          </div>
          <div class="flex w-1/2 flex-col justify-center" v-show="assuranceVisibility === 'Yes'">
            <label class="leading-loose font-semibold ">Select Assurance Type</label>
            <select @change="importAssuranceId" name="assurance" v-model="assurance"
                    class="px-4 py-2  w-2/3 sm:text-sm bg-gray-200 shadow-md focus:outline-none rounded-md ">

              <option v-bind:key="row.assurance_id" v-for="row in assurancesData">{{ row.assurance_name }}</option>
            </select>
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
        <div class=" bg-white rounded-xl p-4 w-full" :class="displayFormVisibility ? 'hidden' : 'block'">

          <div class="flex items-center justify-center w-full py-4 space-x-4">
            <div class="flex w-1/2 flex-col justify-center">
              <label class="leading-loose font-semibold ">First Name</label>
              <input v-model="patientFirst" type="text" readonly
                     class="px-4 py-2 cursor-default w-2/3 sm:text-sm bg-gray-200 shadow-md focus:outline-none rounded-md ">
            </div>

            <div class="flex w-1/2 flex-col justify-center">
              <label class="leading-loose font-semibold ">Date of birth</label>
              <div class="flex items-center space-x-4">
                <input readonly v-model="patientBirth" type="text"
                       class="px-4 py-2 cursor-default w-2/3 sm:text-sm bg-gray-200 shadow-md focus:outline-none rounded-md ">

              </div>
            </div>
            <div class="flex flex-col 1/4 justify-center">
              <label class="leading-loose font-semibold ">Age</label>
              <input v-model="patientAge" type="number" readonly
                     class="px-4 py-2 cursor-default w-16 sm:text-sm bg-gray-200 shadow-md focus:outline-none rounded-md ">
            </div>

          </div>
          <div class="flex items-center justify-center w-full py-4 space-x-4">
            <div class="flex w-1/2 flex-col justify-center">
              <label class="leading-loose font-semibold ">Last Name</label>
              <input v-model="patientLast" type="text" readonly
                     class="px-4 py-2 cursor-default w-2/3 sm:text-sm bg-gray-200 shadow-md focus:outline-none rounded-md ">
            </div>
            <div class="flex w-1/2 flex-col justify-center">
              <label class="leading-loose font-semibold ">Cin</label>

              <input v-model="patientCin" type="text" readonly
                     class="px-4 py-2 cursor-default w-2/3 sm:text-sm bg-gray-200 shadow-md focus:outline-none rounded-md ">

            </div>
          </div>
          <div class="flex items-center justify-center w-full py-4 space-x-4">
            <div class="flex w-1/2 flex-col justify-center">
              <label class="leading-loose font-semibold ">Note</label>
              <textarea v-model="patientNote" readonly
                        class="px-4 py-2 cursor-default w-full sm:text-sm bg-gray-200 shadow-md focus:outline-none rounded-md "></textarea>
            </div>
            <div class="flex w-1/2 flex-col justify-center">
              <label class="leading-loose font-semibold p-2 ">Assurance</label>
              <div class="flex items-center space-x-4">
                <input type="text" readonly v-model="assuranceVisibility"
                       class="px-4 py-2 cursor-default w-2/3 sm:text-sm bg-gray-200 shadow-md focus:outline-none rounded-md ">
              </div>
            </div>
          </div>
          <div class="flex w-1/2 flex-col justify-center" v-show="assuranceVisibility === 'Yes'">
            <label class="leading-loose font-semibold ">Assurance Type</label>
            <input v-model="assurance" readonly
                   class="px-4 py-2 cursor-default  w-2/3 sm:text-sm bg-gray-200 shadow-md focus:outline-none rounded-md ">
          </div>

        </div>
      </div>
    </div>
  </section>

</template>

<script>


export default {
  components: {},
  props: {},
  data() {
    return {
      //variables
      search: '',
      patientFirst: '',
      patientLast: '',
      patientCin: '',
      patientAppNbr: '',
      assuranceId: '',
      patientId: '',
      patientBirth: '',
      patientAge: '',
      assurance: '',
      patientNote: '',
      assuranceVisibility: '',
      error: 'All Field with * are requires',
      formVisibility: true,
      displayFormVisibility: true,
      displayVisibility: true,
      editVisibility: true,
      addVisibility: true,
      errorField: false,


      //objects
      patientsData: '',
      assurancesData: '',
      appointments: '',
    }
  },
  computed: {
    filter() {
      const data = this.patientsData

      return data && data.filter(item => {
        return item.patientFirst.includes(this.search) || item.patientCin.includes(this.search) || item.patientLast.includes(this.search)
      })


    }
  },

  mounted() {
    this.getPatientData()
    this.fetchAssuranceData()

  },
  methods: {

    getPatientData() {
      fetch('http://127.0.0.1:8000/api/patientDataAppNbr', {
        method: 'get'
      }).then(res => res.json())
          .then(data => this.patientsData = data)
    },
    fetchAssuranceData() {
      fetch('http://127.0.0.1:8000/api/assurances', {
        method: 'get'
      })
          .then(res => res.json())
          .then(data => this.assurancesData = data)
    },
    importAssuranceId() {
      this.assurancesData.forEach(item => {
        if (item.assurance_name === this.assurance) {
          this.assuranceId = item.assurance_id;
        }
      })
    },
    ageCalculator() {
      let today = new Date
      this.patientAge = today.getUTCFullYear() - (new Date(this.patientBirth).getUTCFullYear())
    },
    editPatient(patientId, patientAssuranceId) {
      this.appointments = ''
      this.formVisibility = false;
      this.editVisibility = false;
      this.displayVisibility = true;
      this.addVisibility = true
      this.displayFormVisibility = true


      this.patientsData.forEach(item => {
        if (item.patientId == patientId) {
          this.patientFirst = item.patientFirst;
          this.patientLast = item.patientLast;
          this.patientBirth = item.patientBirth;
          this.patientAge = item.patientAge;
          this.patientCin = item.patientCin;
          this.patientNote = item.patientNote;
          this.assuranceVisibility = item.patientAssuranceVisibility;

        }
      })
      this.assurancesData.forEach(item => {
        if (item.assurance_id == patientAssuranceId) {
          this.assurance = item.assurance_name;
          this.assuranceId = item.assurance_id
        }
      })
    },
    displayPatient(patientId, patientAssuranceId) {
      this.displayFormVisibility = false
      this.displayVisibility = false
      this.editVisibility = true;
      this.addVisibility = true
      this.formVisibility = true
      this.patientsData.forEach(item => {
        if (item.patientId == patientId) {
          this.patientFirst = item.patientFirst;
          this.patientLast = item.patientLast;
          this.patientBirth = item.patientBirth;
          this.patientAge = item.patientAge;
          this.patientCin = item.patientCin;
          this.patientNote = item.patientNote;
          this.assuranceVisibility = item.patientAssuranceVisibility;
          console.log(patientAssuranceId)
        }
      })
      this.assurancesData.forEach(item => {
        if (item.assurance_id == patientAssuranceId) {
          this.assurance = item.assurance_name;
          this.assuranceId = item.assurance_id
        }
      })
      this.getPatientAppointments(patientId);
    },
    addNewPatient() {
      this.addVisibility = false
      this.formVisibility = false
      this.displayFormVisibility = true
      this.displayVisibility = true;
      this.editVisibility = true
      this.patientFirst = this.patientLast = this.patientBirth = this.patientId = this.patientAge = this.assuranceId = this.patientNote = this.patientCin = this.assuranceVisibility = this.appointments = '';
    },
    sendDataIntoDataBase() {
      if (this.patientFirst === '' || this.patientLast === '' || this.patientCin === '' || this.patientBirth === '' || this.patientAge === '' || this.assuranceVisibility === '' || this.assuranceId === '') {
        this.errorField = true
      } else {
        const data = {
          method: 'POST',
          body: JSON.stringify({
            assuranceId: this.assuranceId,
            patientFirst: this.patientFirst,
            patientLast: this.patientLast,
            patientCin: this.patientCin,
            patientBirth: this.patientBirth,
            patientAge: this.patientAge,
            assuranceVisibility: this.assuranceVisibility,
            patientNote: this.patientNote,
          })
        };
        fetch('http://127.0.0.1:8000/api/addNewPatient', data);
        this.addNewPatient()

      }

    },
    getPatientAppointments(id) {
      let data = {
        method: 'POST',
        body: id
      }
      fetch('http://127.0.0.1:8000/api/appointmentPerPatient', data)
          .then(res => res.json())
          .then(data => this.appointments = data)
    }
  }
}
</script>

<style scoped>


</style>