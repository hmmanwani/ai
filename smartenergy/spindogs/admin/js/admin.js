// Add delegated events.
document.addEventListener('mouseenter', (e) => {
    const { target } = e

    if (typeof target === 'object' && target !== null && 'getAttribute' in target && target.matches('a[data-layout]')) {
        const layout = target.dataset.layout
        showComponentScreenshot(layout, target)
    }
}, true)

document.addEventListener('mouseleave', (e) => {
    const { target } = e

    if (typeof target === 'object' && target !== null && 'getAttribute' in target && target.matches('a[data-layout]')) {
        hideComponentScreenshot(target)
    }
}, true)

function showComponentScreenshot (layout, wrapper) {
    const image = `/wp-content/themes/spindogs/images/flex-previews/`+ layout + `.png`

    const wrapperContainer = document.createElement('div')

    wrapperContainer.classList.add('spindogs-component-screenshot-image-wrapper')
    wrapper.append(wrapperContainer)

    const img = document.createElement('img')
    img.classList.add('spindogs-component-screenshot-preview-image-large')
    img.src = image

    wrapperContainer.prepend(img)
}

function hideComponentScreenshot (wrapper) {
    const wrapperContainer = wrapper.querySelector('.spindogs-component-screenshot-image-wrapper')
    wrapperContainer.remove()
}

function firstToUpperCase (str) {
    return str.substr(0, 1).toUpperCase() + str.substr(1)
}

