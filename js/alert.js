function exibirSweetAlert() {
    document.addEventListener("DOMContentLoaded", function() {
       Swal.fire({
       position: "top-end",
        icon: "success",
        title: "FORNECEDOR EDITADO!",
        showConfirmButton: false,
        timer: 2000
     });
    });
}