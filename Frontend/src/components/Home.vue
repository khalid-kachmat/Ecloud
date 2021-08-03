<template>


  <div>


    <section class="text-gray-600 body-font">
      <div class="container px-5 py-8 mx-auto">
        <div class="flex flex-wrap  text-center">
          <div class="p-4 sm:w-1/4 w-1/2 ">

            <h2 class="title-font font-medium sm:text-4xl text-3xl text-gray-900">{{ statistic.appointments }}</h2>
            <p class="leading-relaxed">Total Appointments</p>

          </div>
          <div class="p-4 sm:w-1/4 w-1/2">
            <h2 class="title-font font-medium sm:text-4xl text-3xl text-gray-900">{{ statistic.appointmentsToday }}</h2>
            <p class="leading-relaxed">Appointments Today</p>
          </div>
          <div class="p-4 sm:w-1/4 w-1/2">
            <h2 class="title-font font-medium sm:text-4xl text-3xl text-gray-900">{{ statistic.patients }}</h2>
            <p class="leading-relaxed">Patients Registered</p>
          </div>
          <div class="p-4 sm:w-1/4 w-1/2">
            <h2 class="title-font font-medium sm:text-4xl text-3xl text-gray-900">{{ statistic.doctors }}</h2>
            <p class="leading-relaxed">Doctors</p>
          </div>
        </div>
      </div>
    </section>


    <section id="calendarSection" class="flex my-10 md:ml-10 justify-center">

      <FullCalendar id="fullCalendar"
                    class="w-11/12 bg-white p-4 rounded-xl shadow-xl  font-semibold text-gray-500"
                    @select="handleSelect" :options="calendarOptions"/>

    </section>

  </div>
</template>

<script>

import '@fullcalendar/core/vdom'
import FullCalendar from '@fullcalendar/vue'
import dayGridPlugin from '@fullcalendar/daygrid'
import interactionPlugin from '@fullcalendar/interaction'
import timeGridPlugin from '@fullcalendar/timegrid'

export default {
  components: {
    FullCalendar,
  },
  props: {
    msg: String,
    content: String
  },
  data() {
    return {
      startDate: '',
      startTime: '',
      endDate: '',
      endTime: '',
      end: '',
      start: '',
      statistic: '',
      appEventsData: '',
      calendarOptions: {
        plugins: [
          dayGridPlugin,
          timeGridPlugin,
          interactionPlugin // needed for dateClick
        ],
        eventSources: [{
          url: 'http://127.0.0.1:8000/api/sentAppointmentData',

        }],

        select: this.handleSelect,
        // dateClick: this.handleDateClick,
        // eventClick:'',
        headerToolbar: {
          left: 'prev,next today',
          center: 'title',
          right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        initialView: 'timeGridDay',
        // initialEvents: INITIAL_EVENTS, // alternatively, use the `events` setting to fetch from a feed
        editable: true,
        eventMouseEnter: this.showComment,
        eventClick: this.showEvent,
        selectable: true,
        selectMirror: true,
        dayMaxEvents: true,
        weekends: false,
        allDaySlot: false,
        slotMinTime: '08:00',
        slotMaxTime: '18:00',
        slotDuration: '00:15:00',
        longPressDelay: 100,
        eventColor: "#6EE7B7",
        eventTextColor: 'black',
        height: "72vh",
        themeSystem: "Minty",

        eventTimeFormat: { // like '14:30:00'
          hour: '2-digit',
          minute: '2-digit',
          hour12: false
        },

        slotLabelFormat: {
          hour: '2-digit',
          minute: '2-digit',
          omitZeroMinute: true,
          hour12: false
        },

        businessHours: {
          // days of week. an array of zero-based day of week integers (0=Sunday)
          daysOfWeek: [1, 2, 3, 4, 5], // Monday - Thursday

          startTime: '09:00', // a start time (10am in this example)
          endTime: '18:00', // an end time (6pm in this example)
        },
      }
    }
  },
  computed: {},
  mounted() {
    this.getAppointmentData()
    this.statistics()
  },
  methods: {
    handleSelect: function (item) {

      this.start = item.startStr;
      this.end = item.endStr;
      this.startDate = (new Date(item.startStr)).toISOString().slice(0, 10)
      let startHours = (new Date(item.startStr)).getHours()
      let startMin = (new Date(item.startStr)).getUTCMinutes()
      if (startHours < 10) {
        startHours = '0' + startHours
      }
      if (startMin < 10) {
        startMin = '0' + startMin
      }
      this.startTime = startHours + ':' + startMin

      this.endDate = (new Date(item.endStr)).toISOString().slice(0, 10)
      let endHours = (new Date(item.endStr)).getHours()
      let endMin = (new Date(item.endStr)).getUTCMinutes()
      if (endHours < 10) {
        endHours = '0' + endHours
      }
      if (endMin < 10) {
        endMin = '0' + endMin
      }
      this.endTime = endHours + ':' + endMin

    },
    getAppointmentData() {
      fetch('http://127.0.0.1:8000/api/sentAppointmentData', {
        method: 'get'
      })
          .then(res => res.json())
          .then(data => this.appEventsData = data)

    },
    showEvent: function (item) {
      // this.$swal(item.event.title)
      this.$swal.fire({
        title: 'Do you want to Delete this ?',
        text: item.event.title,
        showDenyButton: true,
        showCancelButton: true,
        showConfirmButton: false,
        denyButtonText: `Delete`,
      }).then((result) => {
        if (result.isDenied) {
          this.deleteAppointment(item.event.id)
          this.$swal.fire('Deleted!', '', 'success')
        }
      })
    },
    showComment: function (item) {
      this.$swal({
        width: 'auto',
        height: 'auto',
        title: item.event.title,
        text: 'Starting at : ' + item.event.startStr,
        toast: true,
        showConfirmButton: false,
        timer: 2000,

      });
    },
    deleteAppointment(id) {
      let data = {
        method: 'POST',
        body: id
      }
      fetch('http://127.0.0.1:8000/api/deleteAppointment', data)
      location.reload()

    },
    statistics() {
      let today = (new Date).toISOString().slice(0, 10)
      fetch('http://127.0.0.1:8000/api/statistics', {
        method: 'Post',
        body: today
      })
          .then(res => res.json())
          .then(data => this.statistic = data)

    }
  }
}

</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>
