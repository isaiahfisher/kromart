<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
<div class="min-h-fit min-w-fit flex items-center space-x-5 ml-5 mt-5 sm:justify-center mb-16 bg-white">
<h1 class="mb-4 text-3xl font-extrabold text-gray-900 dark:text-white md:text-5xl lg:text-6xl"><span class="text-transparent bg-clip-text bg-gradient-to-r to-amber-500 from-yellow-500">KROMART</span></h1>
<Link href="/"> <ApplicationLogo class="w-30 h-40 fill-current text-gry-500" /></Link>
</div>

<div class="min-h-min flex flex-col sm:justify-center items-center pt-6 sm:pt-0">

        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-2xl shadow-amber-500/40 overflow-hidden sm:rounded-lg border- border-amber-500">
            <slot/>
        </div>
</div>
</template>
