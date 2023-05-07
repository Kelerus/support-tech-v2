<script setup>
    import {Head, Link, useForm} from '@inertiajs/vue3';
    import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
    import Chat from "@/Components/Chat.vue";
    const props = defineProps({
        ticket: {
            type: Object,
            required: false,
        },
        messages: {
            required: true,
        },
        idUser: {
            required: true,
        },
        statuses: {
            required: true,
        },
        roles: {
            type: Array
        }
    });

    const updateForm = useForm({
        ticket: props.ticket ? props.ticket.id : null,
        status: '',
    });

    function updateStatus(status) {
        updateForm.status = status;
        updateForm.post(route('ticket.updateStatus'), {
            preserveScroll: true,
            onSuccess() {
                updateForm.reset('status');
            }
        });
    }

</script>

<template>
    <Head v-if="ticket" :title="`Заявка №${ticket.id}`"/>
    <Head v-else title="Заяка не найдена"/>

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Заявка {{ ticket ? `№${ticket.id}` : 'не найдена' }}</h2>
                <div v-if="ticket" class="flex gap-4">
                    <button
                        v-if="ticket.created_by == idUser && ticket.status === statuses.process"
                        @click="updateStatus('cancel')"
                        :disabled="updateForm.processing"
                        class="bg-gray-800 px-4 py-2 rounded text-white"
                    >Отменить заявку</button>
                    <button
                        v-if="ticket.status === statuses.process && roles.length"
                        @click="updateStatus('success')"
                        :disabled="updateForm.processing"
                        class="bg-gray-800 px-4 py-2 rounded text-white"
                    >Завершить заявку</button>
                </div>
            </div>
        </template>

        <div class="py-5">
            <div v-if="ticket" class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="flex flex-col items-center gap-3 mb-8">
                    <div class="w-full flex flex-col gap-1">
                        <div class="p-1 px-4 bg-red-400/70 text-white text-sm rounded-md max-w-fit">Название</div>
                        <div class="bg-white shadow p-3 rounded">{{ ticket.name }}</div>
                    </div>
                    <div class="w-full flex flex-col gap-1">
                        <div class="p-1 px-4 bg-red-400/70 text-white text-sm rounded-md max-w-fit">Описание</div>
                        <div class="bg-white shadow p-3 rounded">{{ ticket.description }}</div>
                    </div>
                    <div class="w-full flex flex-col gap-1">
                        <div class="p-1 px-4 bg-red-400/70 text-white text-sm rounded-md max-w-fit">Статус</div>
                        <div class="bg-white shadow p-3 rounded">{{ ticket.status }}</div>
                    </div>
                </div>
                <Chat :messages="messages" :id-user="idUser" :id-ticket="ticket.id"/>
            </div>
            <div v-else class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="flex flex-col items-center gap-3 mb-8">
                    <div class="w-full flex flex-col gap-1">
                        <div class="bg-white shadow p-3 text-red-500 font-bold rounded">Заявка не найдена или доступ запрещен</div>
                    </div>
                </div>

            </div>
        </div>
    </AuthenticatedLayout>
</template>
