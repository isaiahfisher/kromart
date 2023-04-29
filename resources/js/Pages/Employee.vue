<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm } from '@inertiajs/vue3';
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps(['store', 'employees']);

const passwordInput = ref(null);
const currentPasswordInput = ref(null);

const form = useForm({
    name:'',
    salaryMin:'',
    salaryMax:'',
    ssn: '',
    title:'',
    store: props.store
});

const submit = () => {
    //make new route in web.php
    form.post(route('employee.index'), {
        preserveScroll: true,
        onError: () => {
        },
    });
};


</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Choose Employee</h2>
        </template>

        <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg p-4">
                <h2 class="text-gray-900 dark:text-gray-100 font-bold text-2xl ">FILTER</h2>

                <!-- <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-sm">
                    <div class="p-6 text-gray-900 dark:text-gray-100">You're logged in!</div>
                </div> -->

            <form @submit.prevent="submit" class="mt-6 space-y-3">
                    <input type="hidden" id="store" name="store" v-model="store">
                    <div class="flex items-center space-x-3">
                    <InputLabel for="name" value="Employee Name" class="w-1/12"/>
                    <TextInput id="name" v-model="form.name" class="mt-1 block w-fit h-8 px-2 border-black border-2" />
                    </div>
                    <div class="flex items-center space-x-3">
                    <InputLabel for="salaryMin" value="Min. Salary" class="w-1/12"/>
                    <TextInput id="salaryMin" v-model="form.salaryMin" class="mt-1 block w-fit h-8 px-2 border-black border-2" />
                    </div>
                    <div class="flex items-center space-x-3">
                    <InputLabel for="salaryMax" value="Max. Salary" class="w-1/12"/>
                    <TextInput id="salaryMax" v-model="form.salaryMax" class="mt-1 block w-fit h-8 px-2 border-black border-2" />
                    </div>
                    <div class="flex items-center space-x-3">
                    <InputLabel for="ssn" value="SSN" class="w-1/12"/>
                    <TextInput id="ssn" v-model="form.ssn" class="mt-1 block w-fit h-8 px-2 border-black border-2" />
                    </div>
                    <div class="flex items-center space-x-3">
                    <InputLabel for="position" value="Position" class="w-1/12" />
                    <TextInput id="position" v-model="form.title" class="mt-1 block w-fit h-8 px-2 border-black border-2" />
                    </div>
                    <div>
                    <PrimaryButton class="my-3" :disabled="form.processing">Search</PrimaryButton>
                    </div>
            </form>
            </div>
             <!-- if search return queries, it will fit into this table -->
            <table class="table-auto border-separate border-spacing-y-3 border-spacing-x-3 rounded bg-white">
                <thead class="space-x-5 border-spacing-x-4">
                <tr>
                    <th>Employee</th>
                    <th>Salary</th>
                    <th>Position</th>
                    <th>Last 4 digits of SSN</th>
                    <th>Position</th>
                    <!-- <th>Choose</th> -->
                </tr>
                </thead>
                <tbody v-if="props.employees.length"  class="space-y-5 border-spacing-3">
                    <tr v-for="employee in props.employees" :key="employee.ssn">
                        <td>{{employee.firstname}}</td>
                        <td>{{employee.salary}}</td>
                        <td>{{employee.ssn}}</td>
                        <td>{{employee.title}}</td>
                        <td><button>Select</button></td>
                    </tr>
                </tbody>
                <tbody v-else>
                    <tr>
                        <td colspan="4" class="text-left lead text-muted fst-italic">
                                    No store is found/ selected.
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>


    </AuthenticatedLayout>
</template>
