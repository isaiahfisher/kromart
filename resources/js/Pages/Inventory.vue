<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm } from '@inertiajs/vue3';
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps(['store', 'inventories']);

const form = useForm({
    name:'',
    productid:'',
    qtt: '',
    batch:'',
    exp:'',
    store: props.store
});

const chooseInventory = () => {
    //make new route in web.php
    form.put(route(''), {
        preserveScroll: true,
        onError: () => {
        },
    });
};

console.log(props.inventories);
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Choose Store</h2>
        </template>

        <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg p-4">
                <h2 class="text-gray-900 dark:text-gray-100 font-bold text-2xl ">FILTER</h2>

                <!-- <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-sm">
                    <div class="p-6 text-gray-900 dark:text-gray-100">You're logged in!</div>
                </div> -->

            <form @submit.prevent="submit" class="mt-6 space-y-3">
                    <div class="flex items-center space-x-3">
                    <InputLabel for="name" value="Item Name" class="w-1/12"/>
                    <TextInput id="name" v-model="form.name" class="mt-1 block w-fit h-8 px-2 border-black border-2" />
                    </div>
                    <div class="flex items-center space-x-3">
                    <InputLabel for="productid" value="City" class="w-1/12"/>
                    <TextInput id="productid" v-model="form.productid" class="mt-1 block w-fit h-8 px-2 border-black border-2" />
                    </div>
                    <div class="flex items-center space-x-3">
                    <InputLabel for="qtt" value="Quantity" class="w-1/12"/>
                    <TextInput id="qtt" v-model="form.qtt" class="mt-1 block w-fit h-8 px-2 border-black border-2" />
                    </div>
                    <div class="flex items-center space-x-3">
                    <InputLabel for="batch" value="Batch" class="w-1/12" />
                    <TextInput id="batch" v-model="form.batch" class="mt-1 block w-fit h-8 px-2 border-black border-2" />
                    </div>
                    <div class="flex items-center space-x-3">
                    <InputLabel for="exp" value="Exp. Date" class="w-1/12" />
                    <TextInput id="exp" v-model="form.exp" class="mt-1 block w-fit h-8 px-2 border-black border-2" />
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
                    <th>Item Name</th>
                    <th>ProductID</th>
                    <th>Quantity</th>
                    <th>Batch</th>
                    <th>Exp. Date</th>
                    <!-- <th>Choose</th> -->
                </tr>
                </thead>
                <tbody v-if="inventories.length"  class="space-y-5 border-spacing-3">
                    <template v-for="inventory in inventories" :key="inventory.id">
                        <tr v-for="item in inventory.items" :key="item.id">
                            <td>{{item.name}}</td>
                            <td>{{item.sku}}</td>
                            <td>{{item.pivot.quantity}}</td>
                            <td>{{item.pivot.batch}}</td>
                            <td>{{item.pivot.expiry_date}}</td>
                            <td><button>Select</button></td>
                        </tr>
                    </template>
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
