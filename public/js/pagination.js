const url   = window.location.href;
const urlParams = url.split('/');

$('.records-per-page').change(function() {
    let ckName =  urlParams[3] + '-' + urlParams[4];

    setCookie('ck-records-' + ckName, $(this).val(), -1, '/');
    setCookie('ck-page-' + ckName, 1, -1, '/'); // Volta pra página 1
    location.href = '/' + urlParams[3] + '/' + urlParams[4];
});

$('.page-link').click(function() {
    let ckName =  urlParams[3] + '-' + urlParams[4];

    setCookie('ck-page-' + ckName, $(this).attr('page'), -1, '/');
    location.href = '/' + urlParams[3] + '/' + urlParams[4];
});
