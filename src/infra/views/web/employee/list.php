<div class="bg-secondary d-flex justify-content-between align-items-center my-2 px-2 py-3">
    <div class="fw-bold">LISTAGEM DE FUNCIONÁRIOS</div>
    <a href="/employee/form" class="btn btn-primary btn-sm d-none d-sm-block" role="button" data-bs-toggle="submit">NOVO FUNCIONÁRIO</a>
</div>

<div class="text-end">
    <a href="/employee/form" class="btn btn-primary btn-sm d-sm-none" role="button" data-bs-toggle="submit">NOVO FUNCIONÁRIO</a>
</div>

<div class="table-responsive">
    <table id="employee-list" class="table table-hover align-middle mb-1">
        <thead>
            <tr>
                <th class="text-center" style="width: 80px;">ID</th>
                <th scope="col" style="width: 100px;">Documento</th>
                <th scope="col">Nome</th>
                <th scope="col" class="text-center" style="width: 100px;">Status</th>
                <th scope="col" style="width: 50px;"></th>
            </tr>
        </thead>

        <?php if (empty($data['employees']) === false) : ?>
            <tbody class="table-group-divider">
                <?php foreach ($data['employees'] as $employee) : ?>
                    <tr>
                        <th class="text-center fw-semibold" scope="row"><?= $employee['employee_id']; ?></th>
                        <td class="text-nowrap"><?= $this->maskCpf($employee['document']); ?></td>
                        <td class="text-nowrap"><?= $employee['full_name']; ?></td>
                        <td class="text-nowrap text-center">
                            <?php if ($employee['status'] === 'A') : ?>
                                <i data-bs-toggle="tooltip" data-bs-placement="left" data-bs-title="Ativo" class="bi bi-hand-thumbs-up-fill text-success fs-5"></i>
                            <?php else: ?>
                                <i data-bs-toggle="tooltip" data-bs-placement="left" data-bs-title="Inativo" class="bi bi-hand-thumbs-down-fill text-danger fs-5"></i>
                            <?php endif; ?>
                        </td>
                        <td>
                            <div class="btn-rounded">
                                <button class="btn dropdown-toggle dropdown-rounded" type="button" data-bs-toggle="dropdown" data-bs-auto-close="true" aria-expanded="false">
                                    <i class="bi bi-three-dots-vertical"></i>
                                </button>
                                <ul class="dropdown-menu bg-tertiary">
                                    <li>
                                        <a class="dropdown-item" href="/employee/form/<?= $this->encrypt($employee['employee_id']); ?>">
                                            <i class="bi bi-pencil"></i>
                                            <span>Alterar</span>
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
                    <td colspan="4" class="border-bottom-0 ps-0 pe-0">
                        <div class="text-center text-uppercase text-danger-emphasis mt-2 fw-semibold">
                            <?= $data['message']; ?>
                        </div>
                    </td>
                </tr>
            </tfoot>
        <?php endif; ?>
    </table>
</div>

<?php require '../src/infra/views/pagination.php'; ?>