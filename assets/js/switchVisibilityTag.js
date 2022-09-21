import axios from "axios";

console.error("Ok pour admin switch");

let switchs = document.querySelectorAll("[data-switchs-active-tag]");

if (switchs) {
  switchs.forEach((element) => {
    element.addEventListener("change", () => {
      let tagId = element.value;

      axios.get(`/admin/categorie/switch/${tagId}`);
    });
  });
}
