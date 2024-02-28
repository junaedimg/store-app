<?php
$dataProduct = $data["data_product"];
$dataUnit = $data["data_unit"];
// pp($dataProduct);
use app\config\config;
?>
<div class="modal-header">
    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Product</h1>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <form id="form" method="post" class="needs-validation" action="/manage-inventory/add-product-data">
        <table class="table rounded-3">
            <tr class="border-dark-subtle">
                <input type="hidden" name="no-product" value="<?= $dataProduct['no_product'] ?>">
                <th>
                    <label for="product-name">Product Name </label>
                </th>
                <td>:</td>
                <td>
                    <input id="product-name" name="product-name" value="<?= $dataProduct['product_name'] ?>" type="text" class="form-control border-dark-subtle" data-bs-container="body" data-bs-toggle="popover" data-bs-title="Error Occurred" data-bs-content="Name cannot be empty">
                    <div class="invalid-feedback"> Only letters, numbers, and at least 1 character are allowed</div>
                </td>
            </tr>
            <tr class="border-dark-subtle">
                <th>
                    <label for="unit">Unit </label>
                </th>
                <td>:</td>
                <td>
                    <select name="unit" id="unit" class=" form-select form-select-sm border-dark-subtle">
                        <!-- <option disabled selected value="w"> Select Unit </option> -->
                        <?php foreach ($dataUnit as $value) : ?>
                            <?php if ($value['id_unit'] === $dataProduct['id_unit']) : ?>
                                <option selected value=<?= $value['id_unit'] ?>><?= $value['unit_name'] ?></option>
                            <?php else : ?>
                                <option value=<?= $value['id_unit'] ?>><?= $value['unit_name'] ?></option>
                            <?php endif; ?>
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
                    <div class="text-primary-emphasis"> The image can be left empty,
                        and below is the previous product image </div>
                    <div class="shadow-lg p-1 bg-body-tertiary rounded overflow-hidden d-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                        <?php
                        if ($dataProduct['img'] != null) : ?>
                            <img src="<?= config::BASEURL ?>/public/uploaded/<?= $dataProduct['img'] ?>" style="width: 100%; object-fit: scale-down;" alt="">
                        <?php else : ?>
                            <i class="fa-regular fa-image fs-2"></i>
                        <?php endif ?>
                    </div>
                </td>
            </tr>
            <tr class="border-dark-subtle">
                <th>
                    <label for="price">Price </label>
                </th>
                <td>:</td>
                <td>
                    <input id="price" name="price" type="text" class="form-control border-dark-subtle" value="<?= $dataProduct['price'] ?>">
                    <div class="invalid-feedback"> Only numbers are allowed, and at least 1 character is required</div>
                </td>
            </tr>
        </table>
    </form>
</div>
<script defer>
</script>
<div class="modal-footer">
    <button id="btn-edit-product" class="btn btn-success" type="submit">Update</button>
</div>