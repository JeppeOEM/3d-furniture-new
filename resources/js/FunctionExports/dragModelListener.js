import * as THREE from 'three'
export function dragModelListener(
    raycaster,
    clickMouse,
    moveMouse,
    camera,
    scene,
    controls
) {
    let draggableModel
    let isColliding = false // Flag to track collision status
    let collidedObject // Variable to store the collided object
    let cursorGrab
    let dotPlaced = false
    let dotcheck = true
    let latestModel = []
    // Boolean variable to track Shift key state
    let isShiftPressed = false

    // Event listener function
    function handleShiftKey(event) {
        // Check if Shift key is being pressed or released
        if (event.shiftKey) {
            isShiftPressed = true
            controls.enabled = true
        } else {
            isShiftPressed = false
        }
    }

    let dot = document.querySelector('.center-dot')

    // Add event listener to detect Shift key press/release
    document.addEventListener('keydown', handleShiftKey)
    document.addEventListener('keyup', handleShiftKey)

    window.addEventListener('mousedown', (event) => {
        // if (draggableModel) {
        //     draggableModel = undefined;
        //     isColliding = false; // Reset collision status
        //     collidedObject = undefined; // Reset collided object
        //     return;
        // }
        // If NOT 'holding' model on-mousedown, set container to <object> to 'pickup' the model.
        clickMouse.x = (event.clientX / window.innerWidth) * 2 - 1
        clickMouse.y = -(event.clientY / window.innerHeight) * 2 + 1
        raycaster.setFromCamera(clickMouse, camera)
        const found = raycaster.intersectObjects(scene.children, true)
        if (found.length) {
            let current = found[0].object
            while (current.parent.parent !== null) {
                document.body.classList.add('cursor-grab')
                current = current.parent
                // console.log("current", current);
            }
            if (current.isDraggable) {
                draggableModel = current
                if (latestModel.length === 0) {
                    latestModel.push(current)
                }
                controls.enabled = false
                dotPlaced = false
                document.body.classList.remove('cursor-grab')
                document.body.classList.add('cursor-grabbing')
            }
        }
    })

    window.addEventListener('mousemove', (event) => {
        moveMouse.set(
            (event.clientX / window.innerWidth) * 2 - 1,
            -(event.clientY / window.innerHeight) * 2 + 1
        )
        raycaster.setFromCamera(moveMouse, camera)
        let collisions = raycaster.intersectObjects(scene.children, true)
        if (collisions.length) {
            let target = collisions[0].object
            //

            while (target.parent.parent !== null) {
                target = target.parent
            }
            if (target.isDraggable) {
                controls.enabled = false
                cursorGrab = true
                dotcheck = true

                // if (!dotPlaced) {
                //     dotPlaced = true;
                //     getDot(target, dot);
                //     dot.style.color = "red";
                // }
                if (cursorGrab) {
                    document.body.classList.add('cursor-grab')
                    // if (dotcheck) {
                    //     getDot(target, dot);
                    // }
                }
            } else {
                controls.enabled = true
                cursorGrab = false
                dotcheck = false
                document.body.classList.remove('cursor-grab')
            }
        }
        dragModel()
    })

    window.addEventListener('mouseup', (event) => {
        // on-mouseup to set container to <undefined> to 'drop' the model.
        draggableModel = undefined
        isColliding = false
        collidedObject = undefined
        controls.enabled = true
        document.body.classList.remove('cursor-grabbing')
    })

    function dragModel() {
        if (draggableModel) {
            const found = raycaster.intersectObjects(scene.children)
            if (found.length > 0) {
                // Check for collisions with other draggable objects
                for (const child of scene.children) {
                    if (child.isDraggable && child !== draggableModel) {
                        if (
                            draggableModel.userData.boundingBox.intersectsBox(
                                child.userData.boundingBox
                            )
                        ) {
                        }
                    }
                }

                if (!isColliding) {
                    // Move the model to the new position
                    const obj3d = found[0]
                    draggableModel.position.x = obj3d.point.x
                    draggableModel.position.z = obj3d.point.z
                    draggableModel.userData.boundingBox.setFromObject(
                        draggableModel
                    ) // Reassign bounding box

                    collidedObject = obj3d.object // Store the collided object
                }
            }
        }
    }
}

// Usage example
function getDot(model, dot) {
    console.log('dot')
    const length =
        model.userData.boundingBox.max.x - model.userData.boundingBox.min.x
    const width =
        model.userData.boundingBox.max.z - model.userData.boundingBox.min.z

    const centerX = model.userData.boundingBox.min.x + length / 2
    const centerZ = model.userData.boundingBox.min.z + width / 2

    const center = new THREE.Vector3(centerX, 0, centerZ)

    // Convert 3D coordinates to 2D screen coordinates
    const screenPosition = new THREE.Vector3()
    screenPosition.copy(center)
    screenPosition.project(camera)

    // Map screen coordinates to actual pixel values
    const screenWidth = window.innerWidth
    const screenHeight = window.innerHeight

    const screenX = ((screenPosition.x + 1) * screenWidth) / 2
    const screenY = ((-screenPosition.y + 1) * screenHeight) / 2

    console.log('Screen position:', screenX, screenY)
    dot.style.left = '0px'
    dot.style.top = '0px'

    const currentX = dot.offsetLeft
    const currentY = dot.offsetTop

    const newX = currentX + screenX
    const newY = currentY + screenY

    dot.style.left = newX + 'px'
    dot.style.top = newY + 'px'
}
