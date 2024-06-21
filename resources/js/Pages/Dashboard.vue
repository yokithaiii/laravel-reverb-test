<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import axios from "axios";
import {onMounted} from "vue";

const flyEmoji = (emoji, button) => {
    const rect = button.getBoundingClientRect();
    const flyEmoji = document.createElement('div');
    flyEmoji.innerText = emoji;
    flyEmoji.style.position = 'fixed';
    flyEmoji.style.left = `${rect.left + rect.width / 2}px`;
    flyEmoji.style.top = `${rect.top + rect.height / 2}px`;
    flyEmoji.style.transition = 'all 1s ease-out';
    flyEmoji.style.fontSize = '3rem';
    flyEmoji.style.pointerEvents = 'none';

    document.body.appendChild(flyEmoji);

    setTimeout(() => {
        flyEmoji.style.top = `${rect.top - rect.height}px`;
        flyEmoji.style.opacity = 0;
        flyEmoji.style.transform = 'translate(-50%, -50%) scale(2)';
    }, 10);

    setTimeout(() => {
        flyEmoji.remove();
    }, 1000);
}

const react = (buttonId, emoji) => {
    axios.post('/reaction', {
        buttonId: buttonId,
        emoji: emoji,
    })
}

onMounted(() => {
    window.Echo.channel('reaction')
        .listen('ReactedEvent', (e) => {
            flyEmoji(e.emoji, document.getElementById(e.buttonId));
        });
})
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="flex justify-center items-center">
                            <button
                                id="heart"
                                class="reaction-button"
                                @click="react('heart', '❤️')"
                            >
                                ❤️
                            </button>
                            <button
                                id="star"
                                class="reaction-button"
                                @click="react('star', '⭐')"
                            >
                                ⭐
                            </button>
                            <button
                                id="rocket"
                                class="reaction-button"
                                @click="react('rocket', '🚀')"
                            >
                                🚀
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
