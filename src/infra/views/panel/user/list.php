<nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
    <ol class="breadcrumb d-flex align-items-center mb-0">
        <li class="my-1 me-2"><a href="/company/list" class="btn-go-back" title="voltar"><i class="bi bi-arrow-left"></i></a></li>
        <li class="breadcrumb-item"><a href="/company/list">listagem de empresas</a></li>
        <li class="breadcrumb-item active" aria-current="page">listagem de usuários</li>
    </ol>
</nav>
<div class="border-bottom mb-2"></div>

<div class="bg-secondary d-flex justify-content-between align-items-center my-2 p-2">
    <div>
        <b>LISTAGEM DE USUÁROS</b>
        <h6 class="text-muted mb-0"><?= $data['company']['name']; ?></h6>
    </div>
    <a href="/user/form/<?= $data['company_id']; ?>" class="btn btn-primary btn-sm" role="button" data-bs-toggle="submit">NOVO USUÁRIO</a>
</div>

<table id="user-list" class="table table-hover align-middle data-table-list mb-1">
    <thead>
        <tr>
            <th class="text-center" style="width: 80px;">ID</th>
            <th scope="col">Nome</th>
            <th scope="col" style="width: 50px;"></th>
        </tr>
    </thead>

    <?php if (empty($data['users']) === false) : ?>
        <tbody class="table-group-divider">
            <?php foreach ($data['users'] as $user) : ?>
                <tr>
                    <th class="text-center fw-semibold" scope="row"><?= $user['user_id']; ?></th>
                    <td><?= $user['social_name']; ?></td>
                    <td>
                        <div class="btn-rounded">
                            <button class="btn dropdown-toggle dropdown-rounded" type="button" data-bs-toggle="dropdown" data-bs-auto-close="true" aria-expanded="false">
                                <i class="bi bi-three-dots-vertical"></i>
                            </button>
                            <ul class="dropdown-menu bg-tertiary">
                                <li>
                                    <a class="dropdown-item" href="/user/form/<?= $data['company_id']; ?>/<?= $this->encrypt($user['user_id']); ?>">
                                        <i class="bi bi-pencil"></i>
                                        <span>Alterar</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="javascript:void(0);" onclick="generateNewPassword('<?= $this->encrypt($user['person_id']); ?>');">
                                        <i class="bi bi-person-fill-lock"></i>
                                        <span>Gerar nova senha</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    <?php else : ?>
        <tfoot>
            <tr>
                <td colspan="3" class="border-bottom-0 ps-0 pe-0">
                    <div class="text-center text-uppercase text-danger-emphasis mt-2 fw-semibold">
                        <?= $data['message']; ?>
                    </div>
                </td>
            </tr>
        </tfoot>
    <?php endif; ?>
</table>


<?php require '../src/infra/views/pagination.php'; ?>