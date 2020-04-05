function profileImageUpdate(event) {
    var reader = new FileReader();
    reader.onload = function () {
        var output = document.getElementById('outputImage');
        output.src = reader.result;
    }
    reader.readAsDataURL(event.target.files[0]);
}

function coverImageUpdate(event) {
    var reader = new FileReader();
    reader.onload = function () {
        var output = document.getElementById('outputCover');
        output.src = reader.result;
    }
    reader.readAsDataURL(event.target.files[0]);
}