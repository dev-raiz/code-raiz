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
    <link href="<?= PATH_CDN; ?>/select2/css/select2.min.css" rel="stylesheet" type="text/css">
    <link href="<?= PATH_CDN; ?>/select2/css/select2-bootstrap-5-theme.min.css" rel="stylesheet" type="text/css">

    <link href="/css/web/theme.css" rel="stylesheet" type="text/css">
    <link href="/css/custom.css?v=<?= TIMESTAMP; ?>" rel="stylesheet" type="text/css">

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

    <?php if (file_exists('css/' . $view . '.css')) : ?>
        <link href="/css/<?= $view; ?>.css" rel="stylesheet" type="text/css">
    <?php endif; ?>

</head>

<body>
    <nav class="navbar sticky-top navbar-expand-lg d-none d-lg-block">
        <div class="container-fluid ps-1 pe-1">
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav w-100">
                    <li class="nav-item">
                        <a class="nav-link" href="/home">HOME</a>
                    </li>
                    <li class="nav-item dropdown dropdown-hover">
                        <a class="nav-link dropdown-toggle not-arrow" href="#" role="button" aria-expanded="false">
                            CADASTROS
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item text-light" href="/employee/list">FUNCIONÁRIOS</a></li>
                            <li><a class="dropdown-item text-light" href="/profession/list">PROFISSÕES</a></li>
                        </ul>
                    </li>
                    <li class="nav-item ms-auto">
                        <a class="nav-link fs-4 pe-3" style="padding-left: 20px;" href="/logout">
                            <i class="bi bi-box-arrow-right"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <nav class="navbar sticky-top d-lg-none d-xl-none">
        <div class="container-fluid m-0 p-0">
            <a class="nav-link fs-1 m-0 pt-1 pb-1 ps-2 pe-2" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation" href="#">
                <i class="bi bi-list text-white"></i>
            </a>
        </div>
    </nav>

    <aside class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
        <div class="offcanvas-body mt-2 p-0">
            <ul class="navbar-nav h-100">
                <li class="nav-item">
                    <a class="nav-link p-2" href="/home">HOME</a>
                </li>
                <li>
                    <a class="nav-link p-2 d-flex collapse-button" data-bs-toggle="collapse" aria-controls="records" href="#records">
                        CADASTROS
                        <i class="bi bi-chevron-down ms-auto me-3"></i>
                    </a>
                    <ul class="navbar-nav collapse" id="records">
                        <li class="nav-item">
                            <a class="nav-link ms-3 p-2" href="/employee/list">FUNCIONÁRIOS</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link ms-3 p-2" href="/profession/list">PROFISSÕES</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item mt-auto">
                    <a class="nav-link p-2" href="/logout">SAIR</a>
                </li>
            </ul>
        </div>
    </aside>

    <main>
        <div class="container-fluid">
            <?php require '../src/infra/views/' . $view . '.php'; ?>
        </div>
    </main>

    <div class="container-fluid sticky-bottom bg-white">
        <footer class="d-flex flex-wrap justify-content-between align-items-center py-2 border-top" style="height: 40px;">
            <div class="col-12 col-md-6 d-flex align-items-center">
                <div>
                    <span class="text-muted"><b>Cantina: </b><?= COMPANY_DATA['name'] . '(' . COMPANY_ID . ')'; ?></span>
                </div>
            </div>
            <div class="col-12 col-md-6 d-flex justify-content-md-end align-items-center">
                <div class="text-end">
                    <span class="text-muted"><b>Usuário: </b><?= (USER_LEVEL === 'master') ? USER_NAME . '(master)' : USER_NAME; ?></span>
                </div>
            </div>
        </footer>
    </div>

    <script type="text/javascript" src="/js/config.js"></script>
    <script type="text/javascript" src="/js/web/config.js"></script>
    <script type="text/javascript" src="<?= PATH_CDN; ?>/jQuery/jquery.js"></script>
    <script type="text/javascript" src="<?= PATH_CDN; ?>/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="<?= PATH_CDN; ?>/bootstrap/js/datepicker.js"></script>
    <script type="text/javascript" src="<?= PATH_CDN; ?>/toast/sweetalert2.js"></script>
    <script type="text/javascript" src="<?= PATH_CDN; ?>/validate/form.js"></script>
    <script type="text/javascript" src="<?= PATH_CDN; ?>/mask/mask.min.js"></script>
    <script type="text/javascript" src="<?= PATH_CDN; ?>/mask/maskMoney.js"></script>
    <script type="text/javascript" src="<?= PATH_CDN; ?>/mask/Masks.js"></script>
    <script type="text/javascript" src="<?= PATH_CDN; ?>/file/file.js"></script>
    <script type="text/javascript" src="<?= PATH_CDN; ?>/cookie.js"></script>
    <script type="text/javascript" src="<?= PATH_CDN; ?>/select2/js/select2.min.js"></script>
    <script type="text/javascript" src="<?= PATH_CDN; ?>/echarts/js/echarts.js"></script>

    <script>
        var submited = false;

        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });

        $('.dropdown-hover').mouseover(function(elemento) {
            $(this).find('ul.dropdown-menu').show();
        });

        $('.dropdown-hover').mouseout(function(elemento) {
            $(this).find('ul.dropdown-menu').hide();
        });

        const collapse = $('.collapse-button').on('click', function() {
            if ($(this).has('.bi-chevron-up').length === 1) {
                $(this).find('.bi-chevron-up').removeClass('bi-chevron-up').addClass('bi-chevron-down');
            } else {
                $(this).find('.bi-chevron-down').removeClass('bi-chevron-down').addClass('bi-chevron-up');
            }
        });

        $('.datepicker').datepicker({
            'autoclose': true,
            'format': 'dd/mm/yyyy',
            'orientation': 'bottom',
            'language': 'ptBr',
            'clearBtn': true,
            'forceParse': false,
            'showWeekDays': false
        });

        $('.datepicker').each((i, e) => {
            if (e.value === '') {
                // Gambi para iniciar o calendário marcado com a data atual
                $('.datepicker').datepicker("setDate", new Date());
                $('.datepicker').val('');
            }
        });

        $(document).on('select2:open', () => {
            document.querySelector('.select2-search__field').focus();
        });

        $('.go-back').hover(function() {
            $(this).find('i').addClass('bi-arrow-left-circle-fill');
            $(this).find('i').removeClass('bi-arrow-left-circle');
        }, function() {
            $(this).find('i').addClass('bi-arrow-left-circle');
            $(this).find('i').removeClass('bi-arrow-left-circle-fill');
        });
    </script>

    <script type="text/javascript" src="/js/pagination.js"></script>

    <?php if (file_exists('js/' . $view . '.js')) : ?>
        <script type="text/javascript" src="/js/<?= $view; ?>.js"></script>
    <?php endif; ?>

    <?php if (isset($data['alert']) === true) : ?>
        <script>
            Swal.fire({
                icon: "<?= $data['alert-type']; ?>",
                title: "<?= $data['alert-title']; ?>",
                html: "<?= html_entity_decode($data['alert-message']); ?>",
                confirmButtonColor: COLOR_PRIMARY,
                showConfirmButton: <?= $data['alert-confirm-button']; ?>,
                timer: <?= ($data['alert-confirm-button'] === 'true') ? 0 : 3550; ?>
            });
        </script>
    <?php endif; ?>

</body>

</html>