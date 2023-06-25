<template class="">
    <div class="background overflow">
        <navbar></navbar>
        <div class="container-fluid container-lg">


        </div>
    </div>
</template>



<style scoped>
.itemprice .text-normal {
    margin-top: 20px;
}

.totalprice {
    border-radius: 1px;
    border-top: solid 3px #3e52b6;
    z-index: 2;
}

h1 {
    margin-bottom: 0px;
}

.big-display-1 {
    border-bottom: solid 3px #3e52b6;
}

.rowline {
    padding-top: 10px;

    border-bottom: solid 2px var(--grey)
        /* margin-bottom:10px */
}

/* .text-normal{
      white-space: nowrap;
} */
.text-small {
    font-size: 1rem;
    white-space: nowrap;
}

.item-details {
    min-width: 150px;
}

.item-details .marginsmall {
    padding-left: 10px;

}

.margin {

    margin-top: auto;


}

.last-row .rowline {
    border-bottom: unset;
}

/* .firstchild .rowline:last-child:last-of-type {
  margin: 100px;
} */

.img-wrapper {
    height: 80px;
    width: 80px;
    margin-bottom: 10px;
}

.list-img {
    height: 100%;
    width: 100%;
    object-fit: cover;
}

.offset-right {
    margin-right: 16.33%;
    margin-left: 8.33%;
}

.background {
    height: 100%;
    min-height: 100vh;
    background-color: var(--light-grey);
}

.overflow {
    overflow-y: hidden;
    width: 100%;
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

.text-normal p {
    font-size: 1.2rem !important;
}


.filterButton:hover {
    cursor: pointer;
}

.underline {
    text-decoration: underline;
}

.info {
    padding-bottom: 3px;
}

@media only screen and (max-width: 991px) {

    .margin {
        /* margin-top: auto; */
        margin-left: 0px;
        padding-left: 0px;
    }
}

@media only screen and (max-width: 575px) {

    .info {
        margin-left: 90px
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
            populatedList: []
        }
    },

    methods: {

    },
    mounted() {
        this.getComponentList()
    }
}




</script>
