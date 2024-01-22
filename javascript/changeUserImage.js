// Function to preview selected image
function previewImage(input) {
    let previewContainer = $("#imagePreview");
    let previewImage = previewContainer.find("img");

    if (input.files && input.files[0]) {
        let reader = new FileReader();

        reader.onload = function (e) {
            previewImage.attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
        previewContainer.show();
    } else {
        // previewImage.attr('src', '');
        previewContainer.hide();
    }
}

// Attach the previewImage function to the change event of the file input
$("#image").change(function () {
    previewImage(this);
});

document.addEventListener('DOMContentLoaded', function () {
    $("#imagePreview").hide();
})