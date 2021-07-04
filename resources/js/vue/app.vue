<template>
    <div class="main ">
        <div class="flex justify-end bg-white btn-container">
            <ButtonComp
                value="Delete Selected"
                classes="bg-red-600 hover:bg-red-700 active:bg-gray-900 text-white mr-3"
                v-on:clicked="deleteSelected"
            />
            <ButtonComp value="Add Developer" v-on:clicked="openForm"/>
        </div>
        <DevList :list="developers" @checked="checked" :checkedIds="checkedIds" @deleteSingle="deleteSingle"/>
        <AddDevForm
            v-if="isFormOpen"
            @close="closeForm"
            @submitForm="submitForm"
        />
    </div>
</template>

<script>
import ButtonComp from "./Button";
import DevList from "./DevList";
import AddDevForm from "./AddDevForm";

export default {
    data () {
        return {
            developers: [],
            checkedIds: [],
            isFormOpen: false,
        }
    },
    components: {
        AddDevForm,
        DevList,
        ButtonComp
    },
    methods: {
        async deleteSingle(id) {
            const response = await fetch(`/developers/${id}`, {
                method: 'delete',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
            });
            await response.json();
            await this.getDevs();
        },
        async deleteSelected() {
            if (this.checkedIds.length) {
                await axios.post('/developers/bulkdelete', {ids: this.checkedIds});
                await this.getDevs();
            }
        },
        closeForm() {
            this.isFormOpen = false;
        },
        openForm() {
            this.isFormOpen = true;
        },
        async submitForm(newDev){
            const formData = new FormData();
            formData.append('firstname', newDev.firstname);
            formData.append('lastname', newDev.lastname);
            formData.append('phone', newDev.phone);
            formData.append('address', newDev.address);
            formData.append('email', newDev.email);
            formData.append('avatar', newDev.avatar);
            const response = await fetch('/developers', {
                method: 'post',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: formData,
            });
            await response.json();
            await this.getDevs();
        },
        checked(id) {
            if (this.checkedIds.includes(id)){
                this.checkedIds = this.checkedIds.filter(i => i !== id)
            } else {
                this.checkedIds = [...this.checkedIds, id]
            }
            console.log(this.checkedIds);
        },
        async getDevs () {
            const response = await fetch('/developers');
            this.developers = await response.json();
        }
    },
    created() {
        this.getDevs();
    }

}
</script>

<style scoped>
.main{
    background: #ffffff;
    width: 60%;
    height: 80vh;
    margin: 0 auto;
    box-shadow: 0 0 2rem #333333;
}
.btn-container{
    padding: 2rem;
    height: 10vh;
    box-shadow: 0 0.5rem 1.5rem #4c4c4c;
}
.main {
    color: #4a5568;
}
</style>
