export default function mobileDragDiv() {
    let toggle = true
    let minHeight
    let maxHeight
    let draggableDiv = document.querySelector('.selection-bar-wrapper')
    let isDragging = false
    let startPositionY
    let startHeight
    let windowWidth = window.innerWidth
    function startDrag(event) {
        isDragging = true
        if (event.type === 'mousedown') {
            startPositionY = event.clientY
        } else if (event.type === 'touchstart') {
            startPositionY = event.touches[0].clientY
        }
        startHeight = draggableDiv.offsetHeight
        draggableDiv.style.cursor = 'grabbing'
    }

    function drag(event) {
        if (!isDragging) return
        if (event.target.tagName.toLowerCase() !== 'select') {
            event.preventDefault()
        }

        let mouseY
        if (event.type === 'mousemove') {
            mouseY = event.clientY
        } else if (event.type === 'touchmove') {
            mouseY = event.touches[0].clientY
        }

        let heightDiff = mouseY - startPositionY
        let newHeight = startHeight - heightDiff

        minHeight = window.innerHeight * 0.08
        maxHeight = window.innerHeight

        // Adjust height calculation based on width
        let currentWidth = draggableDiv.offsetWidth
        let maxWidth = window.innerWidth // 80% of the window width

        // Calculate the maximum height based on the current width
        let maxAllowedHeight = (maxHeight / currentWidth) * maxWidth

        // Apply boundary checks
        if (newHeight < minHeight) {
            newHeight = minHeight
        } else if (newHeight > maxAllowedHeight) {
            newHeight = maxAllowedHeight
        }

        draggableDiv.style.height = newHeight + 'px'
    }
    function stopDrag() {
        isDragging = false
        draggableDiv.style.cursor = 'grab'
    }

    function onWindowResize() {
        windowWidth = window.innerWidth
        if (windowWidth < 950) {
            draggableDiv.addEventListener('mousedown', startDrag)
            draggableDiv.addEventListener('touchstart', startDrag, {
                passive: false
            })
            document.addEventListener('mousemove', drag)
            document.addEventListener('touchmove', drag, { passive: false })
            document.addEventListener('mouseup', stopDrag)
            document.addEventListener('touchend', stopDrag)
        } else {
            try {
                draggableDiv.removeEventListener('mousedown', startDrag)
                draggableDiv.removeEventListener('touchstart', startDrag)
                document.removeEventListener('mousemove', drag)
                document.removeEventListener('touchmove', drag)
                document.removeEventListener('mouseup', stopDrag)
                document.removeEventListener('touchend', stopDrag)
            } catch (error) {}
        }
    }

    function setMaxHeight() {
        if (toggle === true) {
            draggableDiv.style.transition = 'height 0.8s'
            draggableDiv.style.height = maxHeight + 'px'
            toggle = false
            console.log(toggle)
        } else if (toggle === false) {
            draggableDiv.style.transition = 'height 0.8s'
            draggableDiv.style.height = minHeight + 'px'
            toggle = true
            console.log(toggle)
        }
    }

    const maxHeightButton = document.getElementById('setHeight')
    maxHeightButton.addEventListener('click', setMaxHeight)

    window.addEventListener('resize', onWindowResize, false)
    onWindowResize()
}
