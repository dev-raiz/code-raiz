<div class="bg-secondary d-flex justify-content-between align-items-center my-2 px-2 py-3">
    <div class="fw-bold">LISTAGEM DE EMPRESAS</div>
    <a href="/company/form" class="btn btn-primary btn-sm" role="button" data-bs-toggle="submit">NOVA EMPRESA</a>
</div>

<!-- <form action="/company/list/" name="formFiltro" method="GET">
    <div class="row">
        <div class="col-6 col-lg-5">
            <label for="name" class="form-label ms-1 mb-1">Nome</label>
            <input id="name" name="name" type="text" class="form-control" aria-label="Nome" placeholder="Nome" value="</?= $data['filter']['name']; ?>">
        </div>
        <div class="col-auto d-flex align-items-end">
            <button id="filter" name="filter" class="btn btn-tertiary" type="submit" value="filter" onclick="onFilter(this);">FILTRAR</button>
        </div>
    </div>
</form> -->


<table id="company-list" class="table table-hover align-middle data-table-list mb-1">
    <thead>
        <tr>
            <th class="text-center" style="width: 80px;">ID</th>
            <th scope="col">Nome</th>
            <th scope="col" style="width: 100px;"></th>
            <th scope="col" style="width: 50px;"></th>
        </tr>
    </thead>

    <?php if (empty($data['companies']) === false) : ?>
        <tbody class="table-group-divider">
            <?php foreach ($data['companies'] as $company) :
                // Token para acesso MASTER
                $token  = USER_ID . '|';
                $token .= 'MASTER' . '|';
                $token .= $company['company_id'] . '|';
                $token .= TODAY . '|';
                $token .= $this->encrypt($token);

            ?>
                <tr>
                    <th class="text-center fw-semibold" scope="row"><?= $company['company_id']; ?></th>
                    <td><?= $company['name']; ?></td>
                    <td>
                        <a href="<?= URL_APP; ?>login/auth-token/<?= $this->encrypt($token); ?>" target="_blank" class="btn btn-outline-secondary" style="font-size: 0.8rem; padding: 0.2rem 0.5rem;" role="button" data-bs-toggle="submit">
                            <span class="d-flex"><i class="bi bi-person-workspace me-1"></i>ACESSAR</span>
                        </a>
                    </td>
                    <td>
                        <div class="btn-rounded">
                            <button class="btn dropdown-toggle dropdown-rounded" type="button" data-bs-toggle="dropdown" data-bs-auto-close="true" aria-expanded="false">
                                <i class="bi bi-three-dots-vertical"></i>
                            </button>
                            <ul class="dropdown-menu bg-tertiary">
                                <li>
                                    <a class="dropdown-item" href="/company/form/<?= $this->encrypt($company['company_id']); ?>">
                                        <i class="bi bi-pencil"></i>
                                        <span>Alterar</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="javascript:void(0);" onclick="showModalDetails('<?= $this->encrypt($company['company_id']); ?>');">
                                        <i class="bi bi-eye"></i>
                                        <span>Detalhes</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="/user/list/<?= $this->encrypt($company['company_id']); ?>">
                                        <i class="bi bi-people-fill"></i>
                                        <span>Usuários</span>
                                    </a>
                                </li>
                                <!-- <li>
                                    <a class="dropdown-item text-danger" href="javascript:void(0);" onclick="deleteCompany('</?= $this->encrypt($company['company_id']); ?>');">
                                        <i class="bi bi-trash"></i>
                                        <span>Excluir</span>
                                    </a>
                                </li> -->
                            </ul>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    <?php else : ?>
        <tfoot>
            <tr>
                <td colspan="5" class="border-bottom-0 ps-0 pe-0">
                    <div class="text-center text-uppercase text-danger-emphasis mt-2 fw-semibold">
                        <?= $data['message']; ?>
                    </div>
                </td>
            </tr>
        </tfoot>
    <?php endif; ?>
</table>

<?php require '../src/infra/views/pagination.php'; ?>

<div id="modal-details" class="modal fade" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">DETALHES DA EMPRESA</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid px-0">
                    <div class="row mb-3">
                        <div class="col-12 col-md-8">
                            <h6 class="mb-0">Razão social</h6>
                            <div id="modal-corporate-name">---</div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12 col-md-8">
                            <h6 class="mb-0">Nome</h6>
                            <div id="modal-name">---</div>
                        </div>
                        <div class="col-12 col-md-4">
                            <h6 class="mb-0">CNPJ</h6>
                            <div id="modal-cnpj">---</div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12 col-md-8">
                            <h6 class="mb-0">E-mail</h6>
                            <div id="modal-email">---</div>
                        </div>
                        <div class="col-12 col-md-4">
                            <h6 class="mb-0">Telefone</h6>
                            <div id="modal-phone">---</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-12">
                            <h6>Token</h6>
                            <div class="card">
                                <div id="modal-token" class="card-body p-2">
                                    ---
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>