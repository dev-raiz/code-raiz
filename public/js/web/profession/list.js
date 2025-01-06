function deleteProfession(professionId) {
    Swal.fire({
        title: 'Aviso!',
        html: 'Deseja realmente excluir esta profissão?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#666f88',
        cancelButtonColor: '#d33',
        confirmButtonText: 'SIM',
        cancelButtonText: 'NÃO',
        focusCancel: true
    }).then(async (result) => {
        if (result.isConfirmed) {
            location.href = '/profession/remove/' + professionId;
        }
    });
}