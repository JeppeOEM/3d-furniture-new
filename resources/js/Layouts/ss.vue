<template>
    <nav class="menubar bgnav">
        <div class="container-fluid gx-0">
            <div class="menubar-content">
                <div class="d-flex justify-content-center align-items-center">
                    <a class="menubar-brand ubuntu" :href="route('index')">
                        <img src="/assets/logo.svg" width="50" height="50" class="brand-logo" alt="cubicraft" />
                        <span class="logo-text"> cubicraft </span>
                    </a>
                </div>
                <input type="checkbox" id="menubar-toggle" class="menubar-toggle d-none" />
                <label for="menubar-toggle" class="menubar-toggle-label">
                    <span class="burger-icon"></span>
                </label>
                <div class="d-flex justify-content-between">

                
                <ul class="menubar-menu">
                    <li class="menu-item">
                        <a class="medium-text" :href="route('planner')">Furniture Planner</a>
                    </li>
                    <li class="menu-item active">
                        <a class="medium-text" :href="route('editor')">Editor</a>
                    </li>

                    <li class="menu-item">
                        <a class="medium-text" href="mailto: abc@example.com">Contact</a>
                    </li>
                    <li  v-if="!user" class="menu-item">
                        <a class="medium-text" :href="route('login')">Login</a>
                    </li>
                    <li  v-if="!user" class="menu-item">
                        <a class="medium-text" :href="route('user-account.create')">Register</a>    
                    </li>
                    <li class="menu-item" v-if="user" >
                                    <Link
                                        :href="route('logout')"
                                        method="delete"
                                        class="medium-text"
                                        >Logout
                                    </Link>
                    </li>
                    <li class="menu-item" v-if="user" >
                           <a class="medium-text"  @click="openSavedModal">
                             Saved configurations
                           </a> 
                    </li>
                </ul>
                <ul class="menubar-menu">

                </ul>
                </div>
                    <!-- <div v-if="user" class="flex items-center gap-4">
                        <h2>
                            {{ user.name }}
                        </h2>
                        <div>

                        </div>
                    </div>
                    <div v-else class="flex items-center gap-2">

                    </div> -->
                            <div
                v-if="flashSuccess"
              
            >
                {{ flashSuccess }}
            </div>

            </div>
        </div>
    </nav>
    <SavedModal v-if="isSavedModalVisible"
                @close-saved-modal="handleSavedModalClose"></SavedModal>
</template>


<style>

    .bgnav{
background-color: rgba(248, 248, 248, 0.9)

    }
</style>
<script>
export default {

    data() {
        return {
            isSavedModalVisible: false
        }
    },

    methods: {
        openSavedModal() {
            this.isSavedModalVisible = true

        },
        closeSavedModal() {
            this.isSavedModalVisible = false

        },

        handleSavedModalClose() {
            this.closeSavedModal()
        },
    }
}
</script>


<script setup >
import { computed } from 'vue'
import { Link, usePage } from '@inertiajs/vue3'
import SavedModal from '@/Components/SavedModal.vue'


const user = computed(() => usePage().props.auth.user)
console.log(user)
const flashSuccess = computed(() => usePage().props.flash.success)
console.log(usePage().props.flash.success)
// const user = computed(
//     () => page.props.value.user,
// )

</script>




<style scoped>
.logoutlink{

}
.menubar {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    /* background-color: var(--light-grey); */
    color: var(--black);
    z-index: 9999;
    padding: 0;
    margin-left: 6px;
}    

.menubar-content {
    display: flex;
    align-items: center;
    padding: 10px;
}

.menubar-menu {

    display: flex;
    list-style: none;
    margin: 0;
    padding: 0;
    padding-left: 25px;
    padding-bottom: 8px;
 
}




.brand-logo {
    margin-right: 10px;
}



.menu-item {
    margin-right: 15px;
}

.medium-text {
    /* color: unset; */
    padding: 10px;
    margin-bottom: 3px;
}

.menubar-toggle {
    display: none;
}

.menubar-toggle-label {
    display: none;
    width: 30px;
    height: 30px;
    position: relative;
    cursor: pointer;
}

.menubar-toggle-icon {
    display: block;
    width: 100%;
    height: 2px;
    background-color: var(--black);
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    transition: background-color 0.3s ease-in-out;
}

.menubar-toggle:checked+.menubar-toggle-label .menubar-toggle-icon {
    background-color: transparent;
}

.logo-text{
    font-size: 1.7rem;
    color: var(--light-blue) !important;
}
    .burger-icon {
        display: block;
        width: 30px;
        height: 3px;
        background-color: var(--black);
        position: relative;
        transition: background-color 0.3s ease-in-out;
    }

    .burger-icon:before,
    .burger-icon:after {
        content: "";
        position: absolute;
        width: 30px;
        height: 3px;
        background-color: var(--black);
        transition: background-color 0.3s ease-in-out;
    }

    .burger-icon:before {
        top: -8px;
        transition-delay: 0.1s; 
    }

    .burger-icon:after {
        top: 8px;
        transition-delay: 0.1s; 
    }


    .menubar-toggle:checked + .menubar-toggle-label .burger-icon {
        background-color: transparent;
    }

    .menubar-toggle:checked + .menubar-toggle-label .burger-icon:before {
        transform: rotate(45deg);
        top: 0;
        transition-delay: 0s; 
    }
    .menubar-toggle:checked + .menubar-toggle-label .burger-icon:after {
        transform: rotate(-45deg);
        top: 0;
        transition-delay: 0s; 
    }

@media screen and (max-width: 768px) {

    .menubar-menu {
            border-radius: 5px;
    border: solid 1px grey;
        flex-basis: 100%;
        text-align: center;
    }

    .menubar-brand {
        font-size:1.7rem;
        margin-bottom: 10px;
    }

    .menubar-menu {
    display: none;
    position: absolute;
    top: 0px;
    right: 0px;
    padding-top: 50px;
    background-color: var(--white);
    text-align: center;
/* '    padding: 10px;' */
    }

    .menubar-toggle {
        display: block;
    }

    .menubar-toggle-label {
        z-index: 1;
        display: block;
        position: absolute;
        top: 30px;
        right: 20px;
    }

    .menubar-toggle-icon {
        background-color: var(--black);
        transition: background-color 0.3s ease-in-out;
    }

    .menubar-toggle:checked+.menubar-toggle-label .menubar-toggle-icon {
        background-color: transparent;
    }

    .menubar-toggle:checked~.menubar-menu {
        display: block;
    }

    .menubar-content {
        position: relative; /* Add relative positioning to the menubar content */
    }

    .menubar-content > * {
        margin-bottom: 0; /* Remove bottom margin from menubar content children */
    }
}
</style>