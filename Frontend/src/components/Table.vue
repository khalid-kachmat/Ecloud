<template>
  <section class="overflow-x-auto">
    <div class="   flex items-center justify-center  font-sans overflow-hidden">
      <div class="w-full py-20 lg:w-5/6">
        <div class="relative mr-6 my-2 	">
          <input type="search" class="bg-gray-200 shadow-lg rounded-xl  p-2 w-22" placeholder="Search by name...">
          <div class="absolute pin-r pin-t mt-3 mr-4 text-purple-lighter">


          </div>
        </div>
        <div class=" table-bg rounded-xl  shadow-lg  my-6">
          <table class="min-w-max w-full rounded-xl table-auto">
            <thead>
            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
              <th class="py-3 px-6 text-left">Patient</th>
              <th class="py-3 px-6 text-left">Doctor</th>
              <th class="py-3 px-6 text-center">Schedule</th>
              <th class="py-3 px-6 text-center">Status</th>
              <th class="py-3 px-6 text-center">Actions</th>
            </tr>
            </thead>
            <tbody class="text-gray-600 text-sm rounded-xl font-light">
            <tr class="border-b border-gray-200 hover:bg-gray-100">
              <td class="py-3 px-6 text-left whitespace-nowrap">

              </td>
              <td class="py-3 px-6 text-left">

              </td>
              <td class="py-3 px-6 text-center">

              </td>
              <td class="py-3 px-6 text-center">
                <span class="bg-purple-200 text-purple-600 py-1 px-3 rounded-full text-xs">Active</span>
              </td>
              <td class="py-3 px-6 text-center">
                <div class="flex item-center justify-center">
                  <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                  </div>
                  <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                    </svg>
                  </div>
                  <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
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
  </section>
</template>

<script>
export default {
  name: "Table"
}
</script>

<style scoped>
main {
  position: absolute;
  width: 84%;
  /*z-index: 1;*/
  height: 100%;
  background-color: white;
  margin-left: 8rem;
  padding: 1rem;
  border-radius: 40px 40px 40px ;
  overflow-x: hidden;
}
.navbar {
  background-color: #6ECD89;
  width: 20rem;
  height: 100vh;
  position: fixed;
  /*z-index: 1;*/
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

.link-text{
  display: none;
}
.user{
  margin-right: 11em;
}

.head-card{
  background-color: #6ECD89;
  border-radius: 36px;
}
.table-bg{
  background-color: #F2F2F2;
}

.table {
  border-spacing: 0 15px;
}

i {
  font-size: 1rem !important;
}

.table tr {
  border-radius: 20px;
}

tr td:nth-child(n+5),
tr th:nth-child(n+5) {
  border-radius: 0 .625rem .625rem 0;
}

tr td:nth-child(1),
tr th:nth-child(1) {
  border-radius: .625rem 0 0 .625rem;
}

</style>