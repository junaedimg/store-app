<?php

use app\config\config;

$userData = $data['user_data'];
$roleData = $data['role_data'];
?>
<div class="container-xxl m-0  ">
    <div class="g-col-12 d-flex flex-column gap-2">
        <div>
            <h2>Users Information</h2>
        </div>
        <div class="g-col-12">
            <button id="btn-gt-add-user-page" class="btn btn-primary" data-bs-target="#modal" data-bs-toggle="modal">Add New User</button>
        </div>
        <div>
            <table id="table" class="table rounded w-100  ">
                <thead>
                    <tr class="table-primary">
                        <th>
                            No.
                        </th>
                        <th>
                            Username
                        </th>
                        <th>
                            password
                        </th>
                        <th>
                            img
                        </th>
                        <th>
                            Role
                        </th>
                        <th>
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($userData as $user) : ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $user['username']; ?></td>
                            <td><?= $user['password']; ?></td>
                            <td>
                                <div class="shadow-lg p-1 bg-body-tertiary rounded overflow-hidden d-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                                    <?php if ($user['img'] != null) : ?>
                                        <img src="<?= config::BASEURL; ?>/public/uploaded/<?= $user['img']; ?>" style="width: 100%; object-fit: scale-down;">
                                    <?php else : ?>
                                        <i class="fa-regular fa-image fs-2"></i>
                                    <?php endif; ?>
                                </div>
                            </td>
                            <td>
                                <?php
                                foreach ($roleData as $role) {
                                    if ($role["id_role"] == $user["id_role"]) {
                                        echo $role['role_name'];
                                    }
                                }
                                ?>
                            <td>
                                <button class="btn-gt-edit-user-page btn btn-warning" data-id=<?= $user['id_user']; ?> data-bs-target="#modal" data-bs-toggle="modal">
                                    <i class=" fa-regular fa-pen-to-square"></i></button>
                                <button class="btn-delete-user btn btn-danger" data-id=<?= $user['id_user']; ?>>
                                    <i class="fa-solid fa-trash"></i></button>
                            </td>
                        </tr>
                    <?php
                    endforeach
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script type="module" src="<?= config::BASEURL ?>/public/assets/js/dynamic/user/user.js">
</script>