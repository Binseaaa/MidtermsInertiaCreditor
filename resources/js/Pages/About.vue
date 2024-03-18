<script setup>
import HeaderBar from '@/Components/HeaderBar.vue';
import {Head} from '@inertiajs/vue3'
</script>

<template>
    <div>
      <Head title="About"/>
      <HeaderBar/>
      <div class="bg-gray-100">
        <div class="container mx-auto px-4 py-12">
          <div class="max-w-3xl mx-auto bg-white shadow-md rounded-lg overflow-hidden">
            <div class="p-6">
              <h1 class="text-3xl font-bold mb-4 text-gray-800">About Us</h1>
              <p class="text-lg text-gray-700 mb-6">In today's digital world, information technology (IT) plays a crucial role in driving innovation and transforming businesses. At Our Company, we are passionate about harnessing the power of technology to solve complex challenges and create meaningful solutions.</p>
              <p class="text-lg text-gray-700 mb-6">With a team of skilled professionals and cutting-edge technology, we deliver robust IT solutions tailored to meet the unique needs of our clients. From cloud computing and cybersecurity to data analytics and artificial intelligence, we leverage the latest advancements to drive success.</p>
              <p class="text-lg text-gray-700 mb-6">Our commitment to excellence and customer satisfaction drives everything we do. Whether you're a small startup or a large enterprise, we're here to empower your business with innovative IT solutions that propel you towards success in the digital age.</p>
              <div class="flex gap-2">
                <a href="https://www.facebook.com/davinccii14/" target="_blank">
                <svg class="h-8 w-8 text-blue-500"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">  <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z" /></svg>
                </a> 
                <a href="https://www.youtube.com/channel/UCVpq7-et2gGU_W7xOjUBgmw" target="_blank">
                    <svg class="h-8 w-8 text-red-500"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">  <path d="M22.54 6.42a2.78 2.78 0 0 0-1.94-2C18.88 4 12 4 12 4s-6.88 0-8.6.46a2.78 2.78 0 0 0-1.94 2A29 29 0 0 0 1 11.75a29 29 0 0 0 .46 5.33A2.78 2.78 0 0 0 3.4 19c1.72.46 8.6.46 8.6.46s6.88 0 8.6-.46a2.78 2.78 0 0 0 1.94-2 29 29 0 0 0 .46-5.25 29 29 0 0 0-.46-5.33z" />  <polygon points="9.75 15.02 15.5 11.75 9.75 8.48 9.75 15.02" /></svg>
                </a>
                <a href="https://github.com/Binseaaa" target="_blank">
                    <svg class="h-8 w-8 text-black"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">  <path d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22" /></svg>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </template>   
