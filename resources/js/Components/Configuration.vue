<template>



 
    <div class="containerCanvas">
        <canvas class="draw"> </canvas>

    </div>


</template>

<style scoped>
/* .containerCanvas{
    cursor: col-resize;
} */
.menubar{
        background-color: transparent !important;
}


.containerCanvas {
    width: 500px;
    height: 500px;
    display: flex;
    justify-content: center;
    align-items: center;
    overflow: hidden;
}

.draw {
    width: 100vw;
    height: 100vh;
    z-index: 0;
}


</style>



<script>
import { isProxy, toRaw } from 'vue'


import * as THREE from 'three'
import { GLTFLoader } from 'three/addons/loaders/GLTFLoader.js'
import { OrbitControls } from 'three/addons/controls/OrbitControls.js'
// from functionExport folder
import { randomString } from '@/FunctionExports/randomString.js'


const scene = new THREE.Scene()
const gltfloader = new GLTFLoader()

let configurationObj = {
    models: [
        {
            url: 'filepath',
            position: {
                x: 0,
                y: 0
            },
            rotation: {},
            side: 'left'
        }
    ],
    componentIds: [],
}

function getModelsFromScene() {
    return scene.children.filter((child) => child.userData.isLoadedModel)
}





export default {


    mounted() {
        // const axesHelper = new THREE.AxesHelper(15)
        // scene.add(axesHelper)
        function onWindowResize() {
            camera.aspect = canvas.clientWidth / canvas.clientHeight
            camera.updateProjectionMatrix()
            renderer.setSize(canvas.clientWidth, canvas.clientHeight)
        }

        const canvas = document.querySelector('.draw')
        let width = canvas.clientWidth
        let height = canvas.clientHeight
        let aspect = width / height
        scene.background = new THREE.Color(0xededef)
        // scene.background = new THREE.Color(0xffffff)
        const camera = new THREE.PerspectiveCamera(75, aspect)
        camera.position.z = 0 // Move the camera backward along the z-axis
        camera.position.x = -15 // Move the camera to the left along the x-axis
        camera.position.y = -15
        camera.lookAt(0, 0, 0)
        const renderer = new THREE.WebGLRenderer({ canvas })
        renderer.setPixelRatio(window.devicePixelRatio) //sets same amount pixels as window
        renderer.setSize(width, height)

        const controls = new OrbitControls(camera, renderer.domElement)
        controls.target.set(0, 0.8, 0) //point its orbitting around
        controls.maxPolarAngle = Math.PI / 2.4 // Restrict the vertical rotation to 90 degrees
        controls.enableDamping = true;
        controls.dampingFactor = 0.15;
        controls.maxDistance = 80;    

        controls.update()

        const ambientLight = new THREE.AmbientLight(0xffffff, 0.1) // Color: white, Intensity: 0.5
        scene.add(ambientLight)

        const dimIntensity = 1.5 // Adjust the intensity to control the dimness

        // Light 1
        const directionalLight1 = new THREE.DirectionalLight(
            0xffffff,
            dimIntensity
        )
        directionalLight1.position.set(200, 10, 0)
        directionalLight1.target.position.set(0, 0, 0) // Set the target position to the center of the scene
        scene.add(directionalLight1)

        // Light 2
        const directionalLight2 = new THREE.DirectionalLight(
            0xffffff,
            dimIntensity
        )
        directionalLight2.position.set(0, 10, 200)
        directionalLight2.target.position.set(0, 0, 0)
        scene.add(directionalLight2)

        // Light 3
        const directionalLight3 = new THREE.DirectionalLight(
            0xffffff,
            dimIntensity
        )
        directionalLight3.position.set(-200, 10, 0)
        directionalLight3.target.position.set(0, 0, 0)
        scene.add(directionalLight3)

        // Light 4
        const directionalLight4 = new THREE.DirectionalLight(
            0xffffff,
            dimIntensity
        )
        directionalLight4.position.set(0, 10, -200)
        directionalLight4.target.position.set(0, 0, 0)
        scene.add(directionalLight4)

        // Light 5
        const directionalLight5 = new THREE.DirectionalLight(0xffffff, 1.5)
        directionalLight5.position.set(0, 11100, 0) // Positioned above the floor
        directionalLight5.target.position.set(0, 0, 0)
        scene.add(directionalLight5)
        //mouse raycasting

        // FLOOR0xffffff
        let floor = new THREE.Mesh(
            new THREE.BoxBufferGeometry(1000, 0.01, 1000),
            new THREE.MeshBasicMaterial({ color: 0xe5e5e7 })
                        // new THREE.MeshBasicMaterial({ color: 0xffffff })
        )
        floor.isDraggable = false
        floor.receiveShadow = false
        // floor.receiveShadow = true;
        scene.add(floor)

        //Moves furniture around
        const raycaster = new THREE.Raycaster()
        let clickMouse = new THREE.Vector2()
        let moveMouse = new THREE.Vector2()
        this.dragModelListener(
            raycaster,
            clickMouse,
            moveMouse,
            camera,
            scene,
            controls,
            this.latestModel,
            this.updateModel
        )
        window.addEventListener('resize', onWindowResize, false)

        function animate() {
            renderer.render(scene, camera)
            window.requestAnimationFrame(animate)
        }

        animate()

        const { models, componentIds } = this.loadSessionObject(
            this.sessionData
        )
        configurationObj.models = [...models]
        configurationObj.componentIds = [...componentIds]
        this.loadSession(configurationObj, this.color)
    },
    unmounted() {
        this.$emit('updateConfiguration', configurationObj)
    },

    props: {
        sessionData: Object,
        position: Object,
        addFurniture: Object,
        color: String,
        type: String
    },
    data() {
        return {

            isVisible: false,
            modelsLeft: [],
            modelsRight: [],
            firstModel: [],
            connectionCornerLeft: false,
            latestModel: []
        }
    },



    methods: {








        updateModel(id, rotY, x, z) {

            const proxyObject = configurationObj.models
            let modelToUpdate

            const models = toRaw(proxyObject)
            modelToUpdate = Object.keys(models)
                .map((key) => models[key])
                .find((obj) => obj && obj.idString === id)



            if (modelToUpdate) {
                modelToUpdate.rotation.y = rotY
                modelToUpdate.position.x = x
                modelToUpdate.position.z = z
            }
            this.$emit('updateConfiguration', configurationObj)
        },


        loadSessionObject(session) {
            if (session) {
                console.log("the session",session)
                this.$emit('updateConfiguration', session)
                const { models, componentIds } = session
                // nullish coalescing operator: ??
                // If models is null or undefined, the operator returns an empty array
                return {
                    models: models ?? [],
                    componentIds: componentIds ?? []
                }
            }

            return {
                models: [],
                componentIds: []
            }
        },

        async loadSession(session, color, reloadColor) {

            for (let i = 0; i < session.models.length; i++) {
                const model = session.models[i]
                let filepath = model.url

                if (reloadColor) {

                    const parts = filepath
                        .split('/')
                        .filter((part) => part !== '')
                    const firstThree = parts.slice(0, 3)
                    const updatedParts = [...firstThree, color]
                    const result = updatedParts.join('/')
                    filepath = result;


                }
                const posx = model.position.x
                const posy = model.position.y
                const posz = model.position.z
                const idString = model.idString

                const rotationY = model.rotation.y

                let glb_model = await gltfloader.load(filepath, (glb) => {

                    glb_model = glb.scene
                    glb_model.userData.isLoadedModel = true
                    glb_model.isDraggable = true
                    glb_model.position.z = posy
                    glb_model.position.x = posx
                    glb_model.position.z = posz
                    glb_model.rotation.y = rotationY
                    glb_model.userData.idString = idString

                    glb_model.traverse((node) => {
                        if (node.isMesh) {
                            node.castShadow = true
                        }
                    })

                    for (let i = 0; i < glb_model.children.length; i++) {
                        const child = glb_model.children[i]
                        child.scale.set(5, 5, 5)
                    }
                    const box = new THREE.Box3().setFromObject(glb_model)
                    glb_model.userData.boundingBox = box
                    scene.add(glb_model)
                })
            }
        },
        // checkIfCornerModule(connection, side){
        //     if (connection && side === "left"){
        //         this.connectionCornerLeft.push(true);
        //         console.log(this.connectionCornerLeft);
        //     }
        // },


        async loadData(
            posx,
            posy,
            posz,
            url,
            componentId,
            side,
            type,
            connection,
            maxTries = 7,
            currentTry = 1
        ) {
            let glb_model
            const id = randomString(7)
            const cutOff = url.split('/assets')
            const filepath = `/assets${cutOff[1]}`
            const model = {
                url: filepath,
                position: {
                    x: posx,
                    y: posy,
                    z: posz
                },
                rotation: {
                    x: 0,
                    y: 0,
                    z: 0
                },
                side,
                sideOrder: undefined,
                firstModelPlaced: false,
                type,
                connection,
                idString: id
            }

            // const modelsOnScene = getModelsFromScene();

            try {
                let glb_model = gltfloader.load(filepath, (glb) => {
                    glb_model = glb.scene
                    glb_model.userData.isLoadedModel = true
                    if (connection) {
                        glb_model.userData.isCornerConnector = true
                    } else {
                        glb_model.userData.isCornerConnector = false
                    }
                    glb_model.isDraggable = true
                    glb_model.traverse((node) => {
                        if (node.isMesh) {
                            node.castShadow = true
                        }
                    })
                    for (let i = 0; i < glb_model.children.length; i++) {
                        const child = glb_model.children[i]
                        child.scale.set(5, 5, 5)
                    }

                    const box = new THREE.Box3().setFromObject(glb_model)

                    glb_model.userData.boundingBox = box
                    glb_model.userData.idString = id

                    const howManyModels = getModelsFromScene()
                    try{
                   
                    if (howManyModels == 0) {
                        const posx = model.position.x
                        const posz = model.position.z
                        glb_model.position.x = posx
                        glb_model.position.z = posz
                        scene.add(glb_model)
                        model.firstModelPlaced = true
                        this.firstModel.push(glb_model)
                        configurationObj.models.push(model)
                        configurationObj.componentIds.push(componentId)
                        this.savePosition(model, glb_model)
                        this.$emit('updateConfiguration', configurationObj)
                    } // make collision test if there is  more that 1 loaded model
                    else if (side === 'left') {
                        this.saveLeft(model, glb_model)

                        scene.add(glb_model)
                        this.modelsLeft.push(glb_model)
                        configurationObj.models.push(model)
                        configurationObj.componentIds.push(componentId)

                        this.$emit('updateConfiguration', configurationObj)
                    } else if (side === 'right') {
                        this.saveRight(model, glb_model)
                        scene.add(glb_model)
                        this.modelsRight.push(glb_model)
                        configurationObj.models.push(model)
                        configurationObj.componentIds.push(componentId)
                        this.$emit('updateConfiguration', configurationObj)
                    } else if (side === 'rightCorner') {
                        this.saveRightCorner(model, glb_model)
                        scene.add(glb_model)
                        this.modelsRight.push(glb_model)
                        configurationObj.models.push(model)
                        configurationObj.componentIds.push(componentId)
                        this.$emit('updateConfiguration', configurationObj)
                    } else if (side === 'leftCorner') {
                        this.saveLeftCorner(model, glb_model)
                        scene.add(glb_model)
                        this.modelsLeft.push(glb_model)
                        configurationObj.models.push(model)
                        configurationObj.componentIds.push(componentId)
                        this.$emit('updateConfiguration', configurationObj)
                    }
                    this.latestModel[0] = glb_model
                    }catch(error){
                            console.log(side,"side");
                            const furthestLeftModel = this.getPos()
                            // Calculate the position for the new model
                            const newModelPosX =
                                furthestLeftModel.position.x -
                                furthestLeftModel.userData.boundingBox.max.x +
                                glb_model.userData.boundingBox.min.x

                            const newModelPosZ =
                                furthestLeftModel.position.z
                            furthestLeftModel.userData.boundingBox.max.z +
                                glb_model.userData.boundingBox.min.z
                            // Set the position of the new model
                            glb_model.position.set(newModelPosX, posy, newModelPosZ)

                            configurationObj.models.push(model)
                            configurationObj.componentIds.push(componentId)
                            // Add the new model to the scene
                            scene.add(glb_model)
                            this.latestModel[0] = glb_model
                        }
                        

                    
                    
                })
                return glb_model
            } catch (error) {

            }
        },

        savePosition(model, glb_model, sideOrder) {
            const z = glb_model.position.z
            const x = glb_model.position.x
            const y = glb_model.position.y
            const rotY = glb_model.rotation.y
            model.position.z = z
            model.position.x = x
            model.position.y = y
            model.rotation.y = rotY
        },

        getModelSize(model) {
            const maxX = model.userData.boundingBox.max.x
            const minX = model.userData.boundingBox.min.x
            const maxZ = model.userData.boundingBox.max.z
            const minZ = model.userData.boundingBox.min.z
            const len =
                model.userData.boundingBox.max.x -
                model.userData.boundingBox.min.x
            const width =
                model.userData.boundingBox.max.z -
                model.userData.boundingBox.min.z

            return { len, width, maxX, minX, maxZ, minZ }
        },

        saveConnectionCorner(model, glb_model, side) {
            console.log('side', side)
            let radians = Math.PI / 2
            let positionArr = []
            if (side === 'right') {
                const latestAdded = this.modelsRight.slice(-1)

                positionArr.push(this.getModelSize(latestAdded[0]))
                positionArr.push(latestAdded[0].position)

                glb_model.rotation.y -= radians
                glb_model.position.z = positionArr[0].width + positionArr[1].z
                glb_model.position.x = -positionArr[0].maxX
            } else if (side === 'left') {

                if (this.modelsLeft === 0) {
                    positionArr.push(this.getModelSize(this.firstModel[0]))
                    positionArr.push(this.firstModel[0].position)
                    glb_model.position.z =
                        positionArr[1].z - positionArr[0].width
                }
                const latestAdded = this.modelsLeft.slice(-1)
                positionArr.push(this.getModelSize(latestAdded[0]))
                positionArr.push(latestAdded[0].position)
                glb_model.position.z = positionArr[1].z - positionArr[0].width
            }

            this.savePosition(model, glb_model)
        },
        saveLeft(model, glb_model) {
            let positionArr = []
            const { len, width } = this.getModelSize(glb_model)
            if (this.modelsLeft.length === 0) {
                positionArr.push(this.getModelSize(this.firstModel[0]))
                positionArr.push(this.firstModel[0].position)
                glb_model.position.z = positionArr[1].z - positionArr[0].width
            } else if (this.modelsLeft.length > 0) {
                const latestAdded = this.modelsLeft.slice(-1)

                if (latestAdded[0].userData.isCornerConnector) {
                    this.connectionCornerLeft = true
                    console.log(
                        'saveLeft',
                        latestAdded[0].userData
                    )
                }
                if (this.connectionCornerLeft) {
                    positionArr.push(this.getModelSize(latestAdded[0]))
                    positionArr.push(latestAdded[0].position) // x y z
                    glb_model.rotation.y += Math.PI / 2
                    glb_model.position.x = positionArr[1].x - width
                    glb_model.position.z = positionArr[1].z
                } else {
                    positionArr.push(this.getModelSize(latestAdded[0]))
                    positionArr.push(latestAdded[0].position)
                    glb_model.position.z =
                        positionArr[1].z - positionArr[0].width
                }
            }

            this.savePosition(model, glb_model)
        },

        saveRight(model, glb_model, connector) {
            let sideOrder
            let positionArr = []

            if (this.modelsRight.length === 0) {
                positionArr.push(this.getModelSize(this.firstModel[0]))
                positionArr.push(this.firstModel[0].position)
                glb_model.position.z = positionArr[0].width + positionArr[1].z
                sideOrder = 0
            } else if (this.modelsRight.length > 0) {
                const latestAdded = this.modelsRight.slice(-1)
                positionArr.push(this.getModelSize(latestAdded[0])) //width len max, min
                positionArr.push(latestAdded[0].position) // x y z
                glb_model.position.z = positionArr[0].width + positionArr[1].z

                sideOrder = this.modelsRight.length + 1
            }

            this.savePosition(model, glb_model, sideOrder)
        },

        saveRightCorner(model, glb_model) {
            let radians = Math.PI
            let positionArr = []
            if (this.modelsRight.length === 0) {
                positionArr.push(this.getModelSize(this.firstModel[0]))
                positionArr.push(this.firstModel[0].position)
                glb_model.rotation.y -= radians
                glb_model.position.z = positionArr[0].width + positionArr[1].z
                glb_model.position.x = -positionArr[0].maxX
            } else if (this.modelsRight.length > 0) {
                const latestAdded = this.modelsRight.slice(-1)
                positionArr.push(this.getModelSize(latestAdded[0]))
                positionArr.push(latestAdded[0].position)
                glb_model.rotation.y -= radians
                glb_model.position.z = positionArr[0].width + positionArr[1].z
                glb_model.position.x = -positionArr[0].maxX
            }

            this.savePosition(model, glb_model)
        },

        saveLeftCorner(model, glb_model) {
            // let radians = Math.PI;
            let positionArr = []
            if (this.modelsLeft.length === 0) {
                positionArr.push(this.getModelSize(this.firstModel[0]))
                positionArr.push(this.firstModel[0].position)
                glb_model.position.z = positionArr[1].z - positionArr[0].width
                // glb_model.rotation.y -= radians;
                glb_model.position.x = positionArr[0].minX
            } else if (this.modelsLeft.length > 0) {
                const latestAdded = this.modelsLeft.slice(-1)
                positionArr.push(this.getModelSize(latestAdded[0]))
                positionArr.push(latestAdded[0].position)
                glb_model.position.z = positionArr[1].z - positionArr[0].width

                glb_model.position.x = -positionArr[0].minX
            }

            this.savePosition(model, glb_model)
        },

        getPos() {
            let children = getModelsFromScene()
            let furthestLeftModel = null
            let furthestRightModel = null
            let rightPos = {}
            let leftPos = {}
            let leftDiemensions = {}
            let rightDimensions = {}
            console.log("children get pos",children);
            children.forEach((child) => {
                console.log("child get pos",child.userData)
                const { len, width, maxX, minX, maxZ, minZ } =
                    this.getModelSize(child)
                const { x, y, z } = child.position

                // Check if this model is the furthest to the left
                if (
                    furthestLeftModel === null ||
                    x < furthestLeftModel.position.x
                ) {
                    furthestLeftModel = child
                    leftDiemensions = { len, width, maxX, minX, maxZ, minZ }
                    leftPos = { x, y, z }
                }

                // Check if this model is the furthest to the right
                if (
                    furthestRightModel === null ||
                    x > furthestRightModel.position.x
                ) {
                    furthestRightModel = child
                    rightDimensions = { len, width, maxX, minX, maxZ, minZ }
                    rightPos = { x, y, z }
                }
            })
            console.log('Furthest Left Model:', furthestLeftModel.position)
            // console.log('Furthest Left postion:', leftPos)
            // console.log('Furthest Left Dimensions:', leftDiemensions)
            // console.log('Furthest Right Model:', furthestRightModel)
            // console.log('Furthest Right position:', rightPos)
            // console.log('Furthest Right dimensions:', rightDimensions)
            return furthestLeftModel
            // Check if this model is the furthest to the left


        },
        dragModelListener(
            raycaster,
            clickMouse,
            moveMouse,
            camera,
            scene,
            controls,
            latestModel,
            updateModel
        ) {
            let draggableModel;
            let isColliding = false; // Flag to track collision status
            let collidedObject; // Variable to store the collided object
            let cursorGrab;
            let dotPlaced = false;
            let dotcheck = true;
            let savedRotation = {};
            let savedPosition = {};

            function throttle(func, delay) {
                let timerId = null;
                let lastExecuted = 0;

                return function (...args) {
                    const now = Date.now();
                    const elapsedTime = now - lastExecuted;

                    if (!timerId && elapsedTime > delay) {
                        func.apply(this, args);
                        lastExecuted = now;
                    } else if (!timerId) {
                        timerId = setTimeout(() => {
                            func.apply(this, args);
                            lastExecuted = Date.now();
                            timerId = null;
                        }, delay - elapsedTime);
                    }
                };
            }

            // Wrap the dragModel function with the throttle function
            const throttledDragModel = throttle(dragModel, 30);

            let dot = document.querySelector('.center-dot');

            // Add event listener to detect Shift key press/release
            const selectionBar = document.querySelector(".selection-bar-wrapper")
            window.addEventListener('touchstart', function (event) {
                handleClick(event, touchCoordinate);
            });
            window.addEventListener('touchmove', function (event) {
                handleMove(event, touchCoordinate);
            });
            window.addEventListener('touchend', handleClickEnd);

            window.addEventListener('mousedown', function (event) {
                handleClick(event, mouseCoordinate);
            });
            window.addEventListener('mousemove', function (event) {
                handleMove(event, mouseCoordinate);
            });

            window.addEventListener('mouseup', handleClickEnd);
            function touchCoordinate(event){
                let touchPosition = { 
                    x: (event.touches[0].clientX / window.innerWidth) * 2 - 1,
                    y: -(event.touches[0].clientY / window.innerHeight) * 2 + 1
                }
                return touchPosition
            }
            function mouseCoordinate(event) {
                let mousePosition = {
                    x: (event.clientX / window.innerWidth) * 2 - 1,
                    y: -(event.clientY / window.innerHeight) * 2 + 1
                }
                return mousePosition
            }  
            function handleClick(event, pointerPosition) {

                let targetElement = event.target;
                while (targetElement !== null) {
                    if (targetElement === selectionBar) {
                        return; // Do not run code if clicked on draggableDiv or its children
                    }
                    targetElement = targetElement.parentElement;
                }

                const {x, y} = pointerPosition(event)
                clickMouse.x = x
                clickMouse.y = y
                raycaster.setFromCamera(clickMouse, camera);
                const found = raycaster.intersectObjects(scene.children, true);
                if (found.length) {
                    let current = found[0].object;
                    while (current.parent.parent !== null) {
                        document.body.classList.add('cursor-grab');
                        current = current.parent;
                    }
                    if (current.isDraggable) {
                        draggableModel = current;
                        latestModel[0] = current;
                        controls.enabled = false;
                        dotPlaced = false;
                        document.body.classList.remove('cursor-grab');
                        document.body.classList.add('cursor-grabbing');
                    }
                }
            }

            function handleMove(event, pointerPosition) {
                let targetElement = event.target;
                while (targetElement !== null) {
                    if (targetElement === selectionBar) {
                        return; // Do not run code if clicked on draggableDiv or its children
                    }
                    targetElement = targetElement.parentElement;
                }

                const { x, y } = pointerPosition(event)
  
                moveMouse.set(
                    x,
                    y
                );
                // console.log(moveMouse.x, moveMouse.y);

                raycaster.setFromCamera(moveMouse, camera);
                let collisions = raycaster.intersectObjects(scene.children, true);
                if (collisions.length) {
                    let target = collisions[0].object;
                    while (target.parent.parent !== null) {
                        target = target.parent;
                    }
                    if (target.isDraggable) {
                        controls.enabled = false;
                        cursorGrab = true;
                        dotcheck = true;
                        if (cursorGrab) {
                            document.body.classList.add('cursor-grab');
                        }
                    } else {
                        controls.enabled = true;
                        cursorGrab = false;
                        dotcheck = false;
                        document.body.classList.remove('cursor-grab');
                    }
                }
                dragModel();
            }

            function handleClickEnd(event) {
                

                if (draggableModel) {
                    savedRotation = draggableModel.rotation.clone();
                    savedPosition = draggableModel.position.clone();
                    updateModel(
                        draggableModel.userData.idString,
                        savedRotation.y,
                        savedPosition.x,
                        savedPosition.z
                    );
                }
                draggableModel = undefined;
                isColliding = false;
                collidedObject = undefined;
                controls.enabled = true;
                document.body.classList.remove('cursor-grabbing');
            }



            function dragModel() {
                if (draggableModel) {
                    const found = raycaster.intersectObjects(scene.children);
                    if (found.length > 0) {
                        // Check for collisions with other draggable objects
                        for (const child of scene.children) {
                            if (child.isDraggable && child !== draggableModel) {
                                if (
                                    draggableModel.userData.boundingBox.intersectsBox(
                                        child.userData.boundingBox
                                    )
                                ) {
                                    // Handle collision
                                }
                            }
                        }

                        if (!isColliding) {
                            // Move the model to the new position

                            const obj3d = found[0];
                            draggableModel.position.x = obj3d.point.x;
                            draggableModel.position.z = obj3d.point.z;
                            draggableModel.userData.boundingBox.setFromObject(
                                draggableModel
                            ); // Reassign bounding box

                            collidedObject = obj3d.object; // Store the collided object
                        }
                    }
                }
            }
        },

        selectedModel() {
            console.log(this.latestModel)
        },

         deleteThisModel(model) {
            deleteModel(model)
            this.$emit('updateConfiguration', configurationObj)
        }

        //end bracket
    }
}
</script>

<!-- function collision(scene, box) {
    let isColliding = false;
    scene.traverse(model => {
        if (model.userData.isLoadedModel && model.userData && model.userData.boundingBox) {
            if (model.userData.boundingBox.intersectsBox(box)) {
                isColliding = true;

            }
        }
    });
    return isColliding;
} -->
