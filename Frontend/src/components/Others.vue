<template>
  <section class="  ">
    <div class="xl:w-full flex justify-center my-4 font-semibold text-gray-500 mt-10">
      <h1><span>Service and Assurance information</span></h1>
    </div>
    <div class="flex">

      <div class=" w-2/3 overflow-x-auto h-1/2  font-sans overflow-hidden ">
        <div class="w-full lg:w-5/6">

          <div class="rounded-xl  border w-1/2 mx-auto my-4">
            <!-- Tabs -->
            <ul id="tabs" class="inline-flex bg-gray-200 pt-2 px-1 w-full rounded-xl">
              <li id="Doctors"
                  class=" bg-gray-100 cursor-pointer px-4 text-gray-800 font-semibold py-2 rounded-xl border-t border-r border-l -mb-px">
                <a  @click="tabChange('Services')">Services</a></li>
              <li id="Secretaries" class="cursor-pointer px-4 text-gray-800 font-semibold py-2 rounded-xl"><a
                  @click="tabChange('Assurances')" >Assurance</a></li>
            </ul>
          </div>
          <!-- endTabs-->
        </div>
      </div>
      <div/>
    </div>
    <component :is="content"/>

  </section>

</template>

<script>

import Services from "@/components/Services";
import Assurances from "@/components/Assurances";

export default {
  components: {
    Services,
    Assurances,
  },
  props: {},
  data() {
    return {
      //variables
      content: 'Services',
    }
  },

  methods: {
    tabChange(component) {
      this.content = component
      let doc = document.querySelector('#Doctors');
      let sec = document.querySelector('#Secretaries')
      if (component === 'Assurances'){
        doc.classList.remove("border-t", "border-r", "border-l", "-mb-px", "bg-gray-100");
        sec.classList.add("border-t", "border-r", "border-l", "-mb-px", "bg-gray-100")
      }else {
        doc.classList.add("border-t", "border-r", "border-l", "-mb-px", "bg-gray-100");
        sec.classList.remove("border-t", "border-r", "border-l", "-mb-px", "bg-gray-100")
      }

    }

  }
}


</script>

<style scoped>


</style>