(function ($) {
    "use strict";

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    // Dropzone initialization
    
    var dropped = Dropzone.options.myDropzone = {
        acceptedFiles: '.png, .jpg, .jpeg',
        //maxFiles: 1,
        url: storeUrl,
        //autoProcessQueue: false,
        // init: function() {
        //     this.on("addedfile", function(file) { 
        //         console.log(file);
        //         this.processQueue();
        //     });
        // },
        transformFile: function(file, done){
            var myDropZone = this;
            
            $('#cropModal').modal('show');
            
            if($('#cropModal').find('.modal-dialog')){
                $('#cropModal').find('.modal-dialog').addClass('w-100');
                $('#cropModal').find('.modal-dialog').removeClass('modal-lg');
                $('#cropModal').find('.modal-dialog').removeClass('modal-dialog');
            }
            
            let image = new Image();
            image.id = 'cropperImage';
            image.src = URL.createObjectURL(file);
            $('.image-container').append(image);
    
            let cropper = new Cropper(image, {
                width: 1170,
                height: 570,
                //aspectRatio: 1,
                viewMode: 3,
                zoomOnWheel: false,
                wheelZoomRatio: false,
                cropBoxResizable: false,
                scalable: false,
                zoomable: false,
                zoomOnTouch: false,
                preview: '.preview-image',
                minContainerWidth: 1170,
                minContainerHeight: 570,
            });
            
            $('#saveCroppedImage').on('click', function () {
                var canvas = cropper.getCroppedCanvas();
                
                canvas.toBlob(function(blob){
                    myDropZone.createThumbnail(
                        blob,
                        myDropZone.options.thumbnailWidth,
                        myDropZone.options.thumbnailHeight,
                        myDropZone.options.thumbnailMethod,
                        false, 
                        function(dataURL) {
                          
                          // Update the Dropzone file thumbnail
                          myDropZone.emit('thumbnail', file, dataURL);
                          // Return the file to Dropzone
                          done(blob);
                    });
                });
                
                $('#cropperImage').remove();
                $('.cropper-container').remove();
                
                $('#cropModal').modal('hide');
            });
        },
        success: function (file, response) {
            $("#sliders").append(`<input type="hidden" name="slider_images[]" id="slider${response.file_id}" value="${response.file_id}">`);

            // Create the remove button
            var removeButton = Dropzone.createElement("<button class='rmv-btn'><i class='fa fa-times'></i></button>");

            // Capture the Dropzone instance as closure.
            var _this = this;
            // Listen to the click event
            removeButton.addEventListener("click", function (e) {
                // Make sure the button click doesn't submit the form:
                e.preventDefault();
                e.stopPropagation();

                _this.removeFile(file);

                rmvimg(response.file_id);
            });

            // Add the button to the file preview element.
            file.previewElement.appendChild(removeButton);

            if (typeof response.error != 'undefined') {
                _this.removeFile(file);
                if (typeof response.file != 'undefined') {
                    let errorMsg = document.getElementById("errpreimg");
                    errorMsg.innerHTML += `<div class="text-dark alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>${response.file[0]} </strong>
                                <button type="button" class="close drop_zone_close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>`;
                    setTimeout(function () {
                        errorMsg.innerHTML = '';
                    }, 1000000);
                }
            }
        },
        error: function (response) {
        }
    };

    function rmvimg(fileid) {
        // If you want to the delete the file on the server as well,
        // you can do the AJAX request here.

        $.ajax({
            url: removeUrl,
            type: 'POST',
            data: {
                fileid: fileid
            },
            success: function (data) {
                $("#slider" + fileid).remove();
            }
        });

    }

    //   remove existing images
    $(document).on('click', '.rmvbtndb', function () {
        let indb = $(this).data('indb');
        $(".request-loader").addClass("show");
        $.ajax({
            url: rmvdbUrl,
            type: 'POST',
            data: {
                fileid: indb
            },
            success: function (data) {
                $(".request-loader").removeClass("show");
                var content = {};

                if (data == 'false') {
                    $(".request-loader").removeClass("show");
                    content.message = "You can't delete all images.!!";
                    content.title = 'Warning';
                } else {
                    $("#trdb" + indb).remove();
                    content.message = 'Slider image deleted successfully!';
                    content.title = 'Success';
                }

                content.icon = 'fa fa-bell';

                $.notify(content, {
                    type: 'success',
                    placement: {
                        from: 'top',
                        align: 'right'
                    },
                    showProgressbar: true,
                    time: 1000,
                    delay: 4000
                });
            }
        });
    });

    //   load event slider images
    if (loadImgs.length > 0) {
        $.get(loadImgs, function (data) {
            for (var i = 0; i < data.length; i++) {
                let msg = `<tr class="table-row" id="trdb${data[i].id}">
                            <td>
                                <img class="thumb-preview wf-150"
                                src="${baseUrl}/assets/admin/img/event-gallery/${data[i].image} " alt="slider image">
                            </td>
                            <td>
                                <i class="fas fa-times-circle rmvbtndb" data-indb="${data[i].id}"></i>
                            </td>
                        </tr>`;

                $("#img-table").append(msg);
            }
        });
    }

    if (typeof ProductloadImgs !== 'undefined'){
        //   load product slider images
        if (ProductloadImgs.length > 0) {
            $.get(ProductloadImgs, function (data) {
                for (var i = 0; i < data.length; i++) {
                    let msg = `<tr class="table-row" id="trdb${data[i].id}">
                                <td>
                                    <img class="thumb-preview wf-150"
                                    src="${baseUrl}/assets/admin/img/product/gallery/${data[i].image} " alt="slider image">
                                </td>
                                <td>
                                    <i class="fas fa-times-circle rmvbtndb" data-indb="${data[i].id}"></i>
                                </td>
                            </tr>`;
    
                    $("#img-table").append(msg);
                }
            });
        }

    }
})(jQuery);
