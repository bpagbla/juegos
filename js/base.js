const toastLiveExample = document.querySelectorAll('.toast')
async function runToast() {
    for (const toast of toastLiveExample) {
        const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toast)
        toastBootstrap.show()
        await new Promise(r => setTimeout(r, 200));
    }
}

runToast();