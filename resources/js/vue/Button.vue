<template>
    <button :class="`inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs uppercase tracking-widest focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition ${classes} `"
        @click="$emit('clicked')"
    >
<!--    <button class="">-->
        {{ value }}
    </button>
</template>

<script>
export default {
    props: {
        value: {
            type: String,
            default: 'no value set'
        },
        classes: {
            type: String,
            default: ''
        }
    },
}
</script>
