<?php

use app\config\config;
?>
<div class="modal-header">
    <h1 class="modal-title fs-5" id="exampleModalLabel">Add Product</h1>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <form id="form-submit" method="post" class="needs-validation" action="/manage-inventory/add-product-data">
        <table class="table rounded-3">
            <tr class="border-dark-subtle">
                <th>
                    <label for="product-name">Product Name </label>
                </th>
                <td>:</td>
                <td>
                    <input id="product-name" name="product-name" type="text" class="form-control border-dark-subtle" data-bs-container="body" data-bs-toggle="popover" data-bs-title="Error Occurred" data-bs-content="Name cannot be empty">
                    <div class="invalid-feedback"> Only letters, numbers, and at least 1 character are allowed</div>
                </td>
            </tr>
            <tr class="border-dark-subtle">
                <th>
                    <label for="unit">Unit </label>
                </th>
                <td>:</td>
                <td>

                    <select name="unit" id="unit" class="form-select border-dark-subtle">
                        <option disabled selected value="w"> Select Unit </option>
                        <?php foreach ($data as $value) : ?>
                            <option value=<?= $value['id_unit'] ?>><?= $value['unit_name'] ?></option>
                        <?php endforeach ?>
                    </select>
                    <div class="invalid-feedback"> Please select a unit first</div>
                </td>
            </tr>
            <tr class="border-dark-subtle">
                <th>
                    <label for="image">Image </label>
                </th>
                <td>:</td>
                <td>
                    <input id="image" name="image" type="file" class="form-control border-dark-subtle">
                    <div class="text-primary-emphasis"> Image can be left empty</div>
                </td>
            </tr>
            <tr class="border-dark-subtle">
                <th>
                    <label for="price">Price </label>
                </th>
                <td>:</td>
                <td>
                    <input id="price" name="price" type="text" class="form-control border-dark-subtle">
                    <div class="invalid-feedback"> Only numbers are allowed, and at least 1 character is required</div>
                </td>
            </tr>
        </table>
    </form>
</div>
<script defer>
</script>
<div class="modal-footer">
    <button id="btn-submit-product" class="btn btn-success" type="submit">Add</button>
</div>