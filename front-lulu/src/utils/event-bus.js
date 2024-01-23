// eventBus.js
import { ref } from 'vue'

const eventBus = ref({})

export function emit (event, ...args) {
    if (eventBus.value[event]) {
        eventBus.value[event].forEach(callback => callback(...args))
    }
}

export function on (event, callback) {
    if (!eventBus.value[event]) {
        eventBus.value[event] = []
    }
    eventBus.value[event].push(callback)
}

export function off (event, callback) {
    if (eventBus.value[event]) {
        const index = eventBus.value[event].indexOf(callback)
        if (index !== -1) {
            eventBus.value[event].splice(index, 1)
        }
    }
}
