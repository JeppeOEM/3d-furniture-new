<template>
    <div
        class="prevent-select d-flex justify-content-center align-items-center"
    >


        <slot></slot>
    </div>
</template>

<script>
export default {
    name: 'CanvasToolbar',
    // Your component's options and logic go here
    methods: {
        deleteSession() {
            axios
                .post('/delete-session')
                .then(() => {
                    location.reload();
                })
                .catch((error) => {
                    console.error(error)
                })
        }
    }
}
</script>

<style scoped>
.prevent-select {
    -webkit-user-select: none; /* Safari */
    -ms-user-select: none; /* IE 10 and IE 11 */
    user-select: none; /* Standard syntax */
    
}

/* Your component's styles go here */
</style>
