export function getImgPath(type, category, filename) {
    const newFilename = filename.replace('.glb', '.png')
    const path = `/assets/${type}/furniture_thumbnails/${category}/${newFilename}`

    return path
}
