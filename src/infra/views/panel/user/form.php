<nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
    <ol class="breadcrumb d-flex align-items-center mb-0">
        <li class="my-1 me-2"><a href="/user/list/<?= $data['company_id']; ?>" class="btn-go-back" title="voltar"><i class="bi bi-arrow-left"></i></a></li>
        <li class="breadcrumb-item"><a href="/company/list">listagem de empresas</a></li>
        <li class="breadcrumb-item"><a href="/user/list/<?= $data['company_id']; ?>">listagem de usuários</a></li>
        <li class="breadcrumb-item active" aria-current="page"><?= $data['title']; ?></li>
    </ol>
</nav>
<div class="border-bottom mb-2"></div>

<form id="formUser" class="mt-3 mb-3" action="/user/<?= $data['action']; ?>" method="POST">
    <input id="user_id" name="user_id" type="hidden" value="<?= (isset($data['user_id']) === true) ? $data['user_id'] : $this->encrypt('0'); ?>">
    <input id="person_id" name="person_id" type="hidden" value="<?= (isset($data['person_id']) === true) ? $data['person_id'] : $this->encrypt('0'); ?>">
    <input id="company_id" name="company_id" type="hidden" value="<?= $data['company_id']; ?>">
    <div class="row">
        <div class="col-lg-3"></div>
        <div class="col-12 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="text-center my-2"><?= mb_strtoupper($data['title']); ?></h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-lg-4">
                            <div class="mb-3">
                                <label for="cpf" class="form-label ms-1 mb-1">CPF</label>
                                <input type="text" class="form-control form-control-sm cpf" id="cpf" name="cpf" obrigatorio="true" nome-validar="CPF" value="<?= (isset($data['user']) === true) ? $data['user']['document'] : ''; ?>">
                            </div>
                        </div>
                        <div class="col-12 col-lg-8">
                            <div class="mb-3">
                                <label for="social_name" class="form-label ms-1 mb-1">Nome social</label>
                                <input type="text" class="form-control form-control-sm" id="social_name" name="social_name" obrigatorio="true" nome-validar="Nome social" value="<?= (isset($data['user']) === true) ? $data['user']['social_name'] : ''; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-lg-4">
                            <div class="mb-3">
                                <label for="phone" class="form-label ms-1 mb-1">Telefone</label>
                                <input type="text" class="form-control form-control-sm celullar" id="phone" name="phone" obrigatorio="true" nome-validar="Telefone" value="<?= (isset($data['user']) === true) ? $data['user']['phone'] : ''; ?>">
                            </div>
                        </div>
                        <div class="col-12 col-lg-8">
                            <div class="mb-3">
                                <label for="email" class="form-label ms-1 mb-1">E-mail</label>
                                <input type="text" class="form-control form-control-sm email" id="email" name="email" obrigatorio="true" nome-validar="E-mail" value="<?= (isset($data['user']) === true) ? $data['user']['email'] : ''; ?>">
                            </div>
                        </div>
                    </div>
                    <?php if ($data['action'] === 'edit') : ?>
                        <div class="row">
                            <div class="col-12 col-lg-4">
                                <div class="mb-3">
                                    <label for="status" class="form-label ms-1 mb-1">Status</label>
                                    <select id="status" name="status" class="form-select form-select-sm" nome-validar="Status">
                                        <option value="<?= $this->encrypt('A'); ?>" <?= (isset($data['user']) && $data['user']['status'] === 'A') ? 'selected' : ''; ?>>Ativo</option>
                                        <option value="<?= $this->encrypt('I'); ?>" <?= (isset($data['user']) && $data['user']['status'] === 'I') ? 'selected' : ''; ?>>Inativo</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="row">
                        <div class="col-12 col-lg-12">
                            <div class="text-end">
                                <a class="btn btn-danger btn-form btn-sm" href="/user/list/<?= $data['company_id']; ?>" role="button">CANCELAR</a>
                                <button id="save" name="save" preloader="true" type="submit" class="btn btn-primary btn-form btn-sm" onclick="return validateDataUser(this);">SALVAR</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3"></div>
    </div>
</form>