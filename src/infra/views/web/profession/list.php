<div class="bg-secondary d-flex justify-content-between align-items-center my-2 px-2 py-3">
    <div class="fw-bold">LISTAGEM DE PROFISSÕES</div>
    <a href="/profession/form" class="btn btn-primary btn-sm d-none d-sm-block" role="button" data-bs-toggle="submit">NOVA PROFISSÃO</a>
</div>

<div class="text-end">
    <a href="/profession/form" class="btn btn-primary btn-sm d-sm-none" role="button" data-bs-toggle="submit">NOVA PROFISSÃO</a>
</div>

<div class="table-responsive">
    <table id="profession-list" class="table table-hover align-middle mb-1">
        <thead>
            <tr>
                <th class="text-center" style="width: 80px;">ID</th>
                <th scope="col">Descrição</th>
                <th scope="col" style="width: 50px;"></th>
            </tr>
        </thead>

        <?php if (empty($data['professions']) === false) : ?>
            <tbody class="table-group-divider">
                <?php foreach ($data['professions'] as $profession) : ?>
                    <tr>
                        <th class="text-center fw-semibold" scope="row"><?= $profession['profession_id']; ?></th>
                        <td class="text-nowrap"><?= $profession['description']; ?></td>
                        <td>
                            <div class="btn-rounded">
                                <button class="btn dropdown-toggle dropdown-rounded" type="button" data-bs-toggle="dropdown" data-bs-auto-close="true" aria-expanded="false">
                                    <i class="bi bi-three-dots-vertical"></i>
                                </button>
                                <ul class="dropdown-menu bg-tertiary">
                                    <li>
                                        <a class="dropdown-item" href="/profession/form/<?= $this->encrypt($profession['profession_id']); ?>">
                                            <i class="bi bi-pencil"></i>
                                            <span>Alterar</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item text-danger" href="javascript:void(0);" onclick="deleteProfession('<?= $this->encrypt($profession['profession_id']); ?>');">
                                            <i class="bi bi-trash"></i>
                                            <span>Excluir</span>
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
</div>

<?php require '../src/infra/views/pagination.php'; ?>