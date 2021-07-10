<template>


  <div>
    <nav class="navbar">
      <ul class="navbar-nav">
        <li class="logo">
          <a href="index.html" class="nav-link">

            <i class="fab fa-autoprefixer"></i>

            <span class="user">User</span>

          </a>
        </li>

        <li class="nav-item"><a href="index.html" class="nav-link">
          <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"
               xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
            </path>
          </svg>
          <span class="link-text">Home</span>
        </a></li>
        <li class="nav-item"><a href="gallery.html" class="nav-link">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
          </svg>
          <span class="link-text">GALLERY</span>
        </a></li>
        <li class="nav-item"><a href="reserve.html" class="nav-link">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
          </svg>
          <span class="link-text">RESERVATION</span>
        </a></li>
        <li class="nav-item"><a href="contactus.html" class="nav-link">
          <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"
               xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z">
            </path>
          </svg>
          <span class="link-text">CONTACT US</span>
        </a></li>
        <li class="nav-item"><a href="#" class="nav-link">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
          </svg>
          <span class="link-text">Logout</span>
        </a></li>


      </ul>
    </nav>

    <main class="h-screen">

      <section class=" flex  w-screen h-screen m-12">

        <FullCalendar class="w-1/2 h-4/3" @select="handleSelect" :options="calendarOptions"/>
        <div class="w-1/2 h-2/3 ">

          <AppointmentForm :start="start" :end="end" :endDate="endDate" :endTime="endTime" :startDate="startDate"
                           :startTime="startTime"/>

        </div>
      </section>


    </main>

  </div>


</template>

<script>
import AppointmentForm from "@/components/AppointmentForm";
// import VueSweetalert2 from "vue-sweetalert2";

import '@fullcalendar/core/vdom'
import FullCalendar from '@fullcalendar/vue'
import dayGridPlugin from '@fullcalendar/daygrid'
import interactionPlugin from '@fullcalendar/interaction'
import timeGridPlugin from '@fullcalendar/timegrid'




export default {
  components: {
    FullCalendar,
    AppointmentForm
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
        eventColor: "#6ECD89",
        eventTextColor: 'white',
        height: "70vh",
        themeSystem: "Minty",

        eventTimeFormat: { // like '14:30:00'
          hour: '2-digit',
          minute: '2-digit',
          second: '2-digit',
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
  computed:{

  },
  mounted() {

    this.getAppointmentData()

  },
  methods: {
    handleSelect: function (item) {
      console.log(item.startStr)
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
      this.$swal(item.event.title)
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


  }
}

//ending

// document.querySelector('button').classList.add("color-btn")

// export default {
//   name: 'Dash',
//   props: {
//     msg: String,
//     content: String
//   },
//   // components: {
//   //   Table,
//   //   Users,
//   //   test
//   // }
// }
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
main {
  position: relative;
  z-index: 1;
  width: auto;
  background-color: white;
  margin-left: 8rem;
  border-radius: 40px 40px 40px;
  overflow-x: hidden;
}

.navbar {
  background-color: #6ECD89;
  width: 20rem;
  height: 100vh;
  position: fixed;
  transition: 300ms ease;
}


.navbar-nav {
  list-style: none;
  padding: 0;
  margin: 0;
  display: flex;
  flex-direction: column;
  align-items: center;
  height: 100%;

}

.nav-item {
  width: 100%;
}


.social i.fab {
  font-size: 3em;
  color: black;
}

.nav-item:last-child {
  margin-top: auto;
}

.nav-link {
  display: flex;
  align-items: center;
  height: 5rem;
  text-decoration: none;
  color: black;
}

.nav-link svg {
  width: 3em;
  min-width: 3rem;
  margin: 0 2.5rem;
  height: 2em;
}

.navbar:hover {
  width: 20rem;
  transition: 300ms ease;
}


.nav-link .fab {
  font-size: 2rem;
}

.nav-link .far {
  font-size: 2rem;
  margin: 0 1.5rem;
}

.nav-link:hover {
  color: white;
}

.link-text {
  display: none;
  margin-left: 1rem;
}

.navbar:hover .link-text {
  display: block;
}

.logo {
  font-weight: bold;
  text-transform: uppercase;
  margin-bottom: 1rem;
  text-align: center;
  letter-spacing: 0.3ch;
}

.link-text {
  display: none;
}

.user {
  margin-right: 11em;
}

.head-card {
  background-color: #6ECD89;
  border-radius: 36px;
}

.color-btn {

  background-color: #6ECD89 !important;

}

.fc .fc-button-primary {

  background-color: #24ff17 !important;


}

</style>
