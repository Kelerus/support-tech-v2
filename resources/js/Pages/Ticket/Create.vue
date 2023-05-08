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
                <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">Создание заявки</h2>
            </div>
        </template>

        <div class="py-12">
            <div class="mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8">
                <form @submit.prevent="form.post(route('ticket.post.create'))" class="flex flex-col gap-4 p-4 bg-white shadow sm:p-8 dark:bg-gray-800 sm:rounded-lg">
                    <div>
                        <InputLabel for="name" value="Название" />

                        <TextInput
                            id="name"
                            type="text"
                            class="block w-full mt-1"
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
                            class="block w-full mt-1"
                            v-model="form.description"
                            required
                            placeholder="Введите описание"
                            autofocus
                            autocomplete="name"
                        />

                        <InputError class="mt-2" :message="form.errors.description" />
                    </div>
                    <div class="flex justify-center">
                        <button :disabled="form.processing" type="submit" class="w-full p-2 text-white bg-green-800 rounded">Создать</button>
                    </div>
                </form>
            </div>
        </div>
    </AuthenticatedLayout>

</template>
