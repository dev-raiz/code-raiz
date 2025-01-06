<nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
    <ol class="breadcrumb d-flex align-items-center mb-0">
        <li class="me-1"><a href="/profession/list" class="fs-4 text-primary-theme go-back" title="voltar"><i class="bi bi-arrow-left-circle"></i></a></li>
        <li class="breadcrumb-item"><a href="/profession/list">listagem de profissões</a></li>
        <li class="breadcrumb-item active" aria-current="page"><?= $data['title']; ?></li>
    </ol>
</nav>
<div class="border-bottom mb-2"></div>

<form id="formProfession" class="mt-3 mb-3" action="/profession/<?= $data['action']; ?>" method="post">
    <input id="profession_id" name="profession_id" type="hidden" value="<?= (isset($data['profession_id']) === true) ? $data['profession_id'] : '0'; ?>">
    <div class="row">
        <div class="col-lg-3"></div>
        <div class="col-12 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="text-center my-2"><?= mb_strtoupper($data['title']); ?></h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="description" class="form-label ms-1 mb-1">Descrição</label>
                                <input type="text" class="form-control form-control-sm" id="description" name="description" obrigatorio="true" nome-validar="Descrição" value="<?= (isset($data['profession']) === true) ? $data['profession']['description'] : ''; ?>">
                            </div>
                        </div>
                    </div>                    
                    <div class="row">
                        <div class="col-12 col-lg-12">
                            <div class="text-end">
                                <a class="btn btn-danger btn-form btn-sm" href="/profession/list" role="button">CANCELAR</a>
                                <button id="save" name="save" preloader="true" type="submit" class="btn btn-primary btn-form btn-sm" onclick="return validateDataProfession(this);">SALVAR</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3"></div>
    </div>
</form>