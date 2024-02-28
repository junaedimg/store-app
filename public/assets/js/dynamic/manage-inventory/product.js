// File: Product.js
import {
  loadMain,
  loadModal,
  validateForm,
  setRequest,
  sendFormData,
} from "../../modules/utilities.js";

export class Product {
  static init() {
    // Action
    Product.openAddProductModal();
    Product.goBackToInventory();
    Product.addProduct();
    Product.editProduct();
    Product.deleteProduct();
    Product.goToProductPage();
    Product.openEditProductModal();
  }
  //
  static goToProductPage() {
    $(document).on("click", "#btn-gt-product", function () {
      loadMain("/manage-inventory/list-product-page");
    });
  }
  //
  // static  () {
  //   let table = $("#table").DataTable({
  //     columnDefs: [
  //       {
  //         targets: 0,
  //         orderable: false,
  //       },
  //       {
  //         targets: 5,
  //         orderable: false,
  //       },
  //       {
  //         targets: 3,
  //         orderable: false,
  //       },
  //     ],
  //   });
  // }
  //
  static openAddProductModal() {
    $(document).on("click", "#btn-gt-add-product-page", function () {
      loadModal("/manage-inventory/add-product-page");
    });
  }
  static openEditProductModal() {
    $(document).on("click", ".btn-gt-edit-product-page", function () {
      loadModal("/manage-inventory/edit-product-page", {
        id: $(this).attr("data-id"),
      });
    });
  }
  //
  static addProduct() {
    $(document).on("click", "#btn-add-product", async function () {
      const inputs = [
        { id: "#product-name", rule: "1" },
        { id: "#unit", rule: "2" },
        { id: "#price", rule: "2" },
      ];
      // Melakukan validasi untuk setiap nilai
      let isValid = validateForm(inputs);

      // Jika semua data valid, lanjutkan dengan pengiriman data
      if (isValid) {
        const formData = new FormData($("#form")[0]);
        let data = await sendFormData(
          formData,
          "/manage-inventory/add-product-data",
          "post"
        ).then(function (res) {
          if (res.status == "success") {
            loadMain("/manage-inventory/list-product-page").then(function () {
              Swal.fire({
                title: "Good job!",
                text: "You clicked the button!",
                icon: "success",
              });
              $("#modal").modal("hide");
            });
          }
        });
      }
    });
  }
  //
  static editProduct() {
    $(document).on("click", "#btn-edit-product", async function () {
      Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, update it!",
      }).then(async (result) => {
        if (result.isConfirmed) {
          const inputs = [
            { id: "#product-name", rule: "1" },
            { id: "#unit", rule: "2" },
            { id: "#price", rule: "2" },
          ];
          // Melakukan validasi untuk setiap nilai
          let isValid = validateForm(inputs);
          console.log("clicked");
          // Jika semua data valid, lanjutkan dengan pengiriman data
          if (isValid) {
            const formData = new FormData($("#form")[0]);
            let data = await sendFormData(
              formData,
              "/manage-inventory/edit-product-data",
              "post"
            ).then(function (res) {
              if (res.status == "success") {
                loadMain("/manage-inventory/list-product-page").then(
                  function () {
                    Swal.fire({
                      title: "Update!",
                      text: "Your file has been updated.",
                      icon: "success",
                    });
                    $("#modal").modal("hide");
                  }
                );
              }
            });
          }
        }
      });
    });
  }
  //
  static deleteProduct() {
    $(document).on("click", ".btn-delete-product", function () {
      let id = { no_product: $(this).attr("data-id") };
      console.log("clicked");
      Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
      }).then(async (result) => {
        console.log(result);
        if (result.isConfirmed) {
          let data = await setRequest(
            id,
            "/manage-inventory/delete-product-data",
            "post"
          );
          console.log(data);
          if (data.status == "success") {
            Swal.fire({
              title: "Deleted!",
              text: "Your file has been deleted.",
              icon: "success",
            });
            loadMain("/manage-inventory/list-product-page").then(
              function () {}
            );
          }
        }
      });
    });
  }
  //
  static goBackToInventory() {
    $(document).on("click", "#btn-back-inventory", function () {
      loadMain("/manage-inventory/index");
    });
  }
  //
}
