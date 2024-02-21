// File: utilities.js

// Import modul lain yang mungkin Anda perlukan
import { config } from "./config.js";

export function validateInputAndSetClass(value, pattern, selector) {
  let isValid = true;
  let rgxLetterNumber = /^[a-zA-Z0-9\s]+$/;
  let rgxNumber = /^[0-9]+$/;
  let minLength = 1;
  switch (pattern) {
    case "1":
      if (!rgxLetterNumber.test(value) || value.length < minLength) {
        isValid = false;
      }
      break;
    case "2":
      if (!rgxNumber.test(value) || value.length < minLength) {
        isValid = false;
      }
      break;
    default:
      console.error("Pola validasi tidak valid.");
      isValid = false;
  }
  if (isValid) {
    $(selector).removeClass("is-invalid").addClass("is-valid");
  } else {
    $(selector).removeClass("is-valid").addClass("is-invalid");
  }
  return isValid;
}
//
export function validateForm(inputs) {
  let isValid = true;
  inputs.forEach((input) => {
    let data = ($(input.id).val() ?? "").trim();
    let isInputValid = validateInputAndSetClass(data, input.rule, input.id);
    if (!isInputValid) {
      isValid = false;
    }
  });
  return isValid;
}
// create , update data via form
export function sendFormData(formData, url, method) {
  return new Promise(function (res) {
    $.ajax({
      url: config.base_url + url,
      method: method,
      data: formData,
      processData: false,
      contentType: false,
      success: function (response) {
        console.log(response)
        res(response);
      },
      error: function (xhr, status, error) {
        console.error(xhr.responseText);
      },
    });
    console.log("Data berhasil divalidasi dan dikirim:", formData);
  });
}

// CRUD ( Send OBJECT data)
export function setRequest(data, url, method) {
  return new Promise(function (res) {
    $.ajax({
      url: config.base_url + url,
      method: method,
      data: data,
      success: function (response) {
        res(response);
      },
      error: function (xhr, status, error) {
        console.error(xhr.responseText);
      },
    });
  });
  // console.log("Data berhasil divalidasi dan dikirim:", data);
}

// Fungsi untuk memuat halaman utama
export function loadMain(endpoint) {
  return new Promise((resolve, reject) => {
    let url = config.base_url + endpoint;
    $("main").load(url, function (response, status, xhr) {
      if (status == "success") {
        resolve(); // Menyelesaikan promise jika pemuatan berhasil
      } else {
        reject(); // Menolak promise jika pemuatan gagal
      }
    });
  });
}

// Fungsi untuk memuat konten modal
export function loadModal(endpoint) {
  let url = config.base_url + endpoint;
  $(".modal-content").load(url);
}
