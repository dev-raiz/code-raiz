async function generateNewPassword(personId) {
    let msg = '<ul style="text-align: justify;">';
    msg += '<li>Uma nova senha será gerada e enviada no e-mail cadastrado para a pessoa</li>';
    msg += '<li>A senha anterior será substituída</li>';
    msg += '<li>Não será possível reverter esta ação!</li>';
    msg += '</ul>';

    Swal.fire({
        title: 'Deseja realmente gerar uma nova senha?',
        html: msg,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'CONFIRMAR',
        cancelButtonText: 'CANCELAR',
        showLoaderOnConfirm: true,
        preConfirm: () => {
        }
    }).then(async (result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: 'Aguarde!',
                text: 'Gerando nova senha para o usuário...',
                icon: 'info',
                didOpen: () => {
                    Swal.showLoading()
                },
                allowOutsideClick: false,
                showConfirmButton: false
            });

            let payload = {
                person_id: personId
            };

            let options = {
                method: "POST",
                body: JSON.stringify(payload)
            };

            let result = await fetch(URL_BASE + 'person/generate-new-password', options);

            result.json().then(function (resolve) {
                setTimeout(function () {
                    if (resolve.result === 'success') {
                        Swal.fire({
                            title: resolve.message,
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 2000
                        });
                    } else {
                        Swal.fire({
                            title: resolve.message,
                            icon: resolve.result,
                            showConfirmButton: true
                        });
                    }
                }, 1500);
            });
        }
    });
}