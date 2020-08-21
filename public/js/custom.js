    // display picture preview
    $(document).ready(function () {
        var default_img = $('#image-current').prop('src');
        $("#BtnBrowseHidden").on('change', function () {
            //Get count of selected files
            var countFiles = $(this)[0].files.length;
            var imgPath = $(this)[0].value;
            var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
            var image_holder = $("#image-holder");
            image_holder.empty();
            if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {
                if (typeof (FileReader) != "undefined") {
                    //loop for each file selected for uploaded.
                    for (var i = 0; i < countFiles; i++) {
                        var reader = new FileReader();
                        reader.onload = function (e) {
                            $("<img />", {
                                "src": e.target.result,
                                "class": "img-thumbnail",
                                "style": "height:150px;width:150px;"
                            }).appendTo(image_holder);
                        }
                        image_holder.show();
                        reader.readAsDataURL($(this)[0].files[i]);
                    }
                    W
                } else {
                    alert("This browser does not support FileReader.");
                }
            } else {
                swal({
                    title: "Please select image only",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                });
                $("<img />", {
                    "src": default_img,
                    "class": "img-thumbnail"
                }).appendTo(image_holder);
            }
        });
    });
    //search
    $(document).ready(function () {
        var path = config.routes;
        $('#search').typeahead({
            source: function (query, process) {
                return $.get(path, {
                    query: query
                }, function (data) {
                    return process(data);
                });
            }
        });
    });
    $(document).ready(function () {
        $('.add').click(function (e) {
            e.preventDefault();
            var dataid = e.target.parentNode.dataset['profile'];
            var data = {
                data_id: dataid
            }
            axios.post('/friend', data).then(function (response) {
                e.currentTarget.className = "btn btn-primary btn-sm pending disabled";
                e.currentTarget.innerText = "Pending";
                $('#btn-cancel').removeClass('disabled');
            }).catch((error) => {
                console.log(error);
            });
        });
    });
