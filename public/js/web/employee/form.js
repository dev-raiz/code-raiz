function validateDataEmployee(button) {
    if (validateForm("#formEmployee") === true) {
        if (submited === false) {
            submited = true;
            if ($(button).attr('preloader')) {
                $(button).html('<i class="fa-solid fa-rotate fa-spin"></i>');
            } else {
                $(button).html('Aguarde...');
            }
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}