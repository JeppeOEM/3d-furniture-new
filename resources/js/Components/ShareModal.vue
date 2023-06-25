<template>
    <div class="modal-overlay d-flex align-items-center justify-content-center">
        <div class="container-fluid gx-0 container-lg modal d-flex align-items-center justify-content-center">
            <div class="row inner gx-0">
                <span class="close-btn medium-text" @click="closeModal">×</span>
                <div class="text-box">
                    <!-- <div v-if="session != null"> -->
                        <span class="text-medium">
                            Copy the link below and share it
                            <br /><span class="text-normal lightblue"
                                id="url">http://127.0.0.1:8000/editor/saved/{{
                                    session }}</span>
                        </span>
                        <div class="btnBox d-flex align-items-center justify-content-center">
                            <span class="copybtn text-center inverse ubuntu" @click="changeButtonText">{{ buttonText }}
                            </span>
                            
                            <span class="text-center inverse whitebtn ubuntu" @click="closeModal">Close
                            </span>
                        </div>
                </div>
            </div>
        </div>
    </div>
</template>


<style scoped>
.inverse {

    margin-right: 25px;
}
.text-box{
    padding:20px;
    padding-left: 30px;
    padding-right: 30px;
}

span {
    border-radius: 5px;
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
.pageNumber {
    position: absolute;
    top: 20px;
    margin-left: 20px;
}

.col-auto {
    margin-top: auto;
    padding-bottom: 80px;
}



.btnBox {
    padding-bottom: 10px;
    margin-top: 10px;
    /* bottom: 33px;
    right: 23px; */
    display: flex;
    justify-content: space-between;
}




.copybtn{
    width: 120px;
}

.close-btn {
    transform: translate(+94%);
    position: absolute;

    top: 0px;
    /* right: 15px; */
    border: none;
    background-color: transparent;
    color:white;
    font-size: 40px;
    cursor: pointer;
}

.inner {
    border-radius: var(--roundedges);
    position: relative;

    width: auto;
    height: auto;
    /* background-color: #3C3F41; */
    background-color: var(--light-grey);
    box-shadow: var(--shadow);

}

.container {
    position: relative;
}

.page {
    padding-top: 75px;
    padding-bottom: 75px;
    /* width: 100%;
    height: 100%; */
}


.modal-overlay {
    z-index: 99999;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;


}

.container-fluid {
    position: relative;
    max-width: 100%;
    height: auto;
}


@media only screen and (max-width: 680px) {



}

@media only screen and (max-width: 992px) {
    .col-auto {
        padding-bottom: 30px;
    }

    .page {
        padding-left: 20px;
    }


}
</style>
<style>
.modal-overlay {
    z-index: 99999999;
}
</style>

<script>
export default {
    data() {
        return {
            session: null,
            buttonText: 'Copy link',
        }
    },
    props: {

        sessionData: Object
    },

    methods: {

        changeButtonText() {
            this.copyToClipboard()
            this.buttonText = 'Link copied';
            setTimeout(() => {
                this.buttonText = 'Copy link';
            }, 4000);
        },
    

        copyToClipboard() {
            const inputElement = document.getElementById('url');
            const textToCopy = inputElement.textContent || inputElement.innerText;

            navigator.clipboard.writeText(textToCopy)
                .then(() => {
                    console.log(textToCopy);
                })
                .catch((error) => {
                    // Error handling
                    console.error('Failed to copy text: ', error);
                });
        },

        closeModal() {
            this.$emit('close-share-modal')
        },
        async getComponentList() {
            try {
                const response = await axios.get(
                    route('configuration.configurationBySession')
                )
                const session = await response.data.identifier
                this.session = session;
                console.log("sesh",session);
            } catch (error) {
                console.error(error)
                return null
            }
        },
        copy() {
    // Get the text field
    var copyText = document.getElementById("myInput");

    // Select the text field
    copyText.select();
    copyText.setSelectionRange(0, 99999); // For mobile devices

    // Copy the text inside the text field
    navigator.clipboard.writeText(copyText.value);

    // Alert the copied text
    alert("Copied the text: " + copyText.value);
}

    },

    mounted() {
        //    this.getSession()
       this.getComponentList();
    }

}
</script>
