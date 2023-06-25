<template>
    <div class="modal-overlay">
        <div class="modal-wrapper">
            <div class="modal-content">
                <span class="close-btn medium-text" @click="closeModal">×</span>
                <span class="savedconfigurations fw-semibold">Saved configurations</span>
                <div class="text-box ">
                    <div class="scroll-box d-flex flex-column" v-if="userConfigurations.length > 0">
                        <a v-for="configuration in reversedUserConfigurations" :key="configuration.id"
                            :href="route('editor.unique', { uniqueValue: configuration.identifier })">
                            <span class=" text-normal">{{ formatTime(configuration.updated_at) }} :: </span><span class="text-normal"> ID:</span> <span class="text-normal"> {{
                                configuration.identifier }}
                                   </span>  </a>
                    </div>
                    <div v-else>
                        no saved configurations
                    </div>
                    <div class="text-center"  v-if="userConfigurations.length > 0">
                                <span class="text-normal smallpad ">Click on a row to open the editor</span>
                    </div>

                    <div class="btnBox d-flex align-items-center justify-content-center">

                        <span class="inverse" @click="closeModal">Close</span>

                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
.savedconfigurations{
    position: absolute;
    top: -30px;
}
.smallpad{
padding-top: 10px;
}
.scroll-box{
      margin-bottom: 10px;
      white-space: nowrap;
}
.scroll-box .text-normal{
        font-size: 1rem;
}
.scroll-box a {
  background-color: white;

}
.scroll-box a:nth-child(even) {
  background-color: var(--grey);
}
.modal-overlay {
  z-index: 9999999;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  display: flex;
  align-items: center;
  justify-content: center;
  background-color: rgba(0, 0, 0, 0.8);
}

.modal-wrapper {
  border-radius: 10px;
  background-color: var(--light-grey);
  padding: 20px;
  padding-top: 40px;
  max-width: 600px;
}

.scroll-box {
    border: solid 1px var(--grey);
    width: 270px;
    max-height: 250px;
    overflow-y: auto;
}



span {
    border-radius: 5px;
}





.btnBox {
    margin-top: 10px;
    display: flex;
    justify-content: space-between;
}



.changeBtn {
    padding: var(--btnpad);
    font-size: 1.025rem;
    padding-left: 30px;
    padding-right: 30px;
    border: none;
    color: var(--white);
    background-color: #000;
    cursor: pointer;
}

.inverse {
    padding: var(--btnpad);
    font-size: 1.025rem;
    padding-left: 15px;
    padding-right: 15px;
    color: white;
    background-color: var(--light-blue);
    cursor: pointer;
    /* outline: solid 2px #000;
    outline-offset: -2px; */
}

.close-btn {
    position: absolute;

    top: -50px;
    right: 0px;
    border: none;
    color: black;
    font-size: 40px;
    cursor: pointer;
}







.container-fluid {
    position: relative;
    max-width: 100%;
    height: auto;
}

.text-normal{
    color: #000;

}



</style>


<script>
export default {



    data() {
        return {
            session: null,
            userConfigurations: [],
            user:null

        }
    },
    props: {

        sessionData: Object
    },
    computed: {
        reversedUserConfigurations() {
            return this.userConfigurations.slice().reverse();
        },
    },
    methods: {

        closeModal() {
            this.$emit('close-saved-modal')
        },
        formatTime(time){
            const date = new Date(time);
            const options = { day: 'numeric', hour: '2-digit', minute: '2-digit', month: 'long',  };
            const formattedTime = date.toLocaleString([], options);

            return formattedTime
            console.log(formattedTime);

        },

        getUserConf(){
            axios.get(route('configuration.configurationsByUser'), {
                params: {
                    user: this.user
                }
            })
                .then(response => {
                    // Handle the response data here
                    console.log(response.data.configurations);
                    this.userConfigurations = response.data.configurations;
                })
                .catch(error => {
                    // Handle any errors here
                    console.error(error);
                });

        }
    },

    mounted() {
        this.getUserConf()

    }

}
</script>
<script setup>

import { computed } from 'vue'
import { usePage } from '@inertiajs/vue3'


const username = computed(() => usePage().props.auth.user)
console.log(username)
// this.user = username
// const flashSuccess = computed(() => usePage().props.flash.success)
// console.log(usePage().props.flash.success)



</script>