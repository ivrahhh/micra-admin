import { usePage } from "@inertiajs/vue3";
import { defineStore } from "pinia";

export const useToastStore = defineStore('toast', {
    state: () => {
        return {
            active: false,
        }
    },

    getters: {
        getAllNotifications: () => usePage().props.notifications,
        getSuccessNotification: () => usePage().props.notifications.success
    },

    actions: {
        checkSuccessNotification(notification) {
            this.getSuccessNotifications.forEach((value, index) => {
                if(value === notification) return true
            }) 
        },

        closeToast() {
            this.active = false
        },

        openToast() {
            this.active = true
        }
    }
})