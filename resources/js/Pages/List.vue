<template class="">
    <div class="background overflow">
        <navbar></navbar>
        <div class="container-fluid container-lg">

            <h1 class="big-display-1 top-pad darkblue ubuntu">Product List</h1>

            <div class="firstchild gx-0 ">

          

                <div  class="" v-for="(item, index) in populatedList" 
                :class="{ 'last-row': index === populatedList.length - 1 }" :key="item.id">
                    <div class="product-info ">
                        <div class="listitem row justify-content-md-between rowline gx-0 item-details">
                            <div class="col-12 col-sm-2 img-wrapper">
                                <img class="list-img" :src="item.url" alt="Furniture component" />
                            </div>
                            <div class="col-8 col-sm-4 text-normal marginsmall d-flex align-items-top">
                                <span>
                                    <span class="fw-semibold medium-text ubuntu">
                                        Modular Sofa Connection</span><br />
                                   1 x {{ item.type }} {{ item.category }}<br /> </span>
                            </div>

                            <div class="col-8 col-sm-4 text-small margin info">
                                <br />
                                <span class=""><span class="fw-semibold">Size:</span> W: 160cm H: 120cm D: 99cm<br />
                            
                                    <span class=""><span class="fw-semibold">Fabric:</span> {{ item.fabricColor.color }}&nbsp;
                                    </span>
                                    <span class="">
                                        {{ item.fabricColor.texture }}
                                    </span>
                                </span>
                            </div>
                            <div class="itemprice col-12 col-sm-2 d-flex justify-content-end  margin " >
                                <span class="ubuntu  medium-text  fw-semibold">
                                    {{ item.price }} DKK
                                </span>
                            </div>

                        </div>
  

                    </div>
                </div>
                <div class="totalprice  line d-flex justify-content-end">
                    <p class=" semi-big-text fw-semibold ">
                        Total Price: <span class="">{{ totalPrice }} DKK</span>
                    </p>
                </div>
            </div>
      </div>
    </div>
</template>



<style scoped>
.background {
    height: 100%;
    min-height: 100vh;
    background-color: var(--light-grey);
}
.itemprice .medium-text{
    margin-top: 20px;
}

.totalprice{
    padding-top: 10px;
    border-radius: 1px;
    border-top: solid 3px #3e52b6;
    z-index: 2;
}

h1{
    margin-bottom: 0px;
}

.big-display-1{
    border-bottom:  solid 3px #3e52b6;
}

.rowline{padding-top:10px;

    border-bottom: solid 2px var(--grey)
    /* margin-bottom:10px */
}

/* .text-normal{
      white-space: nowrap;
} */
.text-small{
    font-size: 1rem;
  white-space: nowrap;
}
.item-details{
    min-width: 150px;
}

.item-details .marginsmall{
padding-left:10px;
padding-top: 10px;

}
  .margin{

    margin-top: auto;

               
} 

.last-row .rowline {
  border-bottom: unset;
}
/* .firstchild .rowline:last-child:last-of-type {
  margin: 100px;
} */

.img-wrapper{
    height: 80px;
    width: 80px;
    margin-bottom:10px;
}
.list-img{
    height: 100%;
    width: 100%;
    object-fit: cover;
}
.offset-right{
    margin-right: 16.33%;
    margin-left: 8.33%;
}

.overflow{
    overflow-y: hidden;
    width:100%;
}
/* .product-info p {
    align-items: baseline;
} */
.semi-big-text-padding {
    padding-top: 10%;
}

.text-medium {
    width: 25%;
}
.text-normal p{
font-size: 1.2rem !important;
}


.filterButton:hover {
    cursor: pointer;
}

.underline {
    text-decoration: underline;
}

.info{
    padding-bottom:3px;
}
@media only screen and (max-width: 991px) {

     .margin{
    /* margin-top: auto; */
margin-left: 0px;
padding-left: 0px;
     }
}

@media only screen and (max-width: 575px) {

.info{
    margin-left:90px
}
}


</style>
<script>
import Configuration from '@/Components/Configuration.vue'
import navbar from '@/Layouts/Navbar.vue'
import prices from '@/FunctionExports/prices.js'
import { getImgPath } from '@/FunctionExports/getImgPath.js'
export default {
    components: {
        navbar
    },

    props: {
        test: Object
    },

    data() {
        return {
            lastIndex: null,
            configurations: [],
            size: 'all',
            components: {},
            componentIds: [],
            componentData: [],
            totalPrice: [],
            populatedList :[]
        }
    },

    methods: {
          setLastIndex(index) {
            this.lastIndex = index;
        },

        async getComponentList() {
            try {
                const response = await axios.get(
                    route('configuration.configurationBySession')
                )
                const session = await response.data.sessionData

                this.components = session.models
                const componentIds = session.componentIds
                this.populateList(componentIds)
                this.totalPrice = await prices(componentIds)
            } catch (error) {
                console.error(error)
                return null
            }
        },

   async populateList(componentIdArr) {

    // Create an array of promises for each fetchPrice call
    const fetchPromises = componentIdArr.map((componentId) =>
        this.fetchInfo(componentId)
    )

    // Wait for all promises to resolve 
    const fetchedPrices = await Promise.all(fetchPromises)

    // Add the fetched prices to the componentPrices array
    this.populatedList.push(...fetchedPrices)
    let sum = 0
    // sum must be declared as number, otherwise NaN error

},
        async fetchInfo(componentId) {
            const componentInfo = {
                category: '',
                price: '',
                fabricColor: {},
                type: '',
                url:''
            }
        const response = await axios.get(route('configuration.componentById'), {
        params: {
            id: componentId
        }
    })

        const component = await response.data.component
        componentInfo.category = this.getCategory(component.category)
        componentInfo.type = capitalize(component.type)
        componentInfo.price = component.price
        componentInfo.fabricColor = this.getFabricColor(component.file_name)
        componentInfo.url = component.file_name
        componentInfo.url = getImgPath(component.type,component.category,component.file_name)
        function capitalize(string) {
                return string.substring(0, 1).toUpperCase() + string.substring(1);
            }
        
        return componentInfo

},





        getFabricColor(filename) {
            const fabric = {
                texture: '',
                color: ''
            }
            switch (filename) {
                case 'BLACK_177_OLENA_LIGHT_GREY.glb':
                    fabric.texture = 'olena fabric'
                    fabric.color = 'light grey'
                    break
                case 'BLACK_207_VELOUR_LUX_PETRO.glb':
                    fabric.texture = 'velour'
                    fabric.color = 'lux petro green'
                    break

                case 'BLACK_239_DANNY_INDIGO_BLUE.glb':
                    fabric.texture = 'coarse cotton'
                    fabric.color = 'Danny indigo blue'
                    break
                case 'BLACK_277_FORM_CREAM.glb':
                    fabric.texture = 'wool dream'
                    fabric.color = 'form cream'
                    break
            }

            return fabric
        },
        getCategory(category) {
            let output
            switch (category) {
                case '1_SEATER':
                    output = '1 Seater'
                    break
                case '1_SEATER_BIG':
                    output = '1 Seater'
                    break
                case '2_SEATER':
                    output = '1 Seater'
                    break
                case 'CHAISE_LEFT':
                    output = 'Left chaiselong '
                    break
                case 'CHAISE_RIGHT':
                    output = 'Right chaiselong'
                    break
                case 'CORNER':
                    output = 'Corner'
                    break
                case 'CORNER_LEFT':
                    output = 'Corner'
                    break
                case 'CORNER_LEFT_BIG':
                    output = 'Corner'
                    break
            }
            return output
        }
    },
    mounted() {
        this.getComponentList()
    }
}




</script>
