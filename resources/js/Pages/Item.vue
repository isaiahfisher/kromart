<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm } from '@inertiajs/vue3';
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';

const passwordInput = ref(null);
const currentPasswordInput = ref(null);

const form = useForm({
    name:'',
    category:'',
    manu: '',
    minPrice:'',
    maxPrice:'',
    promotion:''
});

const chooseItem = () => {
    //make new route in web.php
    form.put(route(''), {
        preserveScroll: true,
        onSuccess: () => form.reset(),
        onError: () => {
        },
    });
};
</script>
<script>
export default {
    data(){
        return {
            item:{
                name:'',
                category:'',
                manu: '',
                price:'',
                promotion:''
            },
            items:[],
        }
    }
}
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
                    <InputLabel for="cat" value="Category" class="w-1/12"/>
                    <TextInput id="cat" v-model="form.category" class="mt-1 block w-fit h-8 px-2 border-black border-2" />
                    </div>
                    <div class="flex items-center space-x-3">
                    <InputLabel for="manu" value="Manufacturer" class="w-1/12"/>
                    <TextInput id="manu" v-model="form.manu" class="mt-1 block w-fit h-8 px-2 border-black border-2" />
                    </div>
                    <div class="flex items-center space-x-3">
                    <InputLabel for="minPrice" value="Price" class="w-1/12" />
                    <TextInput id="minPrice" v-model="form.minPrice" class="mt-1 block w-fit h-8 px-2 border-black border-2" />
                    </div>
                    <div class="flex items-center space-x-3">
                    <InputLabel for="maxPrice" value="Price" class="w-1/12" />
                    <TextInput id="maxPrice" v-model="form.maxPrice" class="mt-1 block w-fit h-8 px-2 border-black border-2" />
                    </div>
                    <div class="flex items-center space-x-3">
                    <InputLabel for="promo" value="Promotion" class="w-1/12" />
                    <TextInput id="promo" v-model="form.promotion" class="mt-1 block w-fit h-8 px-2 border-black border-2" />
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
                    <th>Category</th>
                    <th>Manufacturer</th>
                    <th>Price</th>
                    <th>Promotion</th>
                    <!-- <th>Choose</th> -->
                </tr>
                </thead>
                <tbody v-if="items.length"  class="space-y-5 border-spacing-3">
                    <tr v-for="item in items" :key="item.name">
                        <td>{{item.name}}</td>
                        <td>{{item.category}}</td>
                        <td>{{item.manu}}</td>
                        <td>{{item.price}}</td>
                        <td>{{item.promotion}}</td>
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
