import axios from "axios";

console.error("Ok pour admin switch");

let switchs = document.querySelectorAll("[data-switchs-active-article]");

if (switchs) {
  switchs.forEach((element) => {
    element.addEventListener("change", () => {
      let tagId = element.value;

      axios.get(`/admin/article/switch/${tagId}`);
    });
  });
}
