<template>


  <div class="w-full   ">

    <div class="flex justify-center xl:w-3/4 my-5 font-semibold text-gray-500 ">
      <h1 class=""><span>Appointment Details</span></h1>
    </div>

    <form @submit.prevent="sendDataIntoDataBase" class=" rounded-xl  bg-white xl:w-3/4 p-4 shadow-xl">
      <div><span style="color:red" v-show="errorField">{{ error }}</span>
        <div class="flex justify-center items-center w-full space-y-5 space-x-12">
          <div class="flex w-1/2 flex-col justify-center">
            <label class="leading-loose">Service<span class="text-red-500">
        *
       </span></label>
            <select @change="importServiceId" v-model="service" name="service"
                    class="px-4 py-2  w-2/3 sm:text-sm bg-gray-200 shadow-md focus:outline-none rounded-md ">

              <option v-bind:key="row.service_id" v-for="row in servicesData">{{ row.service_name }}</option>
            </select>
          </div>
          <div class="flex w-1/2 flex-col justify-center">
            <label class="leading-loose">Start Date/Time<span class="text-red-500">
        *
       </span></label>
            <div class="flex full space-x-3  justify-center">
              <input v-model="startDate" name="startDate"
                     class="px-4 py-2  w-2/3 sm:text-sm bg-gray-200 shadow-md focus:outline-none rounded-md "
                     type="date">
              <input
                  v-model="startTime" name="startTime"
                  class="px-4 py-2  w-30 sm:text-sm bg-gray-200 shadow-md focus:outline-none rounded-md "
                  type="time">
            </div>

          </div>
        </div>
        <div class="flex justify-center items-center w-full space-x-12">
          <div class="flex w-1/2 flex-col justify-center ">
            <label class="leading-loose">Doctor<span class="text-red-500">
        *
       </span></label>
            <select @change="importDocId" v-model="doctor" name="doctor"
                    class="px-4 py-2  w-2/3 sm:text-sm bg-gray-200 shadow-md focus:outline-none rounded-md ">

              <option v-bind:key="row.doc_id" v-for="row in docsData">{{ row.name }}</option>
            </select>
          </div>

          <div class="flex w-1/2 flex-col justify-center ">
            <label class="leading-loose">End Date/Time<span class="text-red-500">
        *
       </span></label>
            <div class="flex full space-x-3 justify-center">
              <input v-model="endDate" name="endDate"
                     class="px-4 py-2  w-2/3 sm:text-sm bg-gray-200 shadow-md focus:outline-none rounded-md "
                     type="date">
              <input v-model="endTime" name="endTime"
                     class="px-4 py-2  w-30 sm:text-sm bg-gray-200 shadow-md focus:outline-none rounded-md "
                     type="time">
            </div>
          </div>
        </div>
        <div class="flex justify-center items-center w-full space-x-12">

        </div>
      </div>

      <div class=" w-full justify-center items-center  py-12">

        <div class="flex w-full justify-center item-center space-x-3">
          <label class="leading-fixed font-semibold text-xl ml">Patient Details</label>

          <button
              v-on:click.prevent="addPatient"
              class=" p-1 border  border-gray-500 hover:border-white hover:text-white hover:bg-gray-500 text-gray-500 font-bold transition ease-in-out duration-700  rounded-xl inline-flex items-center">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                 xmlns="http://www.w3.org/2000/svg">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <span>New</span>
          </button>

          <button
              v-on:click.prevent="selectPatient"
              class=" p-1 border  border-gray-500 hover:border-white hover:text-white hover:bg-gray-500 text-gray-500 font-bold transition ease-in-out duration-700  rounded-xl inline-flex items-center">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                 xmlns="http://www.w3.org/2000/svg">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122"></path>
            </svg>
            <span>{{ selectBtn ? 'Select' : 'Hide' }}</span>
          </button>
        </div>
        <div class=" " :class="selectBtn ? 'hidden' : 'block' ">
          <div class="flex w-full items-center justify-center">
            <input v-model="search" type="search" placeholder="Enter Patient name..."
                   class="px-4 py-2 m-3  w-2/3 sm:text-sm bg-gray-200 shadow-md focus:outline-none rounded-md ">
          </div>
          <div class="flex flex-wrap space-x-4 w-full bg-gray-200 justify-center rounded-xl items-center"
               id="existing-customers-list">

            <button v-for="(row) in filter " :key="row.patient_id"
                    v-on:click.prevent="displayPatientData(row.patient_id, row.patient_assurance_id)"
                    class=" p-0.5 my-2 border-black text-black font-semibold  hover:border-white hover:text-gray-600 hover:bg-white  font-bold transition ease-in-out duration-700  rounded "
                    v-bind:id="row.patient_id">{{ row.patient_first_name }} {{ row.patient_last_name }}
            </button>

          </div>
        </div>
        <div class="block " :class="addBtn ? 'hidden' : 'block'">
          <div class="flex items-center justify-center w-full py-4 space-x-4">
            <div class="flex w-1/2 flex-col justify-center">
              <label class="leading-loose font-semibold ">First Name<span class="text-red-500">
        *
       </span></label>
              <input v-model="firstName" type="text" name="firstName"
                     class="px-4 py-2  w-2/3 sm:text-sm bg-gray-200 shadow-md focus:outline-none rounded-md ">
            </div>
            <input name="patient_id" hidden v-model="patientId">
            <input name="assurance_id" hidden v-model="assuranceId">
            <div class="flex w-1/2 flex-col justify-center">
              <label class="leading-loose font-semibold ">Date of birth<span class="text-red-500">
        *
       </span></label>
              <div class="flex items-center space-x-4">
                <input @change="ageCalculator" v-model="birthDate" type="date" name="birthDate"
                       class="px-4 py-2  w-2/3 sm:text-sm bg-gray-200 shadow-md focus:outline-none rounded-md ">

              </div>
            </div>
            <div class="flex flex-col 1/4 justify-center">
              <label class="leading-loose font-semibold ">Age</label>
              <input v-model="age" type="number" readonly name="age"
                     class="px-4 py-2  w-16 sm:text-sm bg-gray-200 shadow-md focus:outline-none rounded-md cursor-default ">
            </div>

          </div>
          <div class="flex items-center justify-center w-full py-4 space-x-4">
            <div class="flex w-1/2 flex-col justify-center">
              <label class="leading-loose font-semibold ">Last Name<span class="text-red-500">
        *
       </span></label>
              <input v-model="lastName" type="text"
                     class="px-4 py-2  w-2/3 sm:text-sm bg-gray-200 shadow-md focus:outline-none rounded-md ">
            </div>
            <div class="flex w-1/2 flex-col justify-center">
              <label class="leading-loose font-semibold ">Cin<span class="text-red-500">
        *
       </span></label>

              <input v-model="cin" type="text"
                     class="px-4 py-2  w-2/3 sm:text-sm bg-gray-200 shadow-md focus:outline-none rounded-md ">

            </div>
          </div>
          <div class="flex items-center justify-center w-full py-4 space-x-4">
            <div class="flex w-1/2 flex-col justify-center">
              <label class="leading-loose font-semibold ">Note</label>
              <textarea v-model="note" rows="4" name="note" id="note" placeholder="Note"
                        class="px-4 py-2  w-full sm:text-sm bg-gray-200 shadow-md focus:outline-none rounded-md "></textarea>
            </div>
            <div class="flex w-1/2 flex-col justify-center">
              <label class="leading-loose font-semibold p-2 ">Assurance<span class="text-red-500">
        *
       </span></label>
              <div class="flex items-center space-x-4">
                <label>Yes</label>
                <input type="radio" name="assuranceVisibility" v-model="assuranceVisibility" value="Yes" class="">
                <label>No</label>
                <input type="radio" v-model="assuranceVisibility" value="No" name="assuranceVisibility" class="">

              </div>
            </div>
          </div>
          <div class="flex w-1/2 flex-col justify-center" v-show="assuranceVisibility === 'Yes'">
            <label class="leading-loose font-semibold ">Select Assurance Type<span class="text-red-500">
        *
       </span></label>
            <select @change="importAssuranceId" name="assurance" v-model="assurance"
                    class="px-4 py-2  w-2/3 sm:text-sm bg-gray-200 shadow-md focus:outline-none rounded-md ">

              <option v-bind:key="row.assurance_id" v-for="row in assurancesData">{{ row.assurance_name }}</option>
            </select>
          </div>
        </div>
      </div>
      <div class="flex flex-col items-center justify-center w-full">
        <button type="submit"
                class="w-1/2 px-1 py-1    bg-gray-200 hover:text-black  text-gray-500 font-bold transition ease-in-out duration-700  rounded-xl shadow-md ">
          Save
        </button>
        <span class="m-4 text-red-500" v-show="errorField">{{ error }}</span>
      </div>
    </form>
  </div>
</template>

<script>

export default {
  name: "CalendarForm",
  props: [
    'startTime',
    'startDate',
    'endTime',
    'endDate',
    'start',
    'end',
  ],
  data() {
    return {
      assuranceId: '',
      patientId: '',
      firstName: '',
      lastName: '',
      cin: '',
      birthDate: '',
      age: '',
      assurance: '',
      note: '',
      selectBtn: true,
      addBtn: true,
      assuranceVisibility: 'No',
      patientsData: '',
      assurancesData: '',
      search: '',
      docsData: '',
      doctor: '',
      docId: '',
      service: '',
      serviceId: '',
      servicesData: '',
      error: 'All Field with * are requires',
      errorField: false,
      // newDate:'',


    }
  },
  computed: {
    filter() {
      const data = this.patientsData
      return data && data.filter(item => {
        return item.patient_first_name.includes(this.search) || item.patient_last_name.includes(this.search)
      })
    }
  },
  mounted() {
    this.fetchPatientsData()
    this.fetchAssuranceData()
    this.fetchDocData()
    this.fetchServicesData()
  },
  methods: {
    selectPatient() {
      this.selectBtn = !this.selectBtn
    },
    addPatient() {
      this.addBtn = !this.addBtn
    },
    fetchPatientsData() {
      fetch('http://127.0.0.1:8000/api/patients', {
        method: 'get'
      })
          .then(res => res.json())
          .then(data => this.patientsData = data)

    },
    fetchAssuranceData() {
      fetch('http://127.0.0.1:8000/api/assurances', {
        method: 'get'
      })
          .then(res => res.json())
          .then(data => this.assurancesData = data)
    },
    fetchDocData() {
      fetch('http://127.0.0.1:8000/api/getDocData', {
        method: 'get'
      })
          .then(res => res.json())
          .then(data => this.docsData = data)
    },
    fetchServicesData() {
      fetch('http://127.0.0.1:8000/api/services', {
        method: 'get'
      })
          .then(res => res.json())
          .then(data => this.servicesData = data)
    },
    displayPatientData(patientIid, assuranceId) {

      this.assuranceId = '';
      this.addBtn = false;
      this.patientsData.forEach(item => {

        if (item.patient_id === patientIid) {
          this.patientId = item.patient_id
          this.firstName = item.patient_first_name;
          this.lastName = item.patient_last_name;
          this.birthDate = item.patient_birth;
          this.age = item.patient_age;
          this.cin = item.patient_cin
          this.assuranceVisibility = item.patient_assurance;
          this.note = item.patient_note
        }
      })

      this.assurancesData.forEach(item => {
        if (item.assurance_id == assuranceId) {
          this.assurance = item.assurance_name
          this.assuranceId = item.assurance_id

        }
      })

    },
    sendDataIntoDataBase() {
      if (this.firstName === '' || this.lastName === '' || this.cin === '' || this.birthDate === '' || this.age === '' || this.assuranceVisibility === '' || this.doctor === '' || this.service === '' || this.startTime === '' || this.startDate === '' || this.endDate === '' || this.endTime === '') {
        this.errorField = true
      } else {
        const data = {
          method: 'POST',
          body: JSON.stringify({
            assuranceId: this.assuranceId,
            patientId: this.patientId,
            firstName: this.firstName,
            lastName: this.lastName,
            cin: this.cin,
            birthDate: this.birthDate,
            age: this.age,
            assuranceVisibility: this.assuranceVisibility,
            note: this.note,
            docId: this.docId,
            serviceId: this.serviceId,
            startTime: this.startTime,
            startDate: this.startDate,
            endTime: this.endTime,
            endDate: this.endDate,
            start: this.start,
            end: this.end,
          })
        };
        fetch('http://127.0.0.1:8000/api/getAppointmentData', data);
        location.reload()

      }

    },
    importAssuranceId() {
      this.assurancesData.forEach(item => {
        if (item.assurance_name === this.assurance) {
          this.assuranceId = item.assurance_id;
        }
      })
    },
    importDocId() {
      this.docsData.forEach(item => {
        if (item.name === this.doctor) {
          this.docId = item.doc_user_id;


        }
      })
    },
    importServiceId() {
      this.servicesData.forEach(item => {
        if (item.service_name === this.service) {
          this.serviceId = item.service_id;


        }
      })
    },
    clearFields() {
      this.startDate = '';
      this.startTime = '';
      this.endDate = '';
      this.endTime = '';
      this.start = '';
      this.end = '';
      this.service = '';
      this.doctor = '';
      this.firstName = '';
      this.lastName = '';
      this.age = '';
      this.birthDate = '';
      this.note = '';
      this.addBtn = true
      this.selectBtn = true
      this.$refs.calendar.$emit('refetch-events')

    },
    ageCalculator() {
      let today = new Date
      this.age = today.getUTCFullYear() - (new Date(this.birthDate).getUTCFullYear())
    }

  }
}
</script>

<style scoped>
#existing-customers-list {
  overflow-y: auto;
  margin-bottom: 8px;
  font-size: 12px;
  line-height: 22px;
  pointer-events: auto;
}


</style>