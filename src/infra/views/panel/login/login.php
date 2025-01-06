<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title><?= TITLE; ?></title>
    <link rel="shortcut icon" href="data:image/x-icon;," type="image/x-icon">

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Language" content="pt-br">
    <meta http-equiv="Cache-Control" content="no-cache, no-store">
    <meta http-equiv="expires" content="Mon, 06 Jan 1990 00:00:01 GMT">
    <meta name="robots" content="index, follow">
    <meta name="Category" content="business">
    <meta name="title" content="<?= TITLE; ?>">
    <meta name="url" content="<?= URL_BASE; ?>">
    <meta name="geo.region" content="BR-PR">
    <meta name="geo.placename" content="Assis">
    <meta name="autor" content="Grupo devRaiz">
    <meta name="company" content="Grupo devRaiz">
    <meta name="revisit-after" content="10">

    <link href="<?= PATH_CDN; ?>/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="<?= PATH_CDN; ?>/bootstrap/css/datepicker.css" rel="stylesheet" type="text/css">
    <link href="<?= PATH_CDN; ?>/bootstrap/icons/font/bootstrap-icons.css" rel="stylesheet" type="text/css">
    <link href="<?= PATH_CDN; ?>/toast/sweetalert2.css" rel="stylesheet" type="text/css">
    <link href="<?= PATH_CDN; ?>/fontawesome/css/all.css" rel="stylesheet" type="text/css">

    <!-- Font-icon css-->
    <!-- <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> -->

    <link href="/css/panel/theme.css" rel="stylesheet" type="text/css">
    <link href="/css/custom.css" rel="stylesheet" type="text/css">

    <style>
        body {
            display: flex;
            min-height: 100vh;
            flex-direction: column;
        }

        main {
            flex: 1 0 auto;
            background-color: var(--bs-primary-light-5);
        }
    </style>

</head>

<body>
    <form id="formLogin" action="/login/auth" class="d-flex justify-content-center align-items-center" style="min-height: 100vh;" method="POST">
        <div class="col-11 col-sm-6 col-lg-4 mt-3 mb-3">
            <div class="bg-white p-4 rounded-1 border">
                <div class="row">
                    <h4 class="text-center text-primary-theme">LOGIN</h4>
                    <div class="border-bottom mt-3 mb-3"></div>
                    <div class="col-lg-12">
                        <div class="mb-3">
                            <label for="email" class="form-label text-light-emphasis">E-mail</label>
                            <div class="input-group">
                                <input type="text" class="form-control email" id="email" name="email" obrigatorio="true" nome-validar="E-mail" placeholder="Informe seu e-mail" value="<?= (isset($data['post']) === true) ? $data['post']['email'] : 'devraiz@hotmail.com'; ?>">
                                <span class="input-group-text" id="email-addon"><i class="bi bi-envelope-at"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="mb-3">
                            <label for="password" class="form-label text-light-emphasis">Senha</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="password" name="password" obrigatorio="true" nome-validar="Senha" placeholder="Informe sua senha" value="<?= (isset($data['post']) === true) ? $data['post']['password'] : '123456'; ?>">
                                <span data-id="password" class="input-group-text password-addon" style="cursor: pointer;"><i class="bi bi-eye"></i></span>
                            </div>
                        </div>
                        <!-- <div class="text-end">
                            <a href="/password/forgot" class="text-primary-light-3-theme" type="button" data-bs-toggle="submit">Esqueci minha senha</a>
                        </div> -->
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-lg-12">
                        <div>
                            <input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response" value="" />
                            <button id="access" name="access" preloader="true" type="button" class="btn btn-primary w-100" onclick="return validateDataLogin(this);">ACESSAR</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <script type="text/javascript" src="<?= PATH_CDN; ?>/jQuery/jquery.js"></script>
    <script type="text/javascript" src="<?= PATH_CDN; ?>/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="<?= PATH_CDN; ?>/bootstrap/js/datepicker.js"></script>
    <script type="text/javascript" src="<?= PATH_CDN; ?>/toast/sweetalert2.js"></script>
    <script type="text/javascript" src="<?= PATH_CDN; ?>/validate/form.js"></script>
    <script type="text/javascript" src="<?= PATH_CDN; ?>/mask/mask.min.js"></script>
    <script type="text/javascript" src="<?= PATH_CDN; ?>/mask/maskMoney.js"></script>
    <script type="text/javascript" src="<?= PATH_CDN; ?>/mask/Masks.js"></script>
    <script type="text/javascript" src="<?= PATH_CDN; ?>/cookie.js"></script>

    <?php if (ENVIRONMENT === 'PROD') : ?>
        <script type="text/javascript" src="https://www.google.com/recaptcha/api.js?render=<?= SITE_KEY; ?>"></script>
    <?php endif; ?>

    <script>
        var submited = false;

        function validateDataLogin(button) {
            if (validateForm("#formLogin") === true) {
                if (submited === false) {
                    submited = true;

                    <?php if (ENVIRONMENT === 'PROD') : ?>
                        grecaptcha.execute('<?= SITE_KEY; ?>').then(function(token) {
                            document.querySelector("#g-recaptcha-response").value = token;

                            if ($(button).attr('preloader')) {
                                $(button).html('<i class="fa-solid fa-rotate fa-spin"></i>');
                            } else {
                                $(button).html('Aguarde...');
                            }

                            $(button).attr("type", 'submit');
                            $(button).trigger("click");
                            $(button).attr("type", 'button');
                        });
                    <?php endif; ?>

                    <?php if (ENVIRONMENT === 'DEV') : ?>
                        if ($(button).attr('preloader')) {
                                $(button).html('<i class="fa-solid fa-rotate fa-spin"></i>');
                            } else {
                                $(button).html('Aguarde...');
                            }

                            $(button).attr("type", 'submit');
                            $(button).trigger("click");
                            $(button).attr("type", 'button');
                    <?php endif; ?>
                }
            }
        }
    </script>

    <?php if (isset($data['alert']) === true) : ?>
        <script>
            Swal.fire({
                icon: '<?= $data['alert-type']; ?>',
                title: '<?= $data['alert-title']; ?>',
                html: '<?= $data['alert-message']; ?>',
                showConfirmButton: false,
                timer: 3550
            });
        </script>
    <?php endif; ?>

</body>

</html>