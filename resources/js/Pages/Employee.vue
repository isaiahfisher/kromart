<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm } from '@inertiajs/vue3';
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';
import { router } from '@inertiajs/vue3';
import DangerButton from '@/Components/DangerButton.vue'
import Modal from '@/Components/Modal.vue';
import SecondaryButton from'@/Components/SecondaryButton.vue';

const props = defineProps(['store', 'employees']);
const confirmingEmployeeDeletion = ref(false);
const confirmingEmployeeUpdate= ref(false);
const firstnameInput = ref(null);
var EmpId ='';

//change employee name
const changeNameForm = useForm({
    firstname: '',
    lastname:'',
    salaray:'',
    termination:'',
    termReason:'',
    position:'',
});
// console.log(props.employees);

const changeFirstName = (id) => {
    console.log(id);
    changeNameForm.patch(route('employee.update',{employee:id}), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
        onError: () => firstnameInput.value.focus(),
        onFinish: () => changeNameForm.reset(),
    });
};

const confirmEmployeeUpdate= (id) =>{
    confirmingEmployeeUpdate.value = true;
    EmpId = id;
    console.log(EmpId);
    //what is nexttick and why
};

//table
const form = useForm({
    firstname:'',
    lastname:'',
    salaryMin:'',
    salaryMax:'',
    ssn: '',
    title:'',
    hire_date:'',
    termination_date:'',
    termination_reason:'',
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

const selectInventory = () => {
    router.post(route('inventory.index'), {store: props.store});
};

const confirmEmployeeDeletion = (id) =>{
    confirmingEmployeeDeletion.value = true;
    EmpId = id;
    //what is nexttick and why
};


const deleteEmployee = () => {
    fetch(`/api/employee/${EmpId}`, { method: 'DELETE' })
    .then(({response}) => {
        //closeModal();
        window.location.href ="dashboard"
        return;
        })
};


const closeModal = () => {
    confirmEmployeeDeletion.value=false;
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
                    <input type="hidden" id="store" name="store" v-model="form.store">
                    <div class="flex items-center space-x-3">
                    <InputLabel for="firstname" value="Employee First Name" class="w-1/12"/>
                    <TextInput id="firstname" v-model="form.firstname" class="mt-1 block w-fit h-8 px-2 border-black border-2" />
                    </div>
                    <div class="flex items-center space-x-3">
                    <InputLabel for="lastname" value="Employee Last Name" class="w-1/12"/>
                    <TextInput id="lastname" v-model="form.lastname" class="mt-1 block w-fit h-8 px-2 border-black border-2" />
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
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Salary</th>
                    <th>Position</th>
                    <th>SSN</th>
                    <th>Hire date</th>
                    <th>Termination date</th>
                    <th>Termination Reason</th>
                </tr>
                </thead>
                <tbody v-if="props.employees.length"  class="space-y-5 border-spacing-3">
                    <tr v-for="employee in props.employees" :key="employee.ssn">
                        <td>{{employee.firstname}}</td>
                        <td>{{employee.lastname}}</td>
                        <td>{{employee.salary}}</td>
                        <td>{{employee.title}}</td>
                        <td>{{employee.ssn}}</td>
                        <td>{{employee.hire_date}}</td>
                        <td>{{employee.termination_date}}</td>
                        <td>{{employee.termination_reason}}</td>
                        <td><PrimaryButton @click="confirmEmployeeUpdate(employee.id)">Update First Name</PrimaryButton></td>
                        <td><DangerButton @click="confirmEmployeeDeletion(employee.id)">Delete Employee</DangerButton></td>
                        <!-- <td><button @click="selectInventory()">Select</button></td> -->
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

     <Modal :show="confirmingEmployeeDeletion" @close="closeModal">
            <div class="p-6">
                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                    Are you sure you want to delete this employee?
                </h2>
                <div class="mt-6 space-x-5 flex justify-start">
                     <SecondaryButton @click="closeModal"> Cancel </SecondaryButton>
                <DangerButton
                        class="ml-3"
                        @click="deleteEmployee">
                        Delete Employee
                    </DangerButton>
                </div>
            </div>
        </Modal>


          <Modal :show="confirmingEmployeeUpdate" @close="closeModal">
            <div class="p-6">
                <form @submit.prevent="changeFirstName(EmpId)" class="mt-6 space-y-6">
                <div class="mt-6">

                     <div class="flex items-center space-x-7">
                    <InputLabel for="firstname" value="Employee First Name" class="w-2/12"/>
                    <TextInput id="firstname" v-model="changeNameForm.firstname" placeholder="Enter New First Name" class="mt-1 block w-fit h-8 px-2 border-black border-2" />
                    </div>

                    <div class="flex items-center space-x-7">
                    <InputLabel for="lastname" value="Employee Last Name" class="w-2/12"/>
                    <TextInput id="lastname" v-model="changeNameForm.lastname" placeholder="Enter New Last Name" class="mt-1 block w-fit h-8 px-2 border-black border-2" />
                    </div>
                    <div class="flex items-center space-x-7">
                    <InputLabel for="salary" value="Salary" class="w-2/12"/>
                    <TextInput id="salary" v-model="changeNameForm.salary" class="mt-1 block w-fit h-8 px-2 border-black border-2" />
                    </div>
                    <div class="flex items-center space-x-7">
                    <InputLabel for="position" value="Position" class="w-2/12"/>
                    <TextInput id="position" v-model="changeNameForm.position" class="mt-1 block w-fit h-8 px-2 border-black border-2" />
                    </div>
                    <div class="flex items-center space-x-7">
                    <InputLabel for="termination" value="Termination (y/n)" class="w-2/12"/>
                    <TextInput id="termination" v-model="changeNameForm.termination" class="mt-1 block w-fit h-8 px-2 border-black border-2" />
                    </div>
                    <div class="flex items-center space-x-7">
                    <InputLabel for="termReason" value="Termination Reason" class="w-2/12"/>
                    <TextInput id="termReason" v-model="changeNameForm.termReason" class="mt-1 block w-fit h-8 px-2 border-black border-2" />
                    </div>

                </div>
                <div class="mt-6 space-x-5 flex justify-start">
                     <SecondaryButton @click="closeModal"> Cancel </SecondaryButton>
                 <DangerButton
                        :disabled="changeNameForm.processing">
                        Update
                    </DangerButton>
                </div>
                </form>
            </div>
        </Modal>

    </AuthenticatedLayout>
</template>
