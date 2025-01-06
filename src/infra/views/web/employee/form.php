<nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
    <ol class="breadcrumb d-flex align-items-center mb-0">
        <li class="me-1"><a href="/employee/list" class="fs-4 text-primary-theme go-back" title="voltar"><i class="bi bi-arrow-left-circle"></i></a></li>
        <li class="breadcrumb-item"><a href="/employee/list">listagem de funcionários</a></li>
        <li class="breadcrumb-item active" aria-current="page"><?= $data['title']; ?></li>
    </ol>
</nav>
<div class="border-bottom mb-2"></div>

<div class="bg-secondary d-flex justify-content-between align-items-center my-2 px-2 py-3">
    <div class="fw-bold"><?= mb_strtoupper($data['title']); ?></div>
</div>

<form id="formEmployee" class="mt-3 mb-3" action="/employee/<?= $data['action']; ?>" method="post">
    <input id="employee_id" name="employee_id" type="hidden" value="<?= (isset($data['employee_id']) === true) ? $data['employee_id'] : '0'; ?>">
    <input id="person_id" name="person_id" type="hidden" value="<?= (isset($data['employee']['person_id']) === true) ? $this->encrypt($data['employee']['person_id']) : 0; ?>">
    <div class="row">
        <div class="col-12 col-lg-2">
            <div class="mb-3">
                <label for="name" class="form-label ms-1 mb-1">Nome</label>
                <input type="text" class="form-control form-control-sm" id="name" name="name" obrigatorio="true" nome-validar="Nome" value="<?= (isset($data['employee']) === true) ? $data['employee']['name'] : ''; ?>">
            </div>
        </div>
        <div class="col-12 col-lg-3">
            <div class="mb-3">
                <label for="middle_name" class="form-label ms-1 mb-1">Nome do meio</label>
                <input type="text" class="form-control form-control-sm" id="middle_name" name="middle_name" value="<?= (isset($data['employee']) === true) ? $data['employee']['middle_name'] : ''; ?>">
            </div>
        </div>
        <div class="col-12 col-lg-2">
            <div class="mb-3">
                <label for="surname" class="form-label ms-1 mb-1">Sobrenome</label>
                <input type="text" class="form-control form-control-sm" id="surname" name="surname" obrigatorio="true" nome-validar="Sobrenome" value="<?= (isset($data['employee']) === true) ? $data['employee']['surname'] : ''; ?>">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-lg-2">
            <div class="mb-3">
                <label for="cpf" class="form-label ms-1 mb-1">CPF</label>
                <input type="text" class="form-control form-control-sm cpf" id="cpf" name="cpf" obrigatorio="true" nome-validar="CPF" value="<?= (isset($data['employee']) === true) ? $data['employee']['document'] : ''; ?>">
            </div>
        </div>
        <div class="col-12 col-lg-3">
            <div class="mb-3">
                <label for="social_name" class="form-label ms-1 mb-1">Nome social</label>
                <input type="text" class="form-control form-control-sm" id="social_name" name="social_name" obrigatorio="true" nome-validar="Nome social" value="<?= (isset($data['employee']) === true) ? $data['employee']['social_name'] : ''; ?>">
            </div>
        </div>
        <div class="col-12 col-lg-2">
            <div class="mb-3">
                <label for="date_of_birth" class="form-label ms-1 mb-1">Data de Nascimento</label>
                <input type="text" class="form-control form-control-sm only-numbers date datepicker text-center" id="date_of_birth" name="date_of_birth" maxlength="10" obrigatorio="true" nome-validar="Data de Nascimento" onclick="this.select();" placeholder="99/99/9999" value="<?= (isset($data['employee']) === true) ? $this->maskDate($data['employee']['date_of_birth']) : ''; ?>">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-lg-2">
            <div class="mb-3">
                <label for="phone" class="form-label ms-1 mb-1">Telefone</label>
                <input type="text" class="form-control form-control-sm celullar" id="phone" name="phone" obrigatorio="true" nome-validar="Telefone" value="<?= (isset($data['employee']) === true) ? $data['employee']['phone'] : ''; ?>">
            </div>
        </div>
        <div class="col-12 col-lg-5">
            <div class="mb-3">
                <label for="email" class="form-label ms-1 mb-1">E-mail</label>
                <input type="text" class="form-control form-control-sm email" id="email" name="email" obrigatorio="true" nome-validar="E-mail" value="<?= (isset($data['employee']) === true) ? $data['employee']['email'] : ''; ?>">
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-12 col-lg-5">
            <div class="mb-3">
                <label for="profession" class="form-label ms-1 mb-1">Profissão</label>
                <select id="profession" name="profession" class="form-select form-select-sm" obrigatorio="true" nome-validar="Profissão">
                    <?php if (empty($data['professions']) === false): ?>
                        <option value="">Selecione...</option>
                        <?php
                        foreach ($data['professions'] as $profession) :
                            $selected = (isset($data['employee']) === true && intval($data['employee']['profession_id']) === $profession['profession_id']) ? 'selected' : '';
                        ?>
                            <option value="<?= $this->encrypt($profession['profession_id']); ?>" <?= $selected; ?>><?= $profession['description']; ?></option>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <option value="" selected>Nenhuma profissão encontrada!</option>
                    <?php endif; ?>
                </select>
            </div>
        </div>
        <div class="col-12 col-lg-2">
            <div class="mb-3">
                <label for="price_per_hour" class="form-label ms-1 mb-1">Valor de Hora</label>
                <input type="text" class="form-control form-control-sm money text-end" id="price_per_hour" name="price_per_hour" obrigatorio="true" nome-validar="Valor de Hora" value="<?= (isset($data['employee']) === true) ? $this->maskMoney($data['employee']['price_per_hour']) : ''; ?>">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-7">
            <div class="mb-3">
                <label for="observation" class="form-label ms-1 mb-1">Observação(opcional)</label>
                <textarea class="form-control" id="observation" name="observation" style="height: 140px"><?= (isset($data['employee']) === true) ? $data['employee']['observation'] : ''; ?></textarea>
            </div>
        </div>
    </div>
    <?php if ($data['action'] === 'edit') : ?>
        <div class="row">
            <div class="col-12 col-lg-2">
                <div class="mb-3">
                    <label for="status" class="form-label ms-1 mb-1">Status</label>
                    <select id="status" name="status" class="form-select form-select-sm" nome-validar="Status">
                        <option value="<?= $this->encrypt('A'); ?>" <?= (isset($data['employee']) && $data['employee']['status'] === 'A') ? 'selected' : ''; ?>>Ativo</option>
                        <option value="<?= $this->encrypt('I'); ?>" <?= (isset($data['employee']) && $data['employee']['status'] === 'I') ? 'selected' : ''; ?>>Inativo</option>
                    </select>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <div class="row">
        <div class="col-12 col-lg-7">
            <div class="text-end mb-3">
                <a class="btn btn-danger btn-form btn-sm" href="/employee/list" role="button">CANCELAR</a>
                <button id="save" name="save" preloader="true" type="submit" class="btn btn-primary btn-form btn-sm" onclick="return validateDataEmployee(this);">SALVAR</button>
            </div>
        </div>
    </div>
</form>