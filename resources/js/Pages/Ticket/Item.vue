<script setup>
    import {Head, Link} from '@inertiajs/vue3';
    import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
    import Chat from "@/Components/Chat.vue";
    const props = defineProps(['ticket', 'messages']);
    console.log(props.ticket);
    console.log(props.messages);
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

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="flex flex-col items-center gap-3 mb-12">
                    <div class="bg-white shadow w-2/3 p-3">{{ ticket.name }}</div>
                    <div class="bg-white shadow w-2/3 p-3">{{ ticket.description }}</div>
                </div>
                <Chat :messages="messages"/>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
