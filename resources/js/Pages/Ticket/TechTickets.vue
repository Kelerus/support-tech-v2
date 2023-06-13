<script setup>
    import {Head, Link} from "@inertiajs/vue3";
    import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
    import TextInput from '@/Components/TextInput.vue';
    import {computed, ref} from "vue";

    const props = defineProps({
        tickets: {
            type: Array,
        },
        roles: {
            type: Array,
        }
    });

    const find = ref('');

    const filterTickets = computed(() => {
        return !find.value
            ? props.tickets
            : props.tickets.filter(ticket => {
                return ticket.name.toLowerCase().includes(find.value.toLowerCase());
            });
    });

</script>

<template>
    <Head title="Заявки пользователей" />

    <AuthenticatedLayout :roles="roles">
        <template #header>
            <div class="flex flex-col items-center justify-between w-full gap-5 md:flex-row">
                <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200 whitespace-nowrap">Заявки пользователей</h2>
                <div class="w-full md:w-auto">
                    <TextInput
                        id="name"
                        type="text"
                        class="block w-full mt-1"
                        v-model="find"
                        required
                        placeholder="Поиск по названию"
                        autofocus
                        autocomplete="name"
                    />
                </div>
                <div class="flex flex-col items-center w-full gap-2 md:w-auto md:flex-row">
                    <Link class="w-full p-2 text-center text-white transition duration-200 bg-green-700 rounded md:w-auto hover:bg-green-900" :href="route('ticket.create')">Создать заявку</Link>
                </div>
            </div>

        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="p-4 overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                    <h2 v-if="!roles.length && !filterTickets.length" class="text-xl text-center text-red-500">Доступ запрещен</h2>
                    <h2 v-if="!filterTickets.length && roles.length" class="text-xl text-center dark:text-white">Заявки отсутвуют</h2>
                    <ul v-if="filterTickets.length" class="flex flex-col gap-4">
                        <li v-for="ticket in filterTickets" :key="ticket.id" class="flex items-center justify-between gap-3 p-2 rounded-md bg-red-600/70 md:gap-0">
                            <div class="flex flex-col gap-0.5">
                                <h3 class="text-lg text-white">Название: {{ ticket.name }}</h3>
                                <h3 class="text-lg text-white">Статус: {{ ticket.status }}</h3>
                                <div class="max-w-3xl text-sm text-white truncate whitespace-pre-wrap">Описание: {{ ticket.description }}</div>
                            </div>
                            <div class="flex items-center gap-3">
                                <Link :href="route('ticket', ticket.id)" class="p-2 text-white transition duration-200 bg-orange-400 rounded hover:bg-orange-500">Просмотр</Link>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
