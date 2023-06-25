export default async function prices(componentIdArr) {
    const componentPrices = []
    const fetchPromises = componentIdArr.map((componentId) =>
        fetchPrice(componentId)
    )
    const fetchedPrices = await Promise.all(fetchPromises)
    componentPrices.push(...fetchedPrices)

    let sum = 0
    // sum must be declared as number, otherwise NaN error
    for (let i = 0; i < componentPrices.length; i++) {
        sum += componentPrices[i]
    }

    return sum
}

async function fetchPrice(componentId) {
    const response = await axios.get(route('configuration.componentById'), {
        params: {
            id: componentId
        }
    })

    const price = await response.data.component.price
    return price
}
