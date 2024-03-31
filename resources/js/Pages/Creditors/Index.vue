<script setup>
import { Head, Link, useForm} from '@inertiajs/vue3';
import HeaderBar from '@/Components/HeaderBar.vue';
import { ref } from 'vue';

const { creditor } = defineProps({
    creditor: Object
})

const showCreditors = ref(null)
const editCreditors = ref(null)
const deleteCreditorId = ref(null);
const showDeleteModal = ref(false);
const showCreateModal = ref(false); 
const form = useForm({
    last_name: '',
    first_name: '',
    gender: '',
    birth_date: '',
    phone: '',
    address: '',
    credit_limit: '',
})

const toggleEditModal = (creditor) => {
    editCreditors.value = creditor;
    form.last_name = creditor.last_name;
    form.first_name = creditor.first_name;
    form.gender = creditor.gender;
    form.birth_date = creditor.birth_date;
    form.phone = creditor.phone;
    form.address = creditor.address;
    form.credit_limit = creditor.credit_limit;
}

const toggleDeleteModal = (show, creditorId = null) => {
    showDeleteModal.value = show;
    if (show) {
        deleteCreditorId.value = creditorId;
    } else {
        deleteCreditorId.value = null;
    }
}

const delCred = () => {
    const delForm = useForm({
        id: deleteCreditorId.value
    });
    delForm.submit('delete', `/creditors/${deleteCreditorId.value}`);
    toggleDeleteModal(false);
}

const showtoggleModal = (creditor) => {
    showCreditors.value = creditor;
}

const submit = () => {
    form.submit('put', '/creditors/' + editCreditors.value.id);
    toggleEditModal(false);
}

const toggleCreateModal = (show) => {
    showCreateModal.value = show;
        form.last_name = '';
        form.first_name = '';
        form.gender = '';
        form.birth_date = '';
        form.phone = '';
        form.address = '';
        form.credit_limit = '';
}

const create = async () => {
    form.submit('post', '/creditors')
    toggleCreateModal(false);
}
</script>

<template>
    <Head title="Creditors" />
    <HeaderBar/>
    <div class="overflow-hidden w-full p-5">
        <div class="flex justify-between p-5">
            <h2 class="text-4xl">List of Creditors</h2>
            <button @click="toggleCreateModal" class="hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:hover:bg-green-500 dark:focus:ring-green-800" type="button">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z" />
                </svg>
            </button>
        </div>
        <div class="grid grid-cols-3 gap-8">
            <div v-for="c in creditor" :key="c.id" class="max-w-lg h-lg border-8 rounded-3xl shadow p-5 m-5">
                <div class="flex items-center p-5">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 25 25" stroke-width="1.5" stroke="currentColor" class="w-15 h-10">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    </svg>
                    <h5 class="text-2xl font-bold ml-2">{{c.last_name}}, {{ c.first_name }}</h5>
                </div>
                <p class="mb-3 px-5 font-normal text-black">Address: {{ c.address }}</p>
                <p class="mb-3 px-5 font-normal text-black italic flex gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Z" />
                    </svg>
                    Credit Limit:  {{ c.credit_limit }}</p>
                <div class="flex gap-2 justify-end">
                    <button @click="showtoggleModal(c)" class="py-2 hover:text-green-600 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        </svg>
                    </button>
                    <button @click="toggleEditModal(c)" class="py-2 hover:text-blue-600 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                        </svg>
                    </button>
                    <button @click="() => toggleDeleteModal(true, c.id)" class="py-2 hover:text-red-600 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div v-if="showDeleteModal" id="delete-modal" class="fixed top-0 left-0 flex items-center justify-center w-full h-full bg-black bg-opacity-50">
    <div class="dark:border-gray-700 bg-gray-900 p-8 rounded-lg shadow-lg">
        <h2 class="text-lg font-semibold mb-4 text-white">Confirm Deletion</h2>
        <p class="mb-4 text-white">Are you sure you want to delete this creditor?</p>
        <div class="flex justify-end">
            <button @click="delCred" class="px-4 py-2 bg-red-600 text-white rounded-lg mr-2 hover:bg-red-900">Yes</button>
            <button @click="toggleDeleteModal(false)" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-400">No</button>
        </div>
    </div>
    </div>

     <!-- Show modal -->
  <div v-if="showCreditors" id="show-modal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 flex items-center justify-center w-full h-full bg-black bg-opacity-50">
    <div class="relative p-4">
      <!-- Show Modal content -->
      <div class="border-b border-gray-200 dark:border-gray-700 bg-gray-900 p-5 rounded-lg shadow-lg w-max">
        <!-- Show Modal header -->
        <div class="flex items-center justify-between p-2 rounded-t dark:border-gray-600">
          <h2 class="text-lg font-semibold text-gray-300">Creditor Details</h2>
          <button @click="showtoggleModal(null)" type="button" class="text-gray-400 hover:text-red-600 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-toggle="show-modal">
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
            </svg>
            <span class="sr-only">Close modal</span>
          </button>
        </div>
        <!-- Show Modal body -->
        <div>
          <table class="w-full rounded-lg overflow-hidden">
            <tr class="bg-gray-300">
              <th class="px-4 py-2 border-r-2 border-gray-900">Last Name</th>
              <td class="px-4 py-2 border-gray-300">{{ showCreditors.last_name }}</td>
            </tr>
            <tr class="bg-gray-700 text-gray-300">
              <th class="px-4 py-2 border-r-2 border-gray-900">First Name</th>
              <td class="px-4 py-2 border-gray-300">{{ showCreditors.first_name }}</td>
            </tr>
            <tr class="bg-gray-300">
              <th class="px-4 py-2 border-r-2 border-gray-900">Gender</th>
              <td class="px-4 py-2 border-gray-300">{{ showCreditors.gender }}</td>
            </tr>
            <tr class="bg-gray-700 text-gray-300">
              <th class="px-4 py-2 border-r-2 border-gray-900">Address</th>
              <td class="px-4 py-2 border-gray-300">{{ showCreditors.address }}</td>
            </tr>
            <tr class="bg-gray-300">
              <th class="px-4 py-2 border-r-2 border-gray-900">Phone</th>
              <td class="px-4 py-2 border-gray-300">{{ showCreditors.phone }}</td>
            </tr>
            <tr class="bg-gray-700 text-gray-300">
              <th class="px-4 py-2 border-r-2 border-gray-900">Birth Date</th>
              <td class="px-4 py-2 border-gray-300">{{ showCreditors.birth_date }}</td>
            </tr>
            <tr class="bg-gray-300">
              <th class="px-4 py-2 border-r-2 border-gray-900">Credit Limit</th>
              <td class="px-4 py-2 border-gray-300">{{ showCreditors.credit_limit }}</td>
            </tr>
          </table>
        </div>
      </div>
    </div>
  </div>

  <!-- Edit modal -->
  <div v-if="editCreditors" id="crud-modal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 flex items-center justify-center w-full h-full bg-black bg-opacity-50">
    <div class="relative p-4 w-full max-w-md max-h-full">
      <!-- Edit Modal content -->
      <div class="border-b border-gray-200 dark:border-gray-700 bg-gray-900 p-5 rounded-lg shadow-lg">
        <!-- Edit Modal header -->
        <div class="flex items-center justify-between p-2 border-b rounded-t dark:border-gray-600">
          <h2 class="text-lg font-semibold text-white">Edit Creditor</h2>
          <button @click="toggleEditModal(null)" type="button" class="text-gray-400 hover:text-red-600 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-toggle="crud-modal">
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
            </svg>
            <span class="sr-only">Close modal</span>
          </button>
        </div>
        <!-- Edit Modal body -->
        <div>
          <form @submit.prevent="submit">
            <div>
            <label for="last_name" class="block text-font-medium text-white">Last Name</label>
                <div class="relative mb-2">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-black">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                        </svg>
                    </div>
                <input type="text" name="last_name" id="last_name" v-model="form.last_name" class="text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>
            </div>
            <div>
            <label for="first_name" class="block text-font-medium text-white">First Name</label>
                <div class="relative mb-2">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-black">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                        </svg>
                    </div>
                <input type="text" name="first_name" id="first_name" v-model="form.first_name" class="text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>
            </div>
            <div>
            <label for="gender" class="block text-font-medium text-white">Gender</label>
                <div class="relative mb-2">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-black">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                        </svg>
                    </div>
                    <select id="gender" class="text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:focus:ring-blue-500 dark:focus:border-blue-500" v-model="form.gender">
                      <option value="Male">Male</option>
                      <option value="Female">Female</option>
                    </select>
                </div>
            </div>
            <div>
            <label for="address" class="block text-font-medium text-white">Address</label>
                <div class="relative mb-2">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-black">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12.75 3.03v.568c0 .334.148.65.405.864l1.068.89c.442.369.535 1.01.216 1.49l-.51.766a2.25 2.25 0 0 1-1.161.886l-.143.048a1.107 1.107 0 0 0-.57 1.664c.369.555.169 1.307-.427 1.605L9 13.125l.423 1.059a.956.956 0 0 1-1.652.928l-.679-.906a1.125 1.125 0 0 0-1.906.172L4.5 15.75l-.612.153M12.75 3.031a9 9 0 0 0-8.862 12.872M12.75 3.031a9 9 0 0 1 6.69 14.036m0 0-.177-.529A2.25 2.25 0 0 0 17.128 15H16.5l-.324-.324a1.453 1.453 0 0 0-2.328.377l-.036.073a1.586 1.586 0 0 1-.982.816l-.99.282c-.55.157-.894.702-.8 1.267l.073.438c.08.474.49.821.97.821.846 0 1.598.542 1.865 1.345l.215.643m5.276-3.67a9.012 9.012 0 0 1-5.276 3.67m0 0a9 9 0 0 1-10.275-4.835M15.75 9c0 .896-.393 1.7-1.016 2.25" />
                        </svg>
                    </div>
                <input type="text" name="address" id="address" v-model="form.address" class="text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>
            </div>
            <div>
            <label for="phone" class="block text-font-medium text-white">Phone</label>
                <div class="relative mb-2">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-black">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />
                        </svg>
                    </div>
                <input type="text" name="phone" id="phone" v-model="form.phone" class="text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>
            </div>
            <div>
            <label for="birth_date" class="block text-font-medium text-white">Birth Date</label>
                <div class="relative mb-2">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-black">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8.25v-1.5m0 1.5c-1.355 0-2.697.056-4.024.166C6.845 8.51 6 9.473 6 10.608v2.513m6-4.871c1.355 0 2.697.056 4.024.166C17.155 8.51 18 9.473 18 10.608v2.513M15 8.25v-1.5m-6 1.5v-1.5m12 9.75-1.5.75a3.354 3.354 0 0 1-3 0 3.354 3.354 0 0 0-3 0 3.354 3.354 0 0 1-3 0 3.354 3.354 0 0 0-3 0 3.354 3.354 0 0 1-3 0L3 16.5m15-3.379a48.474 48.474 0 0 0-6-.371c-2.032 0-4.034.126-6 .371m12 0c.39.049.777.102 1.163.16 1.07.16 1.837 1.094 1.837 2.175v5.169c0 .621-.504 1.125-1.125 1.125H4.125A1.125 1.125 0 0 1 3 20.625v-5.17c0-1.08.768-2.014 1.837-2.174A47.78 47.78 0 0 1 6 13.12M12.265 3.11a.375.375 0 1 1-.53 0L12 2.845l.265.265Zm-3 0a.375.375 0 1 1-.53 0L9 2.845l.265.265Zm6 0a.375.375 0 1 1-.53 0L15 2.845l.265.265Z" />
                        </svg>
                    </div>
                <input type="date" name="birth_date" id="birth_date" v-model="form.birth_date" class="text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>
            </div>
            <div>
            <label for="credit_limit" class="block text-font-medium text-white">Credit Limit</label>
                <div class="relative mb-2">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-black">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Z" />
                        </svg>
                    </div>
                <input type="number" name="credit_limit" id="credit_limit" v-model="form.credit_limit" class="text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>
            </div>
          <button type="submit" class="text-xl hover:text-green-600 text-white">Save</button>
        </form>
        </div>
      </div>
    </div>
  </div>

    <!-- Create modal -->
    <div v-if="showCreateModal" id="crud-modal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 flex items-center justify-center w-full h-full bg-black bg-opacity-50">
    <div class="relative p-4">
      <!-- Create Modal content -->
      <div class="border-b border-gray-200 dark:border-gray-700 bg-gray-900 rounded-lg shadow-lg w-max">
        <!-- Create Modal header -->
        <div class="flex items-center justify-between p-2 border-b rounded-t dark:border-gray-600">
          <h2 class="text-white p-5   text-lg font-semibold">Create Creditor</h2>
          <button @click="toggleCreateModal(null)" type="button" class="text-gray-400 hover:text-red-600 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-toggle="crud-modal">
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
            </svg>
            <span class="sr-only">Close modal</span>
          </button>
        </div>
        <!-- Create Modal body -->
        <div>
          <form class="grid grid-cols-2 gap-2 w-5/6 mx-auto my-auto py-10" @submit.prevent="create">
            <div>
            <label for="last_name" class="block mb-2 text-font-medium text-gray-900 dark:text-white">Last Name</label>
                <div class="relative mb-6">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-black">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                        </svg>
                    </div>
                <input type="text" name="last_name" id="last_name" v-model="form.last_name" class="rounded-lg text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>
            </div>
            <div>
            <label for="first_name" class="block mb-2 text-font-medium text-gray-900 dark:text-white">First Name</label>
                <div class="relative mb-6">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-black">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                        </svg>
                    </div>
                <input type="text" name="first_name" id="first_name" v-model="form.first_name" class="text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>
            </div>
            <div>
            <label for="gender" class="block mb-2 text-font-medium text-gray-900 dark:text-white">Gender</label>
                <div class="relative mb-6">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-black">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                        </svg>
                    </div>
                    <select id="gender" class="text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:focus:ring-blue-500 dark:focus:border-blue-500" v-model="form.gender">
                      <option value="Male">Male</option>
                      <option value="Female">Female</option>
                    </select>
                </div>
            </div>
            <div>
            <label for="address" class="block mb-2 text-font-medium text-gray-900 dark:text-white">Address</label>
                <div class="relative mb-6">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-black">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12.75 3.03v.568c0 .334.148.65.405.864l1.068.89c.442.369.535 1.01.216 1.49l-.51.766a2.25 2.25 0 0 1-1.161.886l-.143.048a1.107 1.107 0 0 0-.57 1.664c.369.555.169 1.307-.427 1.605L9 13.125l.423 1.059a.956.956 0 0 1-1.652.928l-.679-.906a1.125 1.125 0 0 0-1.906.172L4.5 15.75l-.612.153M12.75 3.031a9 9 0 0 0-8.862 12.872M12.75 3.031a9 9 0 0 1 6.69 14.036m0 0-.177-.529A2.25 2.25 0 0 0 17.128 15H16.5l-.324-.324a1.453 1.453 0 0 0-2.328.377l-.036.073a1.586 1.586 0 0 1-.982.816l-.99.282c-.55.157-.894.702-.8 1.267l.073.438c.08.474.49.821.97.821.846 0 1.598.542 1.865 1.345l.215.643m5.276-3.67a9.012 9.012 0 0 1-5.276 3.67m0 0a9 9 0 0 1-10.275-4.835M15.75 9c0 .896-.393 1.7-1.016 2.25" />
                        </svg>
                    </div>
                <input type="text" name="address" id="address" v-model="form.address" class="text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>
            </div>
            <div>
            <label for="phone" class="block mb-2 text-font-medium text-gray-900 dark:text-white">Phone</label>
                <div class="relative mb-6">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-black">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />
                        </svg>
                    </div>
                <input type="text" name="phone" id="phone" v-model="form.phone" class="text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>
            </div>
            <div>
            <label for="birth_date" class="block mb-2 text-font-medium text-gray-900 dark:text-white">Birth Date</label>
                <div class="relative mb-6">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-black">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8.25v-1.5m0 1.5c-1.355 0-2.697.056-4.024.166C6.845 8.51 6 9.473 6 10.608v2.513m6-4.871c1.355 0 2.697.056 4.024.166C17.155 8.51 18 9.473 18 10.608v2.513M15 8.25v-1.5m-6 1.5v-1.5m12 9.75-1.5.75a3.354 3.354 0 0 1-3 0 3.354 3.354 0 0 0-3 0 3.354 3.354 0 0 1-3 0 3.354 3.354 0 0 0-3 0 3.354 3.354 0 0 1-3 0L3 16.5m15-3.379a48.474 48.474 0 0 0-6-.371c-2.032 0-4.034.126-6 .371m12 0c.39.049.777.102 1.163.16 1.07.16 1.837 1.094 1.837 2.175v5.169c0 .621-.504 1.125-1.125 1.125H4.125A1.125 1.125 0 0 1 3 20.625v-5.17c0-1.08.768-2.014 1.837-2.174A47.78 47.78 0 0 1 6 13.12M12.265 3.11a.375.375 0 1 1-.53 0L12 2.845l.265.265Zm-3 0a.375.375 0 1 1-.53 0L9 2.845l.265.265Zm6 0a.375.375 0 1 1-.53 0L15 2.845l.265.265Z" />
                        </svg>
                    </div>
                <input type="date" name="birth_date" id="birth_date" v-model="form.birth_date" class="text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>
            </div>
            <div>
            <label for="credit_limit" class="block mb-2 text-font-medium text-gray-900 dark:text-white">Credit Limit</label>
                <div class="relative mb-6">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-black">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Z" />
                        </svg>
                    </div>
                <input type="number" name="credit_limit" id="credit_limit" v-model="form.credit_limit" class="text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>
            </div>
            <button type="submit" class="col-span-2 w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Create</button>
        </form>
        </div>
      </div>
    </div>
  </div>
</template>

