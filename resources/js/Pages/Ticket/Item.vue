<script setup>
    import {Head, Link} from '@inertiajs/vue3';
    import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
    import Chat from "@/Components/Chat.vue";
    const props = defineProps(['ticket', 'messages', 'idUser']);
</script>

<template>
    <Head v-if="ticket" :title="`Заявка №${ticket.id}`"/>
    <Head v-else title="Заяка не найдена"/>

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Заявка {{ ticket ? `№${ticket.id}` : 'не найдена' }}</h2>
            </div>
        </template>

        <div class="py-5">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="flex flex-col items-center gap-3 mb-8">
                    <div class="w-full flex flex-col gap-1">
                        <div class="p-1 px-4 bg-red-400/70 text-white text-sm rounded-md max-w-fit">Название</div>
                        <div class="bg-white shadow p-3">{{ ticket.name }}</div>
                    </div>
                    <div class="w-full flex flex-col gap-1">
                        <div class="p-1 px-4 bg-red-400/70 text-white text-sm rounded-md max-w-fit">Описание</div>
                        <div class="bg-white shadow p-3">{{ ticket.description }}</div>
                    </div>
                </div>
                <Chat :messages="messages" :id-user="idUser" :id-ticket="ticket.id"/>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
