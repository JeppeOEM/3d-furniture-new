<template>    <div :class="{ 'loading-cursor': isLoading }" >

    <navbar></navbar>

        <ShareModal :sessionData="sessionData"
            v-if="isShareModalVisible"
            @close-share-modal="handleShareModalClose"
        ></ShareModal>

    <HelpModal :sessionData="sessionData"
        v-if="isModalVisible"
        @close-modal="handleModalClose"
    ></HelpModal>
    <div class="wrapper">
        <configurator
            @updateConfiguration="updateConfiguration"
            :type="type"
            :color="color"
            :sessionData="sessionData"
            :addFurniture="furnitureData"
        >
        </configurator>

        <div class="margin-bottom">
            <div class="selection-bar-wrapper">
                <div class="top-container">
                    <div class="top-button-box d-flex justify-content-between">
                        <h3
                            class="semi-big-text darkblue" id="setHeight"

                        >
                            Modules
                        </h3>
                        <h3 class="medium-text help" @click="openModal">Help</h3>
                    </div>
                    <span class="text-selector medium-text">Select fabric:</span>
                    <div class="linetop"></div>
                    <div v-if="type === 'dawn'" class="">
                        <div class="container-fluid">
                            <div class="row color-pad">
                                <div class="col-2 gx-0 mr-1">
                                    <div class="image-container">
                                        <img
                                            @click="
                                                sendColor(
                                                    'BLACK_207_VELOUR_LUX_PETRO.glb'
                                                )
                                            "
                                            class="img-fluid rounded-img"
                                            :src="'/assets/fabric_thumbnails/blue.png'"
                                            alt="fabric"
                                        />
                                    </div>
                                </div>

                                <div class="col-2 gx-0 mr-1">
                                    <div
                                        @click="
                                            sendColor(
                                                'BLACK_177_OLENA_LIGHT_GREY.glb'
                                            )
                                        "
                                        class="image-container pl-1"
                                    >
                                        <img
                                            class="img-fluid rounded-img"
                                            :src="'/assets/fabric_thumbnails/grey.png'"
                                            alt="fabric'"
                                        />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div v-if="type === 'dusk'" class="">
                        <div class="container">
                            <div class="row smallpad">
                                <div class="col-2 gx-0 mr-1">
                                    <div
                                        @click="sendColor('BLACK_COTTON.glb')"
                                        class="image-container hover-overlay"
                                    >
                                        <img
                                            @click=""
                                            class="img-fluid rounded-img"
                                            :src="'/assets/fabric_thumbnails/duskgrey.png'"
                                            alt="fabric'"
                                        />
                                    </div>
                                </div>

                                <div class="col-2 gx-0 mr-1">
                                    <div
                                        @click="
                                            sendColor('WHITE_COARSE_COTTON.glb')
                                        "
                                        class="image-container hover-overlay"
                                    >
                                        <img
                                            @click=""
                                            class="img-fluid rounded-img"
                                            :src="'/assets/fabric_thumbnails/whitedawn2.png'"
                                            alt="fabric'"
                                        />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <div
                        class="series d-flex justify-content-between flex-column"
                    >
 
                        <span class="text-selector">Product serie: {{ type }}</span>

                        <select
                            name="series"
                            v-model="selectedOption"
                            @change="handleSelectionChange"
                        >
                            <option value="">Select new:</option>
                            <option value="dawn" selected>Dawn</option>
                            <option value="dusk">Dusk</option>
                        </select>
                    </div> -->
                </div>

                <div class="selection-bar">
                    <div v-if="sideBar === 'modules'">
                        <div class="grid-container">
                            <div
                                class="grid-img"
                                v-for="thumbnail in thumbnails"
                                :key="thumbnail.id"
                                                            >
                                    <div ref="addFurnitureDiv"
                                    @click="addFurniture($event, thumbnail.id)"
                                    :class="{ 'loading-cursor': isLoading }"
                                    class="img-container hover-overlay"
                                    >
                                    <img
                                        class="img-fluid rounded-img"
                                        :src="
                                            getImgPath(
                                                thumbnail.type,
                                                thumbnail.category,
                                                thumbnail.file_name
                                            )
                                        "
                                        alt="Furniture component"
                                    />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bottom-container">

                    <div class="d-flex flex-column price">
                        
                                                <div class="line">
                                                    
                                <div class="greyline d-flex justify-content-between">
            
                                    <span class="semi-big-text smallpad">Price:</span>
                                <span v-if="totalPrice.length === 1" class="semi-big-text smallpad">
                                    0 DKK
                                </span>
                                    <span v-else class="semi-big-text smallpad">
                                    {{ totalPrice }} DKK
                                    </span>
                                </div>
                            </div>
                        <a
                            class="text-normal square-button2"
                            :href="route('list')"
                            target="_blank"
                            >Get product list</a
                        >
                        <a
                            class="text-normal black square-button2 inverse"
                            @click="openShareModal"
                            >Share & save</a
                        >


                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</template>

<style scoped>

.text-normal{
    color: white;
}
.text-normal.black{
    color: black;
}
.greyline{
    margin-top: 1px;
    border-top: solid 2px var(--grey);
}
.help:hover{

    color: var(--blue);
}

.menubar{
    background-color: transparent;
}
    .loading-cursor {
  cursor: wait !important;
}

.color-pad {
    padding-top: 5px;
}

.series {
    margin-top: 5px;
    margin-bottom: 5px;
}

.top-button-box {
    border-bottom: solid 2px var(--grey);
    margin-bottom: 5px;
}


/* .square-button2.inverse:hover {
    background-color: var(--black);
    bordder: 2px solid var(--white);
    color: var(--white);
    box-sizing: border-box;
} */

.wrapper {
      max-width: 100%;
  overflow-x: hidden;
}

.margin-bottom {
    margin-bottom: 50px;
}
.selection-bar-wrapper {
    z-index: 9999;
    position: absolute;
    width: 350px;
    top: 40px;
    bottom: 0px;
    /* left: 40px; */
    right: 40px;
    max-height: calc(100% - 80px);
    background-color: var(--white);
    border-radius: var(--roundedges); 
    box-shadow: var(--shadow);
    border-right: solid 2px var(--grey);
    overflow: hidden;
    display: flex;
    flex-direction: column;
}

.selection-bar {
    flex: 1;
    overflow-y: auto;
    background-color: white;
    padding-left: 15px;
    padding-right: 15px;
    padding-top: 15px;
    padding-bottom: 10px;
    max-height: calc(100% - 70px);
        /* border-top: solid 1px grey;
    border-bottom: solid 1px grey; */

}
.top-container,
.bottom-bottom {
    padding: 15px;
}

.top-container {
    border-bottom: var(--grey);
    padding-bottom: 5px;
    position: relative;
}

.image-container {
    position: relative;
    width: 100%;
    padding-bottom: 75%;
    /* Example aspect ratio: 4:3 (75% = 3/4 * 100%) */
}

.image-container img {
    cursor: pointer;
    border-radius: 5px;
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    /* object-fit: cover;  */
}

.wrapper {
    position: relative;
    height: 100vh;
    width: 100vw;
    display: flex;
    justify-content: center;
    align-items: center;
}

.grid-container {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(130px, 1fr));
    grid-gap: 5px 10px;
    /* overflow-y: auto;
  height: calc(100% - 50px);
  max-height: calc(100% - 50px); */
}



.price {

    padding-left: 15px;
    padding-right: 15px;
    padding-bottom: 15px;
}
.smallpad {
padding-top: 5px;
    padding-bottom: 5px;
}
.padfabric {
}

select {
    font-size: 1rem;
    padding: 5px;
    width: 100%;
}
@media screen and (max-width: 950px) {
    .grid-container {
        grid-template-columns: repeat(auto-fit, minmax(100px, 1fr));
    }

    select {
        max-width: 260px;
        position: static;
    }
.linetop {
    position: absolute;
    width: 50%;
    height: 2px;
    background-color: var(--grey);
    left: 25%;
    top: 6px;
    border-radius: 5px;
}
    .selection-bar-wrapper {
        position: fixed;
        top: unset;
        left: unset;
        right: unset;
        bottom: unset;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 8%;
        cursor: grab;
        background-color: var(--white);
        border-bottom-left-radius: 0px;
        border-bottom-right-radius: 0px;
        box-shadow: var(--shadow);
        display: flex;
        overflow: hidden;
        flex-direction: column;
    }

    .selection-bar {
        flex: 1;
        overflow-y: auto;
        background-color: white;
        padding-left: 15px;
        padding-right: 15px;
        padding-top: 15px;
        padding-bottom: 10px;
        max-height: unset;
    }

    .draggableDiv {
    }
}
</style>

<script setup>
import configurator from '@/Components/Configurator.vue'
import HelpModal from '@/Components/HelpModal.vue'
import ShareModal from '@/Components/ShareModal.vue'
import navbar from '@/Layouts/Navbar.vue'
import mobileDragDiv from '@/FunctionExports/mobileDragDiv.js'
import prices from '@/FunctionExports/prices.js'
import { getImgPath } from '@/FunctionExports/getImgPath.js'
</script>

<script>

import axios from 'axios'
import { shallowReactive } from 'vue'




export default {
    name: 'Configurator',
    components: {
        navbar,
        configurator,
        HelpModal
    },
    props: {
        components: Array,
        sessionData: Object,
        showModal: Boolean
    },

    data() {
        return {
            isLoading: false,
            isShareModalVisible: false,
            isModalVisible: false,
            selectedOption: '',
            side: 'right',
            configurationId: null,
            type: 'dawn',
            selectedComponent: null,
            test: [],
            color: 'BLACK_177_OLENA_LIGHT_GREY.glb',
            thumbnails: [],
            sideBar: 'modules',
            configurationsByUser: [],
            configurationId: null,
            configuration: {},
            componentList: [],
            furnitureData: {},
            savedConfiguration: {},
            configurationList: [],
            totalPrice: [0]
        }
    },

    methods: {






        startLoading(targetElement) {
            // Add the loading cursor class to the target div
            targetElement.classList.add('loading-cursor');

            // Disable clicking on the target div
            targetElement.style.pointerEvents = 'none';

            setTimeout(() => {
                // Remove the loading cursor class from the target div
                targetElement.classList.remove('loading-cursor');

                // Enable clicking on the target div
                targetElement.style.pointerEvents = 'auto';
            }, 3000);
        },

        sendColor(color) {
            this.color = color;
        }, 
        
        openShareModal() {
            this.isShareModalVisible = true

        },
        closeShareModal() {
            this.isShareModalVisible = false

        },

        handleShareModalClose() {
            this.closeShareModal()
        },

        openModal() {
            this.isModalVisible = true
            let navbar = document.querySelector('.menubar')
            navbar.classList.add('hidden')
        },
        closeModal() {
            this.isModalVisible = false
            let navbar = document.querySelector('.menubar')
            navbar.classList.remove('hidden')
        },

        handleModalClose() {
            this.closeModal()
        },


    
        handleSelectionChange() {
            this.type = this.selectedOption
            if (this.type === 'dawn') {
                this.color = 'BLACK_207_VELOUR_LUX_PETRO.glb'
            } else {
                this.color = 'BLACK_COTTON.glb'
            }
            axios
                .get(route('editor.show'), {
                    params: {
                        color: this.color
                    }
                })
                .then((response) => {
                    this.thumbnails = response.data
                })
                .catch((error) => {
                    console.log(error)
                })
        },

        clearSession() {
            this.savedConfiguration = {}
            this.postConfiguration()
        },

        async getConfigurations() {
            try {
                const response = await axios.get(
                    route('configuration.configurationsByUser')
                )
                this.configurationsByUser = response.data.configurations
            } catch (error) {
                console.log(error)
            }
        },

        async addFurniture(event, id) {
            const targetElement = event.currentTarget;
            // this.startLoading(targetElement);
            try {
                
                const response = await axios.get(
                    route('configuration.componentById'),
                    {
                        params: {
                            id
                        }
                    }
                )

                const url = response.data.component.url
                const category = response.data.component.category
                const words = [
                    'CHAISE_RIGHT',
                    'CHAISE_LEFT',
                    'CORNER',
                    'CHAISE_LEFT',
                    'CHAISE_RIGHT'
                ]
                let foundWord = null
                let connection = false

                console.log('Loaded furnityre data', this.furnitureData)

                for (let i = 0; i < words.length; i++) {
                    if (category.includes(words[i])) {
                        foundWord = words[i]
                    }
                }
                if (foundWord) {
                    if (foundWord === 'CHAISE_RIGHT') {

                        this.side = 'rightCorner'
                    } else if (foundWord === 'CHAISE_LEFT') {
                        this.side = 'leftCorner'
                    } else if (foundWord === 'CORNER_RIGHT') {
                        this.side = 'rightCorner'
                    } else if (foundWord === 'CORNER_LEFT') {
                        this.side = 'left'
                    } else if (foundWord === 'CORNER') {
                        connection = true
                    }
                }

                this.furnitureData = {
                    posX: 0,
                    posY: 0,
                    posZ: 0,
                    selectedComponent: id,
                    url: url,
                    side: this.side,
                    connection: connection
                }

            } catch (error) {
                console.log(error)
                console.log('furniture Data in error', this.furnitureData)
            }
        },

        //callback everytime an emit happens in Configurator
        async updateConfiguration(updateConfiguration) {
            this.savedConfiguration = updateConfiguration
            this.totalPrice = this.savedConfiguration.totalPrice
            
            let resp = await prices(this.savedConfiguration.componentIds);
            this.totalPrice = resp
            this.postConfiguration()
            // loadComponentPrices(this, this.savedConfiguration.componentIds)

        },

        async postConfiguration() {
            // loadComponentPrices(this, this.savedConfiguration.componentIds)
            const response = await axios.post(route('configuration.store'), {
                configuration: this.savedConfiguration,
                componentList: this.savedConfiguration.componentIds,
                color: this.color
            }) // Wrap the data in an array
            // console.log("POST REQ",response.data.sessionData.configuration)
        }
    },
    watch: {
        color(newColor, oldColor) {
            axios
                .get(route('editor.show'), {
                    params: {
                        color: newColor
                    }
                })
                .then((response) => {
                    this.thumbnails = response.data
                })
                .catch((error) => {
                    console.log(error)
                })
        }
    },

    mounted() {
        const modulesBtn = document.getElementById('setHeight');
        modulesBtn.addEventListener('click', this.setHeight);
        mobileDragDiv() // mobile bottom menu

        axios
            .get(route('editor.show'), {
                params: {
                    color: this.color
                }
            })
            .then((response) => {
                this.thumbnails = response.data
            })
            .catch((error) => {
                console.log(error)
            })

        if (this.sessionData == null) {
            console.log('No previous session found')            
            this.openModal()

        } else {
            console.log(
                'Session found with this session Data',
                this.sessionData
            )
        }

        // for (let i = 0; i<  this.components.length; i++);{
        // this.components[i];
        // }
    }
}
</script>
