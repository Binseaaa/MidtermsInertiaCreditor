<script setup>
import HeaderBar from '@/Components/HeaderBar.vue';
import {Head, Link} from '@inertiajs/vue3'
</script>

<template>
    <div>
      <Head title="Landing" />
      <HeaderBar/>
      <div class="bg-gradient-to-r from-green-500 to-blue-600 h-screen flex flex-col justify-center items-center text-white">
        <h1 class="text-5xl font-bold mb-8">Welcome to this website!</h1>
        <p class="text-lg mb-12">This is where your dreams come true.</p>
        <Link href="/about" class="bg-white text-blue-500 py-2 px-6 rounded-full font-semibold text-lg hover:bg-blue-900 hover:text-white transition duration-300">Learn More</Link>
      </div>
    </div>
  </template>