<script setup>
import HeaderBar from '@/Components/HeaderBar.vue';
import {Head, Link, useForm} from '@inertiajs/vue3'

const props = defineProps({
    creditor: Object
})

const form = useForm({
    last_name: props.creditor.last_name,
    first_name: props.creditor.first_name,
    gender: props.creditor.gender,
    birth_date: props.creditor.birth_date,
    phone: props.creditor.phone,
    address: props.creditor.address,
    credit_limit: props.creditor.credit_limit,
})  
</script>

<template>
   <Head title="Creditors"/>
   <HeaderBar />
    <div class="p-8 mx-auto max-w-xl">
        
        <h1 class="text-4xl mb-10">Property Details</h1>
        <div class="border-8 rounded-3xl shadow rounded">
            <table class="w-full border-collapse border-8">
                <tr>
                    <th class="px-4 py-2 bg-gray-100 border border-gray-300">Last Name:</th>
                    <td class="px-4 py-2 border border-gray-300">{{ creditor.last_name }}</td>
                </tr>
                <tr>
                    <th class="px-4 py-2 bg-gray-100 border border-gray-300">First Name:</th>
                    <td class="px-4 py-2 border border-gray-300">{{ creditor.first_name }}</td>
                </tr>
                <tr>
                    <th class="px-4 py-2 bg-gray-100 border border-gray-300">Gender:</th>
                    <td class="px-4 py-2 border border-gray-300">{{ creditor.gender }}</td>
                </tr>
                <tr>
                    <th class="px-4 py-2 bg-gray-100 border border-gray-300">Address:</th>
                    <td class="px-4 py-2 border border-gray-300">{{ creditor.address }}</td>
                </tr>
                <tr>
                    <th class="px-4 py-2 bg-gray-100 border border-gray-300">Phone:</th>
                    <td class="px-4 py-2 border border-gray-300">{{ creditor.phone }}</td>
                </tr>
                <tr>
                    <th class="px-4 py-2 bg-gray-100 border border-gray-300">Birth Date:</th>
                    <td class="px-4 py-2 border border-gray-300">{{ creditor.birth_date }}</td>
                </tr>
                <tr>
                    <th class="px-4 py-2 bg-gray-100 border border-gray-300">Credit Limit:</th>
                    <td class="px-4 py-2 border border-gray-300">{{ creditor.credit_limit }}</td>
                </tr>
            </table>
            <div class="flex justify-between m-5">
                    <Link :href="'/creditors'" class="p-2.5 px-20 bg-green-800 text-white rounded hover:bg-green-600">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3" />
                        </svg>
                    </Link>
                </div>
        </div>
    </div>
</template>