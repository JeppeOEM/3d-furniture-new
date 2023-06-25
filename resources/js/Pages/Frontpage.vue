<template class="background">


    <div class="background-svg">
        <navbar></navbar>
        <div class="container ">
            <div class="d-flex  flex-column justify-content-center">
                <i>
                    <p class="text-big top-pad presents text-sm-center">
                        cubicraft software presents
                    </p>
                </i>

                <h1 class="big-display-1 fw-semibold  darkblue ubuntu text-sm-center ">The 3d Furniture Planner</h1>
                <p class="semi-big-text ubuntu text-sm-center">
                    Make use of all three dimensions when showcasing your products, and create a visual immersive experience
                    for your custormers.
                </p  >
<!-- 
                <span class="text-sm-center text-medium">
    Try what the latest 3D innovations in web browsers can do to your products.<br>
                                    We have crafted a 3d editor not only packed with functionality but tailored for a pleasant user
                                    experience.<br> By rigorous testing, and commitment to detail we have created a furniture platform for the future.
                </span> -->
                <!-- <div class="text-left col-md-8 offset-1 col-lg-10 mx-auto">
                                        <p class="text-normal">
                                Try what the latest 3D innovations in web browsers can do to your products.<br>
                                We have crafted a 3d editor not only packed with functionality but tailored for a pleasant user
                                experience.<br> By rigorous testing, and commitment to detail we have created a furniture platform for the future.
                            </p>
                </div> -->
            </div>
            <div class="padbtn text-center">
                <a class="btnorange" :href="route('planner')">Try the platform</a>
            </div>

        </div>
       <div class="container">
            <div class="row listrow justify-content-center">
                <div class="col-12 col-lg-6 box1 d-flex align-items-center justify-content-center">
                    <div class="list-bg">

                    <ul class="ubunutu">
                        <li class="medium-text">
                                Ready to be integrated with existing webshop
                        </li>
                        <li class="medium-text">
                            Made for mobile and desktop
                        </li>
                        <li class="medium-text">
                            Lets customers save a configuration and view it later
                        </li>
                        <li class="medium-text">
                            Lets customers share configuration by sending a link
                        </li>
                        <li class="medium-text">
                            Move furniture around with the mouse
                        </li>
                         <li class="medium-text">
                            Rotate the screen in 360 degrees 
                        </li>
                    </ul>
                            
                        </div>
                </div>

                <div>
                    <img src="" alt="">
                </div>
            </div>
        </div>
    
    <div class="container">
        <div class="row justify-content-center">
            <div class="logobottom col-10 text-center">
                <!-- <img src="assets/logo.svg" class="img-fluid" style="width: 35px;" alt="Your Image"> -->
            </div>

                    <div class="p-2 d-flex justify-content-center align-items-center">
                        <span>© cubicraft 2023, glb models licensed from Pandiweb</span>
                    </div>
            </div>

        </div>
    </div>
</template>

<style scoped>

.logobottom{
    margin-top:50px
}
.box1 {

}

@media screen and (max-width: 768px) {
    .box1 {
        margin-right: unset;
        transform: unset;
    }
}

.margin-left {
    margin-left: 50px;
}

.pad-list {
    padding-top: 40px;
}

.semi-big-text {
    padding-left: 10%;
    padding-right: 10%;

}

.logo {
    width: 10%;
}

.padbtn {
    padding-top: 40px;
    padding-bottom: 40px;
}

.presents {
    color: #fa703e;
    margin-bottom: 0rem;
}


.text-medium{
    font-weight: 400;
}
.text-medium-smaller {
    font-size: 1.4rem;
        font-family: 'Ubuntu', sans-serif;
}

.semi-big-text-pad {
    color: #29637e;
}

.background-svg {
    height: 100%;
    background-color: var(--light-grey);
    background-repeat: no-repeat;
    background-position: center;
    background-image: url('/assets/halfcircle.svg');

    background-repeat: no-repeat;
    background-size: cover;
    background-position: center bottom;
}

.section-wrapper {
    position: relative;
}

.filterButton:hover {
    cursor: pointer;
}

.underline {
    text-decoration: underline;
}
.list-bg{
        background-color: rgba(255, 255, 255, 0.65);
            font-size: 1.4rem;
    border-radius: 10px;
    padding: 20px;
    padding-bottom: 5px;

    margin-bottom: 20px;
}
@media only screen and (max-width: 992px) {
.text-big {
    padding-left: 0px;
    padding-right: 0px;
    font-size: 1.2rem;
}

.semi-big-text {
    padding-left: 0px;
    padding-right: 0px;

}

.text-medium-smaller {
    font-size: 1.2rem;
        font-family: 'Ubuntu', sans-serif;
}

.listrow{
    margin:10px
}
.presents {
    color: #fa703e;
    margin-bottom: 0rem;
    font-size: 1.4rem;
}




.text-medium-smaller {
    font-size: 1.4rem;
        font-family: 'Ubuntu', sans-serif;
}

}@media only screen and (max-width: 992px) {


}

</style>

<script>
import Navbar from '@/Layouts/Navbar.vue'
export default {
    components: {
    Navbar,
},
    data() {
        return {};
    },
    methods: {},
    mounted() { }
}
</script>