async function showModalDetails(companyId) {
    Swal.fire({
        title: 'Aguarde!',
        text: 'Buscando informações da empresa...',
        icon: 'info',
        didOpen: () => {
            Swal.showLoading()
        },
        allowOutsideClick: false,
        showConfirmButton: false
    });

    let modal = new bootstrap.Modal(document.getElementById('modal-details'));

    let payload = {
        company_id: companyId
    };

    let options = {
        method: "POST",
        body: JSON.stringify(payload)
    };

    let result = await fetch('/company/details', options);

    result.json().then(function (resolve) {
        if (resolve.result === 'success') {
            let company = resolve.data.company;

            $('#modal-corporate-name').html(company.corporate_name);
            $('#modal-name').html(company.name);
            $('#modal-cnpj').html(maskCnpj(company.cnpj));
            $('#modal-email').html(company.email);
            $('#modal-phone').html(maskWhatsapp(company.phone));
            $('#modal-token').html(company.token);

            setTimeout(() => {
                Swal.close();
                modal.show();
            }, 1500);
        } else {
            Swal.fire({
                title: resolve.message,
                icon: resolve.result,
                showConfirmButton: true
            });
        }
    });
}

$('#modal-details').on('hidden.bs.modal', function () {
    $('#modal-corporate-name').html('---');
    $('#modal-name').html('---');
    $('#modal-cnpj').html('---');
    $('#modal-email').html('---');
    $('#modal-phone').html('---');
    $('#modal-token').html('---');

    $('body').attr('style', 'padding-right: 0px;'); // Corrige bug
});