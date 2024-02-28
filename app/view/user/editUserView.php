<?php
$dataUser = $data["data_user"];
$dataRole = $data["data_role"];
// pp($dataUser);
use app\config\config;
?>
<div class="modal-header">
    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit User</h1>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <form id="form" method="post" class="needs-validation" action="/manage-inventory/add-product-data">
        <table class="table rounded-3">
            <tr class="border-dark-subtle">
                <input type="hidden" name="id-user" value="<?= $dataUser['id_user'] ?>">
                <th>
                    <label for="username">username </label>
                </th>
                <td>:</td>
                <td>
                    <input id="username" name="username" value="<?= $dataUser['username'] ?>" type="text" class="form-control border-dark-subtle" data-bs-container="body" data-bs-toggle="popover" data-bs-title="Error Occurred" data-bs-content="Name cannot be empty">
                    <div class="invalid-feedback"> Only letters, numbers, and at least 1 character are allowed</div>
                </td>
            </tr>
            <tr class="border-dark-subtle">
                <th>
                    <label for="password">Password </label>
                </th>
                <td>:</td>
                <td>
                    <input id="password" name="password" value="<?= $dataUser['password'] ?>" type="text" class="form-control border-dark-subtle" data-bs-container="body" data-bs-toggle="popover" data-bs-title="Error Occurred" data-bs-content="Name cannot be empty">
                    <div class="invalid-feedback"> Only letters, numbers, and at least 1 character are allowed</div>
                </td>
            </tr>
            <tr class="border-dark-subtle">
                <th>
                    <label for="image">Image </label>
                </th>
                <td>:</td>
                <td>
                    <input id="image" name="image" type="file" class="form-control border-dark-subtle">
                    <div class="text-primary-emphasis"> The image can be left empty,
                        and below is the previous product image </div>
                    <div class="shadow-lg p-1 bg-body-tertiary rounded overflow-hidden d-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                        <?php
                        if ($dataUser['img'] != null) : ?>
                            <img src="<?= config::BASEURL ?>/public/uploaded/<?= $dataUser['img'] ?>" style="width: 100%; object-fit: scale-down;" alt="">
                        <?php else : ?>
                            <i class="fa-regular fa-image fs-2"></i>
                        <?php endif ?>
                    </div>
                </td>
            </tr>
            <tr class="border-dark-subtle">
                <th>
                    <label for="price">Role </label>
                </th>
                <td>:</td>
                <td>
                    <select name="role" id="role" class=" form-select form-select-sm border-dark-subtle">
                        <!-- <option disabled selected value="w"> Select Unit </option> -->
                        <?php foreach ($dataRole as $role) : ?>
                            <?php if ($role['id_role'] === $dataUser['id_role']) : ?>
                                <option selected value=<?= $role['id_role'] ?>><?= $role['role_name'] ?></option>
                            <?php else : ?>
                                <option value=<?= $role['id_role'] ?>><?= $role['role_name'] ?></option>
                            <?php endif; ?>
                        <?php endforeach ?>
                    </select>
                    <div class="invalid-feedback"> Select Role First!</div>
                </td>
            </tr>
        </table>
    </form>

</div>
<div class="modal-footer">
    <button id="btn-edit-user" class="btn btn-success" type="submit">Update</button>
</div>