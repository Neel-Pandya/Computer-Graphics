const sweetAlert = (typeOfAlert, message) => {
    Swal.fire({
        icon: typeOfAlert,
        title: message,
        showConfirmButton: false,
        timer: 1500,
    });
}

const loader = () => {
    Swal.fire({
        timer: 1000,
        timerProgressBar: true,
        didOpen: () => {
            Swal.showLoading()
            const b = Swal.getHtmlContainer().querySelector('b')
            timerInterval = setInterval(() => {
                b.textContent = Swal.getTimerLeft()
            }, 100)
        },
        willClose: () => {
            clearInterval(timerInterval)
        }
    })
}