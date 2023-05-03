<script setup>
    const props = defineProps(['messages'])
</script>

<template>
    <div class="max-w-full min-h-[32rem] border border-red-400 rounded-md p-4 flex flex-col justify-between">
        <div class="">
            <ul>
                <li>
                    test
                </li>
            </ul>
            Комментарии отсутвуют
        </div>
        <div class="flex justify-center items-center">
            <div class="w-2/3 p-2 bg-gradient-to-r flex gap-4 align-middle from-orange-400 to-red-400 rounded max-h-[16rem]">
                <textarea rows="1" class="border-none max-h-[14rem] text-sm rounded w-full p-3" placeholder="Введите сообщение..."></textarea>
                <button type="submit" class="flex justify-center hover:bg-red-600 p-2 items-center rounded-full cursor-pointer">
                    <svg width="30px" height="30px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M20 12L4 4L6 12M20 12L4 20L6 12M20 12H6" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</template>
