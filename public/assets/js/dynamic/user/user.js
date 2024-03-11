import { config } from "../../modules/config.js";
import {
  loadMain,
  loadModal,
  validateForm,
  setRequest,
  sendFormData,
} from "../../modules/utilities.js";

$(document).ready(function () {
  class User {
    constructor() {
      console.log("User loaded");
      User.openAddUserModal();
      User.addProduct();
      User.deleteUser();
      User.openEditUserModal();
      User.editUser();
    }

    static openAddUserModal() {
      $(document).on("click", "#btn-gt-add-user-page", async function () {
        console.log("click");
        await loadModal("/user/add-user-page").then(function () {});
      });
    }

    static addProduct() {
      $(document).on("click", "#btn-add-user", async function () {
        console.log("clicked");
        const inputs = [
          { id: "#username", rule: "1" },
          { id: "#password", rule: "1" },
          { id: "#role", rule: "2" },
        ];
        // Melakukan validasi untuk setiap nilai
        let isValid = validateForm(inputs);

        // Jika semua data valid, lanjutkan dengan pengiriman data
        if (isValid) {
          console.log("valid");
          const formData = new FormData($("#form")[0]);
          let data = await sendFormData(
            formData,
            "/user/add-user-data",
            "post"
          ).then(function (res) {
            if (res.status == "success") {
              loadMain("/user/index").then(function () {
                Swal.fire({
                  title: "Good job!",
                  text: "You clicked the button!",
                  icon: "success",
                });
                $("#modal").modal("hide");
              });
            }
            if (res.status == "gagal") {
              Swal.fire({
                title: "Gagal!",
                text: res.message,
                icon: "warning",
              });
            }
          });
        }
      });
    }

    static deleteUser() {
      $(document).on("click", ".btn-delete-user", function () {
        let id = { id_user: $(this).attr("data-id") };
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
            let data = await setRequest(id, "/user/delete-user-data", "post");
            console.log(data);
            if (data.status == "success") {
              Swal.fire({
                title: "Deleted!",
                text: "Your file has been deleted.",
                icon: "success",
              });
              loadMain("/user/index").then(function () {});
            }
          }
        });
      });
    }
    static openEditUserModal() {
      $(document).on("click", ".btn-gt-edit-user-page", function () {
        loadModal("/user/edit-user-page", {
          id: $(this).attr("data-id"),
        });
      });
    }
    //
    static editUser() {
      $(document).on("click", "#btn-edit-user", async function () {
        console.log("clicked");
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
              { id: "#username", rule: "1" },
              { id: "#password", rule: "1" },
              { id: "#role", rule: "2" },
            ];
            // Melakukan validasi untuk setiap nilai
            let isValid = validateForm(inputs);
            console.log("clicked");
            // Jika semua data valid, lanjutkan dengan pengiriman data
            if (isValid) {
              const formData = new FormData($("#form")[0]);
              let data = await sendFormData(
                formData,
                "/user/edit-user-data",
                "post"
              ).then(function (res) {
                if (res.status == "success") {
                  loadMain("/user/index").then(function () {
                    Swal.fire({
                      title: "Update!",
                      text: "Your file has been updated.",
                      icon: "success",
                    });
                    $("#modal").modal("hide");
                  });
                }
              });
            }
          }
        });
      });
    }
  }

  // int user
  new User();
});
