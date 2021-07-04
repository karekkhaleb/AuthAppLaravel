<template>
    <div class="border-b flex justify-between items-center">
        <div class="flex items-center">
            <div class="avatar bg-white ">
                <img class="" :src="developer.avatar">
            </div>
            <div>
                <h1 class="text-2xl">{{ developer.firstname }} {{ developer.lastname }}</h1>
                <h2>{{ developer.email }} - {{ developer.phone }}</h2>
                <p>{{ developer.address }}</p>
            </div>
        </div>
        <div class="actions mr-3 pr-4">
            <i class="cursor-pointer text-red-500 fa fa-solid fa-trash mr-3" @click="$emit('deleteSingle', developer.id)"></i>
            <input type="checkbox" @change="change" :checked="checkValue">
        </div>
    </div>
</template>
<script>
export default {
    props: ['developer', 'checkValue'],
    methods: {
        change() {
            this.$emit('checked', this.developer.id)
        }
    },
}
</script>
<style scoped>
.avatar {
    height: 6rem;
    width: 6rem;
    margin: 1.5rem;
    border-radius: 50%;
    overflow: hidden;
}
</style>
