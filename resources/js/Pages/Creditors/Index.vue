<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import HeaderBar from '@/Components/HeaderBar.vue';
import { ref } from 'vue';

const props = defineProps({
    creditor: Array, Object
});

const showDeleteModal = ref(false);
const deleteCreditorId = ref(null);

const form = useForm({
    last_name: props.creditor.last_name,
    first_name: props.creditor.first_name,
    gender: props.creditor.gender,
    birth_date: props.creditor.birth_date,
    phone: props.creditor.phone,
    address: props.creditor.address,
    credit_limit: props.creditor.credit_limit,
})

const toggleDeleteModal = (show, creditorId = null) => {
    showDeleteModal.value = show;
    if (show) {
        deleteCreditorId.value = creditorId;
    } else {
        deleteCreditorId.value = null;
    }
};

const delCred = () => {
    const delForm = useForm({
        id: deleteCreditorId.value
    });
    delForm.submit('delete', `/creditors/${deleteCreditorId.value}`);
    toggleDeleteModal(false);
};

const isModalOpen = ref(false);

const Eform = ref({
  last_name: '',
  first_name: '',
  gender: 'Male',
  birth_date: '',
  phone: '',
  address: '',
  credit_limit: ''
});

const toggleModal = () => {
  isModalOpen.value = !isModalOpen.value;
};

const submitForm = () => {
  console.log('Form submitted:', Eform.value);
  // Here you can add your form submission logic
  // After submission, you might want to reset the form
  resetForm();
};

const resetForm = () => {
  Eform.value = {
    last_name: '',
    first_name: '',
    gender: 'Male',
    birth_date: '',
    phone: '',
    address: '',
    credit_limit: ''
  };
};

</script>



<template>
    <Head title="Creditors" />
    <HeaderBar/>
    <div class="overflow-hidden w-full p-5">
        <div class="flex justify-between p-5">
            <h2 class="text-4xl">List of Creditors</h2>
            <Link :href="'/creditors/create'" class="hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:hover:bg-green-500 dark:focus:ring-green-800" type="button">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z" />
                </svg>
            </Link>
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
                    <Link :href="'/creditors/' + c.id" class="inline-flex items-center justify-center py-2 text-sm font-medium hover:text-green-800">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        </svg>
                    </Link>
                    <button>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                        </svg>
                    </button>
                    <button @click="() => toggleDeleteModal(true, c.id)" class="py-2 hover:text-red-600 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                        </svg>
                    </button>
                    <button @click="toggleModal" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                        Toggle modal
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div v-if="showDeleteModal" id="delete-modal" class="fixed top-0 left-0 flex items-center justify-center w-full h-full bg-black bg-opacity-50">
    <div class="bg-white p-8 rounded-lg shadow-lg">
        <h2 class="text-lg font-semibold mb-4">Confirm Deletion</h2>
        <p class="mb-4">Are you sure you want to delete this creditor?</p>
        <div class="flex justify-end">
            <button @click="delCred" class="px-4 py-2 bg-red-600 text-white rounded-lg mr-2">Yes</button>
            <button @click="toggleDeleteModal(false)" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg">No</button>
        </div>
    </div>
    </div>


  <!-- Main modal -->
  <div id="crud-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
      <!-- Modal content -->
      <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
        <!-- Modal header -->
        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
          <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
            Create New Product
          </h3>
          <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="crud-modal">
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
            </svg>
            <span class="sr-only">Close modal</span>
          </button>
        </div>
        <!-- Modal body -->
        <form @submit.prevent="submitForm">
          <div class="mb-3">
            <label for="last_name">Last Name</label>
            <input type="text" id="last_name" class="w-full" v-model="form.last_name">
          </div>
          <div class="mb-3">
            <label for="first_name">First Name</label>
            <input type="text" id="first_name" class="w-full" v-model="form.first_name">
          </div>
          <div class="mb-3">
            <label for="gender">Gender</label>
            <select id="gender" class="w-full" v-model="form.gender">
              <option value="Male">Male</option>
              <option value="Female">Female</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="birth_date">Birth Date</label>
            <input type="date" id="birth_date" class="w-full" v-model="form.birth_date">
          </div>
          <div class="mb-3">
            <label for="phone">Phone Number</label>
            <input type="text" id="phone" class="w-full" v-model="form.phone">
          </div>
          <div class="mb-3">
            <label for="address">Address</label>
            <input type="text" id="address" class="w-full" v-model="form.address">
          </div>
          <div class="mb-3">
            <label for="credit_limit">Credit Limit</label>
            <input type="number" id="credit_limit" class="w-full" v-model="form.credit_limit">
          </div>
          <button type="submit" class="text-xl p-2.5 hover:text-green-600">Save</button>
        </form>
      </div>
    </div>
  </div>

</template>

