// Modul untuk melakukan permintaan ke API
import { config } from "./config.js";

export function loadMain(endpoint) {
  let url = config.base_url + endpoint + "/index";
  $("main").load(url);
}
