<template>
    <ul class="dev-container">
        <li :key="index" v-for="(developer, index) in list">
            <SingleDev
                :developer="developer"
                @checked="checked"
                :checkValue="checkedIds.includes(developer.id)"
                @deleteSingle="deleteSingle"
            />
        </li>
    </ul>
</template>
<script>
import SingleDev from './SingleDev';
export default {
    props: ['list', 'checkedIds'],
    components: {
        SingleDev,
    },
    methods: {
        checked(id) {
            this.$emit('checked', id);
        },
        deleteSingle(id) {
            this.$emit('deleteSingle', id);
        }
    }
}
</script>
<style scoped>
.dev-container{
    height: 70vh;
    overflow: auto;
}
</style>
