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

    <main class="h-screen ">

      <component :is="content"/>

    </main>

  </div>





</template>

<script>
import Table from "../components/Table";
import Users from "../components/Users";


export default {
  name: 'Dash',
  props: {
    msg: String,
    content: String
  },
  components: {
    Table,
    Users,
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
main {
  position: relative;
  z-index: 1;
  width: auto;
  background-color: rgb(243, 243, 243);
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
