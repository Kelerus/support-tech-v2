<script setup>
import {Head, Link} from '@inertiajs/vue3';

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
});
</script>

<template>
    <Head title="Добро пожаловать" />

    <div
        class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white"
    >
        <div v-if="canLogin" class="sm:fixed sm:top-0 sm:right-0 p-6 text-right">
            <Link
                v-if="$page.props.auth.user"
                :href="route('dashboard')"
                class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                >Панель управления</Link
            >

            <template v-else>
                <Link
                    :href="route('login')"
                    class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                    >Авторизация</Link
                >

                <Link
                    v-if="canRegister"
                    :href="route('register')"
                    class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                    >Регистрация</Link
                >
            </template>
        </div>

        <div class="max-w-7xl mx-auto p-6 lg:p-8">
            <div class="flex justify-center ">
                <img class="w-20 h-20" src="assets/images/logo.svg">
            </div>

            <div class="mt-16">
                <h1 class="font-semibold text-gray-600 dark:text-gray-400 text-4xl text-center leading-normal">Добро пожаловать в проект многоуровневая поддержка пользователей</h1>

                <h2 class="mt-10 text-center font-semibold text-gray-600 dark:text-gray-400 text-2xl leading-normal"></h2>
                <div class="mt-5">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
                        <div class="scale-100 p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500">
                            <div>
                                <h2 class="mt-6 text-xl font-semibold text-gray-900 dark:text-white">Удобный интерфейс</h2>
                                <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
                                    Благодаря Tailwindcss можно быстро и просто настраивать дизайн, а также повышать производительность разработки благодаря готовым CSS-классам.
                                </p>
                            </div>
                        </div>
                        <div class="scale-100 p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500">
                            <div>
                                <h2 class="mt-6 text-xl font-semibold text-gray-900 dark:text-white">Разработка приложения</h2>
                                <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
                                    Удобная разработка на Laravel позволяет быстро создавать высококачественные веб-приложения, использовать популярные библиотеки и пакеты, упростить процесс развертывания и масштабирования приложений, а также повысить безопасность благодаря встроенным функциям защиты от атак и аутентификации.
                                </p>
                            </div>
                        </div>
                        <div class="scale-100 p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500">
                            <div>
                                <h2 class="mt-6 text-xl font-semibold text-gray-900 dark:text-white">Масштабирование приложения</h2>
                                <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
                                    С помощью Laravel можно быстро создавать и масштабировать веб-приложения, а также поддерживать их с помощью обновлений и расширений.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div v-if="!$page.props.auth.user" class="flex justify-center align-items-center mt-16 px-6">
                <Link class="rounded border border-2 p-3 border-red-500 hover:border-red-300 text-center text-3xl font-semibold text-red-400 hover:text-red-600 transition duration-200 ease-in" :href="route('register')">Зарегистрироваться</Link>
            </div>
        </div>
    </div>
</template>

<style>

</style>
