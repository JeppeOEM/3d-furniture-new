<template>
    <div class="background">
        <navbar></navbar>
        <div class="container">
            <h1 class="big-display-1 ubuntu fw-semibold top-pad darkblue">
                Furniture Planner
            </h1>
            <div class="row">
                <div class="col-12 col-lg-8">
                    <p class="text-big">
                        Choose one of the modular sofa configurations or start
                        with a blank canvas.
                    </p>
                    <div class="col-12 col-md-9">
                        <p class="text-normal">
                            The product planner lets you get creative with your
                            future sofa. <br>
                            Choose diffrent fabrics combinations and furniture pieces then save it for later or share it
                            with your freinds.<br>
                        </p>

                        <!-- <div class="d-inline d-lg-none">
                            <a class="square-button2" :href="route('editor')">Start with a blank canvas</a>
                        </div> -->
                    </div>
                </div>
                <div></div>
                <div class=" ">
                    <div class="col-12 d-flex justify-content-between">
                        <p class="medium-text" @click="getAll('')">All</p>
                        <p class="medium-text" @click="getRows('2seater')">
                            2 Seater
                        </p>
                        <p class="medium-text" @click="getRows('3seater')">
                            3 Seater
                        </p>
                        <p class="medium-text" @click="getRows('corner')">
                            Corner
                        </p>
                        <a class="medium-text d-none d-lg-inline ms-auto" :href="route('editor')">Start with a blank
                            canvas</a>
                    </div>
                    <div class="wrapline gx-0">
                        <span class="line"></span>
                    </div>
                </div>
                <div class="row g-2 extra-pad">
                        <div class="d-lg-none col-6 col-sm-4 col-lg-3 gx-3 hover-img p-1 blankcanvas gutterstyle">
                            <a :href="route('editor')">
                                    <img src="/assets/white.png" class="img-fluid border-img" alt="Image" />
                                    <span class="canvas text-normal ubuntu">Blank canvas</span>
                            </a>
                        </div>
                    <div class="col-6 col-sm-4 col-lg-3 gx-3 hover-img p-1 gutterstyle"
                        v-for="item in configurations.rows" :key="item.id">
                        <a :href="route('editor.unique', {
                            uniqueValue: removeFileExtension(item.identifier)
                        })">
                                    <img :src="getAllImgPath(item.url)" class="img-fluid border-img" alt="Image" />
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
.hover-img img{
    border-radius: 5px;
}
.hover-img img:hover{
    
    border: solid 3px var(--blue);
}
  p {

margin-bottom: 1.8rem;
  } 

.blankcanvas{
position:relative;
}
.canvas{
    font-size: 1.025rem;
    position: absolute;
    color: black;
    border-radius: 5px;
    white-space: nowrap;
    padding:5px;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    /* border: solid  2px black */
}

.wrapline {
    display: flex;
    align-items: center;
    margin-bottom: 10px;
    padding: 0px;
}
.line {
    height: 5px;
    width: 100%;
    background-color: var(--blue);
    border-radius: 99px;
    margin-top: 10px;
}

    .extra-pad{
        padding-left: 10px;
            padding-bottom: 20px;
    }
    .gutterstyle{
        margin-top: 0px;
    
    }

.square-button2{

    margin-bottom: 20px;
    border-radius: 10px;
}

.medium-text{
    font-family: 'Ubuntu', sans-serif;
    cursor: pointer;
    padding-bottom: 0px;
    margin-bottom: 0px;
    font-weight: 600;
    margin-left:100px;
}
.medium-text:first-child {
    margin-left: 0px;
}
.medium-text:hover{
color: var(--blue);
}

.background {
    min-height: 100vh;
    height:100%;
    background-color: #f8f8f8;
}

.background-box{
    background-color: var(--black);
}
.border-img{
    border: 2px solid var(--grey);
}
.darkblue {
    color: var(--black);
}

.top-pad {
    padding-top: 5rem;
}

.padrow {
    padding-right: 15px;
}
.pad {
    padding-left: 15px;
    padding-bottom: 15px;
}
/* .hover-overlay::before{

    width: unset;
} */


@media screen and (max-width: 992px){
.medium-text{
    margin-left: 20px;
}
  p {

margin-bottom: 1.5rem;
  } 

}

</style>

<script>
import navbar from '@/Layouts/Navbar.vue'

export default {
    components: {
        navbar
    },
    data() {
        return {
            configurations: [],
            conf: [],
            type: 'dusk',
            size: '2seater',
            rows: []
        }
    },
    mounted() {
        this.getAll('all')
        this.getRows('all')
    },
    methods: {
        removeFileExtension(name) {
            let lastIndex = name.lastIndexOf('.')
            name = name.substring(0, lastIndex)
            return name
        },

        getAllImgPath(url) {
            var startIndex = url.indexOf('/assets/') 
            var modifiedUrl = url.substring(startIndex)
            const path = `${modifiedUrl}`
            return path
        },

        getRows(size) {
            axios
                .get(route('planner.show'), {
                    params: {
                        size,
                        type: this.type
                    }
                })
                .then((response) => {
                    this.configurations = response.data
                })
                .catch((error) => {
                    console.error(error)
                })
        },

        getAll() {
            axios
                .get(route('planner.all'))
                .then((response) => {
                                        this.configurations = response.data
                })
                .catch((error) => {
                    console.error(error)
                })
        }
    }
}
</script>

