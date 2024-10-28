const clearBtn = document.getElementById("clear-img-btn");
const previewHolder = document.querySelector(".avatar-preview");
const preview = document.getElementById("avatar-preview-img");
const imgInput = document.getElementById("img-input");

function previewImage(event) {
  previewHolder.classList.add("avatar-preview--uploaded");
  preview.src = URL.createObjectURL(event.target.files[0]);
}

function clearImage(event) {
  imgInput.value = "";
  previewHolder.classList.remove("avatar-preview--uploaded");
  preview.src = "";
}

imgInput.addEventListener("change", previewImage);
clearBtn.addEventListener("click", clearImage);
