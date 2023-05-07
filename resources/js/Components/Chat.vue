<script setup>
    import { useForm } from "@inertiajs/vue3";

    const props = defineProps(['messages', 'idUser', 'idTicket']);

    const form = useForm({
        ticket: props.idTicket,
        message: '',
    });

    function addMessage() {
        form.post(route('ticket.addMessage'), {
            preserveScroll: true,
            onSuccess() {
                form.reset('message');
            }
        });
    }
</script>

<template>
    <div class="max-w-full min-h-[32rem] border border-red-400 rounded-md p-2 flex flex-col justify-between">
        <div class="overflow-auto scrollbar scrollbar-thin scrollbar-thumb-rounded-lg scrollbar-track-rounded-lg scrollbar-thumb-red-400 scrollbar-track-red-600/20 scroll-smooth max-h-96">
            <div v-if="!messages" class="flex justify-center mt-6">Комментарии отсутвуют</div>
            <ul class="p-4 flex flex-col gap-4">
                <li
                    :class="{ 'ml-auto': message.created_by == idUser }"
                    v-for="message in messages" :key="message.id"
                    class="flex items-center gap-2 max-w-md w-full">
                    <img
                        v-if="message.created_by != idUser"
                        src="/assets/images/profile.png"
                        class="w-10 h-10" alt=""
                    >
                    <div class="flex flex-col w-full gap-2">
                        <div
                            v-if="message.created_by != idUser"
                            class="capitalize"
                        >{{ message.user.name }}</div>
                        <p :class="[message.created_by != idUser ? 'bg-orange-400/60' : 'bg-red-400/60']"
                           class=" p-2 rounded text-white text-sm"
                        >{{ message.message }}</p>
                    </div>
                </li>
            </ul>
        </div>
        <div class="flex flex-col items-center">
            <div class="w-2/3">
                <div v-if="form.errors.message" class="text-red-600 text-sm">{{ form.errors.message }}</div>
                <div class="p-2 bg-gradient-to-r flex gap-4 items-center from-orange-400/60 to-red-400/60 rounded max-h-[10rem]">
                    <div class="w-full flex flex-col justify-center">
                        <textarea rows="1" v-model="form.message" class="border-none max-h-[9rem] min-h-[2.9rem] text-sm rounded w-full p-3" placeholder="Введите сообщение..."></textarea>
                    </div>
                    <button @click="addMessage" type="submit" class="flex justify-center hover:bg-red-600 p-2 items-center rounded-full cursor-pointer">
                        <svg width="30px" height="30px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M20 12L4 4L6 12M20 12L4 20L6 12M20 12H6" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>
