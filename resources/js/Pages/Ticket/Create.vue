<script setup>
    import {Head, Link, useForm} from '@inertiajs/vue3';
    import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
    import TextInput from '@/Components/TextInput.vue';
    import InputError from '@/Components/InputError.vue';
    import InputLabel from '@/Components/InputLabel.vue';

    const form = useForm({
        name: '',
        description: '',
    });

</script>

<template>
    <Head title="Создать заявку"/>

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Создание заявки</h2>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <form @submit.prevent="form.post(route('ticket.create'))" class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg flex flex-col gap-4">
                    <div>
                        <InputLabel for="name" value="Название" />

                        <TextInput
                            id="name"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.name"
                            required
                            placeholder="Введите название"
                            autofocus
                            autocomplete="name"
                        />

                        <InputError class="mt-2" :message="form.errors.name" />
                    </div>
                    <div>
                        <InputLabel for="name" value="Описание" />

                        <TextInput
                            id="name"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.description"
                            required
                            placeholder="Введите описание"
                            autofocus
                            autocomplete="name"
                        />

                        <InputError class="mt-2" :message="form.errors.description" />
                    </div>
                    <div class="flex justify-center">
                        <button :disabled="form.processing" type="submit" class="bg-green-800 text-white p-2 rounded w-full">Создать</button>
                    </div>
                </form>
            </div>
        </div>
    </AuthenticatedLayout>

</template>
