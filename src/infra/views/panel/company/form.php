<nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
    <ol class="breadcrumb d-flex align-items-center mb-0">
        <li class="my-1 me-2"><a href="/company/list" class="btn-go-back" title="voltar"><i class="bi bi-arrow-left"></i></a></li>
        <li class="breadcrumb-item"><a href="/company/list">listagem de empresas</a></li>
        <li class="breadcrumb-item active" aria-current="page"><?= $data['title']; ?></li>
    </ol>
</nav>
<div class="border-bottom mb-2"></div>

<form id="formCompany" class="mt-3 mb-3" action="/company/<?= $data['action']; ?>" method="POST">
    <input id="company_id" name="company_id" type="hidden" value="<?= (isset($data['company_id']) === true) ? $data['company_id'] : $this->encrypt('0'); ?>">
    <div class="row">
        <div class="col-lg-3"></div>
        <div class="col-12 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="text-center my-2"><?= strtoupper($data['title']); ?></h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="corporate_name" class="form-label ms-1 mb-1">Razão social</label>
                                <input type="text" class="form-control form-control-sm" id="corporate_name" name="corporate_name" obrigatorio="true" nome-validar="Razão social" value="<?= (isset($data['company']) === true) ? $data['company']['corporate_name'] : ''; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-lg-8">
                            <div class="mb-3">
                                <label for="social_name" class="form-label ms-1 mb-1">Nome</label>
                                <input type="text" class="form-control form-control-sm" id="name" name="name" obrigatorio="true" nome-validar="Nome" value="<?= (isset($data['company']) === true) ? $data['company']['name'] : ''; ?>">
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="mb-3">
                                <label for="cnpj" class="form-label ms-1 mb-1">CNPJ</label>
                                <input type="text" class="form-control form-control-sm cnpj" id="cnpj" name="cnpj" obrigatorio="true" nome-validar="CNPJ" value="<?= (isset($data['company']) === true) ? $data['company']['cnpj'] : ''; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-lg-8">
                            <div class="mb-3">
                                <label for="email" class="form-label ms-1 mb-1">E-mail</label>
                                <input type="text" class="form-control form-control-sm email" id="email" name="email" obrigatorio="true" nome-validar="E-mail" value="<?= (isset($data['company']) === true) ? $data['company']['email'] : ''; ?>">
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="mb-3">
                                <label for="phone" class="form-label ms-1 mb-1">Telefone</label>
                                <input type="text" class="form-control form-control-sm celullar" id="phone" name="phone" obrigatorio="true" nome-validar="Telefone" value="<?= (isset($data['company']) === true) ? $data['company']['phone'] : ''; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-lg-12">
                            <div class="text-end">
                                <a class="btn btn-danger btn-form btn-sm" href="/company/list" role="button">CANCELAR</a>
                                <button id="save" name="save" preloader="true" type="submit" class="btn btn-primary btn-form btn-sm" onclick="return validateDataCompany(this);">SALVAR</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3"></div>
    </div>
</form>