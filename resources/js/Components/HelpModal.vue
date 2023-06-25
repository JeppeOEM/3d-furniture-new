<template>
    <div class="modal-overlay d-flex align-items-center justify-content-center">
        <div class="container-fluid gx-0 container-lg modal d-flex align-items-center justify-content-center">
            <div class="row"></div>
            <div class="row inner gx-0">
                <p class="close-btn medium-text help" @click="closeModal">×</p>

                <div class="page row p-lg-4 gx-0" v-if="page === 1">
                    <div class="col-12 col-lg-8 vid-size d-flex align-items-center justify-content-center">
                        <div class="media-wrapper">
                            <video :src="vid1" controls></video>
                        </div>
                    </div>
                    <div class="col-auto col-12 col-lg-4">
                        <p class="fw-semibold medium-text pageNumber darkblue">
                            {{ page }} out of 2
                        </p>
                        <div class="">
                            <!-- <span class="fullscreen"><em> view on full screen</em></span> -->
                            <h3 class="semi-big-text">Select, rotate and delete</h3> 
                        </div>

                        <div class="list">
                            <li>Choose a fabric from the top left corner</li>
                            <li>Click to add a module</li>
                            <li>
                                Rotate or delete module the latest added
                                furniture in the bottom menu
                            </li>
                            <li>
                                Click on diffrent model if you want to select it
                                to delete or rotate instead
                            </li>
                        </div>
                        <div class="d-flex justify-content-between">
                            <div class="btnBox d-flex align-items-center justify-content-center">
                                <span @click="closeModal" class="skipBtn">Skip guide</span>
                                <span class="inverse" @click="page = 2">Next</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="page row p-lg-4 gx-0" v-if="page === 2">
                    <div class="col-12 col-lg-8 vid-size d-flex align-items-center justify-content-center">
                        <div class="media-wrapper">
                            <video :src="vid2" controls></video>
                        </div>
                    </div>
                    <div class="col-auto col-12 col-lg-4 list-col">
                        <p class="fw-semibold medium-text pageNumber">
                            {{ page }} out of 2
                        </p>
                        <h3 class="semi-big-text">Move the view</h3>
                        <div class="list">
                            <li>
                                Press the left mouse button down and move the
                                mouse to rotate the view
                            </li>
                            <li>
                                Zoom in and out by scrolling on the mouse wheel,
                                or on mobile by using two fingers and seperate
                                them
                            </li>
                            <li>
                                Hold shift down and press the left mouse button
                                to grab the floor and move it
                            </li>
                        </div>
                        <div class="btnBox d-flex align-items-center justify-content-center">
                            <span class="inverse whitebtn" @click="page = 1">
                                Back
                            </span>

                            <span class="inverse" @click="closeModal">Start Building
                            </span>
                        </div>
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

.fullscreen{
    padding-left: 20px;
    transform: translateY(30%);
}
.fullscreen span{

}

li{
    font-size:1.025rem;

    margin-bottom: 15px; 
}

h3{
    margin-left: 20px;
    margin-bottom: 40px;
}
span {
    border-radius: 5px;
}

.pageNumber {
    position: absolute;
    top: 25px;
    margin-left: 20px;
}

.col-auto {
    margin-top: auto;
    padding-bottom: 80px;
}



.list {
    display: flex;
    flex-direction: column;

    padding-left: 20px;
    height: 50%;
    margin-top: auto;
}

.btnBox {
    position: absolute;
    bottom: 33px;
    right: 23px;
    display: flex;
    justify-content: space-between;
}
.skipBtn {
    margin-right: 20px;
    font-size: 1.025rem;
}
.skipBtn:hover {
    cursor: pointer;
}

.changeBtn {
    padding: var(--btnpad);
    font-size: 1.2rem;
    padding-left: 30px;
    padding-right: 30px;
    border: none;
    color: var(--white);
    background-color: var(--light-blue);
    cursor: pointer;
}

.changeBtn:hover{
        background-color: var(--white);
        color: var(--light-blue);
        border: solid 2px var(--light-blue);
}


.close-btn {
    transform: translate(+94%);
    position: absolute;

    top: -10px;
    /* right: 15px; */
    border: none;
    background-color: transparent;
    color: #000;
    font-size: 60px;
    cursor: pointer;
}
.inner {
    border-radius: var(--roundedges);
    position: relative;
    background-color: white;
    width: 1200px;
    height: 600px;
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
.vid-size {
    /* display: flex;
  align-items: center;
  justify-content: center; */
    height: 100%;
}
.media-wrapper {
    margin-left:20px;
    margin-right: 20px;
    border-radius: 50px;
    margin-top: 10%;
    margin-bottom: 10%;
    position: relative;
    width: 100%;
    height: 100%;
    /* 75% assumes a 4:3 aspect ratio (600/800 = 0.75) */
}
.media-wrapper video {
    border: solid 1px grey;
    border-radius: 10px;
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: contain;
}

.modal-overlay {
    z-index: 9999999;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;

  background-color: rgba(0, 0, 0, 0.8);
}

.container-fluid {
    position: relative;
    max-width: 100%;
    height: auto;
}

@media only screen and (max-width: 992px) {
   .col-auto{
    margin-top: 30px;
   }
    .close-btn {
    transform: translate(+87%);
    position: absolute;

    top: -10px;
    /* right: 15px; */
    border: none;
    background-color: transparent;
    color: #000;
    font-size: 60px;
    cursor: pointer;
}
   
    .col-auto {
        padding-bottom: 30px;
    }

    .page {
        padding-left: 20px;
    }
    .inner {

        height: 100%;
        border-radius: 0px;
        background-color: var(--light-grey);
    }
    .container-fluid{
        height: 100%;
    }
    .vid-size {
        height: unset;
    }

    .page {
        padding-top: 75px;
        padding-bottom: 75px;
        width: 100%;
        height: 100%;
    }


.pageNumber {

    top: 20px;
    margin-left: 20px;
}

}
</style>


<script>
export default {
    data() {
        return {
            vid1: "assets/video/vid1.mp4",
            vid2: "assets/video/vid2.mp4",
            page: 1,
            navbar: document.querySelector('.navbar')
        }
    },
    props:{
        sessionData:Object
    },

    methods: {
        closeModal() {
            this.$emit('close-modal')
            console.log(this.sessionData);

        },
        toggleContent() {
            if (this.page === true) this.page = false
            else {
                this.page = true

            }
        },
                async getComponentList() {
            try {
                const response = await axios.get(
                    route('configuration.configurationBySession')
                )
                const session = await response.data.sessionData
       
                console.log(session);
            } catch (error) {
                console.error(error)
                return null
            }
        },
    },

    mounted() {

    }
}
</script>
