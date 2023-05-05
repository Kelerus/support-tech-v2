<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, Link, router} from '@inertiajs/vue3';
import TextInput from '@/Components/TextInput.vue';
import {computed, ref} from "vue";

const props = defineProps({
    tickets: {
        type: Array,
    },
});

const find = ref('');

const filterTickets = computed(() => {
    return !find.value
        ? props.tickets
        : props.tickets.filter(ticket => {
            return ticket.name.toLowerCase().includes(find.value);
        });
});

</script>

<template>
    <Head title="Главная" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Мои заявки</h2>
                <div class="">
                    <TextInput
                        id="name"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="find"
                        required
                        placeholder="Поиск по названию"
                        autofocus
                        autocomplete="name"
                    />
                </div>
                <div class="flex items-center gap-2">
                    <Link class="p-2 bg-green-700 text-white hover:bg-green-900 transition duration-200 rounded" :href="route('ticket.create')">Создать заявку</Link>
                </div>
            </div>

        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-4">
                    <h2 v-if="!filterTickets" class="text-xl text-center">Заявки отсутвуют</h2>
                    <ul class="flex flex-col gap-4">
                        <li v-for="ticket in filterTickets" :key="ticket.id" class="bg-red-600/70 rounded-md flex items-center justify-between p-2">
                            <div class="flex flex-col gap-0.5">
                                <h3 class="text-white text-lg">Название: {{ ticket.name }}</h3>
                                <div class="text-white text-sm max-w-3xl truncate">Описание: {{ ticket.description }}</div>
                            </div>
                            <div class="flex gap-3 items-center">
                                <Link :href="route('ticket', ticket.id)" class="p-2 bg-orange-400 text-white rounded hover:bg-orange-500 transition duration-200">Просмотр</Link>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
