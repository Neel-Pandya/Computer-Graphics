const sweetAlert = (typeOfAlert, message) => {
    Swal.fire({
        icon: typeOfAlert,
        title: message,
        showConfirmButton: false,
        timer: 1500,
    });
}