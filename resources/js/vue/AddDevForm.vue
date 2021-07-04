<template>
    <div class="form-container">
        <div>
            <h1 class="text-center text-2xl mb-6 pb-4">Add New Developer</h1>
            <form action="" v-on:submit="submitForm">
                <div>
                    <label>First name</label>
                    <input type="text" placeholder="Enter first name" :value="firstname">
                </div>
                <div>
                    <label>Last name</label>
                    <input type="text" placeholder="Enter last name" :value="lastname">
                </div>
                <div>
                    <label>Email</label>
                    <input type="email" placeholder="Enter email" :value="email">
                </div>
                <div>
                    <label>Phone number</label>
                    <input type="number" placeholder="Enter phone number" :value="phone">
                </div>
                <div>
                    <label>Address</label>
                    <input type="text" placeholder="Enter Address" :value="address">
                </div>
                <div>
                    <label>Avatar</label>
                    <input type="file" @change="setAvatar" accept="image/png, image/jpeg">>
                </div>
                <div class="mt-10 flex justify-center">
                    <div class="border-b">
                        <p  v-on:click="onClose"
                            class="cursor-pointer pr-4 pl-3">Close</p>
                    </div>
                    <div class="border-b">
                        <Button value="submit"/>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import Button from "./Button";
export default {
    components: {Button},
    methods: {
        setAvatar(e) {
            const file = e.target.files[0];
            // const file = e.target.files;
            this.avatar = file;
        },
        onClose() {
            this.$emit('close')
        },
        submitForm(e) {
            e.preventDefault();
            const newDev = {
                firstname: this.firstname,
                lastname: this.lastname,
                email: this.email,
                phone: this.phone,
                address: this.address,
                avatar: this.avatar,
            }
            this.firstName = '';
            this.lastname = '';
            this.email = '';
            this.address = '';
            this.phoneNumber = '';
            this.avatar = '';

            this.$emit("submitForm", newDev);

            this.$emit('close')

        }
    },
    data () {
        return {
            firstname: "",
            lastname: "",
            email: "",
            address: "",
            phone: "",
            avatar: "",
        }
    }
}
</script>
<style scoped>
.form-container{
    height: 100vh;
    width: 100vw;
    top: 0;
    left: 0;
    position: fixed;
    background: rgba(115, 115, 115, 0.58);
    backdrop-filter: blur(10px);
    display: flex;
    align-items: center;
    animation: fadein ease 500ms;
}
@keyframes fadein {
    0%{
        opacity: 0;
    }
    100%{opacity: 1}
}
.form-container > div{
    width: 30rem;
    height: 30rem;
    margin: auto;
    background: #ffffff;
    padding: 2rem 4rem;
    box-shadow: 0 0.5rem 1.5rem #4c4c4c;

}
form > div{
    display: flex;
    justify-content: space-between;
}
input {
    border-top: 0;
    border-right: 0;
    border-left: 0;
}
input[type="file"] {
    width: 13rem;
}
</style>
