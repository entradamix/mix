"use strict";

// bootstrap notify start
function bootnotify(message, title, type) {
  var content = {};

  content.message = message;
  content.title = title;
  content.icon = 'fa fa-bell';

  $.notify(content, {
    type: type,
    placement: {
      from: 'top',
      align: 'right'
    },
    showProgressbar: true,
    time: 1000,
    allow_dismiss: true,
    delay: 4000
  });
}
// bootstrap notify end

function setFiles(file, input){
    // Create a data transfer object. Similar to what you get from a `drop` event as `event.dataTransfer`
    const dataTransfer = new DataTransfer();
    
    dataTransfer.items.add(file);
    
    // Save the file list to a new variable
    const fileList = dataTransfer.files;
    
    // Set your input `files` to the file list
    input.files = fileList;
}

var includes = ['edit-profile', 'scanner-management', 'promoter-management'];

/*****************************************************
==========Demo code end==========
******************************************************/

if (account_status == 1 || secret_login == 1) {
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
} else {
  $.ajaxSetup({
    beforeSend: function (jqXHR, settings) {
      if (settings.type == 'POST' && status == 0) {
        if ($(".request-loader").length > 0) {
          $(".request-loader").removeClass('show');
        }
        if ($(".modal").length > 0) {
          $(".modal").modal('hide');
        }
        if ($("button[disabled='disabled']").length > 0) {
          $("button[disabled='disabled']").removeAttr('disabled');
        }

        let content = {};

        content.message = 'Your account needs Admin approval!';
        content.title = 'Warning!';
        content.icon = 'fa fa-bell';

        $.notify(content, {
          type: 'warning',
          placement: {
            from: 'top',
            align: 'right'
          },
          showProgressbar: true,
          time: 1000,
          delay: 4000
        });

        jqXHR.abort(event);
      }
    },
    complete: function () {
      // hide progress spinner
      console.log('after ajax sent');
    }
  });
}

$(function ($) {

  // sidebar search start
  $(".sidebar-search").on('input', function () {
    let term = $(this).val().toLowerCase();

    if (term.length > 0) {
      $(".sidebar ul li.nav-item").each(function (i) {
        let menuName = $(this).find("p").text().toLowerCase();
        let $mainMenu = $(this);

        // if any main menu is matched
        if (menuName.indexOf(term) > -1) {
          $mainMenu.removeClass('d-none');
          $mainMenu.addClass('d-block');
        } else {
          let matched = 0;
          let count = 0;
          // search sub-items of the current main menu (which is not matched)
          $mainMenu.find('span.sub-item').each(function (i) {
            // if any sub-item is matched of the current main menu, set the flag
            if ($(this).text().toLowerCase().indexOf(term) > -1) {
              count++;
              matched = 1;
            }
          });

          // if any sub-item is matched  of the current main menu (which is not matched)
          if (matched == 1) {
            $mainMenu.removeClass('d-none');
            $mainMenu.addClass('d-block');
          } else {
            $mainMenu.removeClass('d-block');
            $mainMenu.addClass('d-none');
          }
        }
      });
    } else {
      $(".sidebar ul li.nav-item").addClass('d-block');
    }
  });
  // sidebar search end


  // disabling default behave of form submits start
  $("#ajaxEditForm").attr('onsubmit', 'return false');
  $("#ajaxForm").attr('onsubmit', 'return false');
  $("#ajaxForm2").attr('onsubmit', 'return false');
  $("#ajaxForm2").attr('onsubmit', 'return false');
  $("#eventForm").attr('onsubmit', 'return false');
  // disabling default behave of form submits end


  // bootstrap datepicker & jQuery timepicker init start
  $('.datepicker').datepicker({
    autoclose: true
  });

  $('.timepicker').timepicker();
  // bootstrap datepicker & jQuery timepicker init end


  // fontawesome icon picker start
  $('.icp-dd').iconpicker();
  // fontawesome icon picker end


  // summernote initialization start
  $(".summernote").each(function (i) {

    tinymce.init({
      selector: '.summernote',
      plugins: 'autolink charmap emoticons image link lists media searchreplace table visualblocks wordcount',
      toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
      tinycomments_mode: 'embedded',
      tinycomments_author: 'Author name',
      promotion: false,
      mergetags_list: [
        { value: 'First.Name', title: 'First Name' },
        { value: 'Email', title: 'Email' },
      ]
    });

  });




  $(document).on('click', ".note-video-btn", function () {
    let i = $(this).index();

    if ($(".summernote").eq(i).parents(".modal").length > 0) {
      setTimeout(() => {
        $("body").addClass('modal-open');
      }, 500);
    }
  });
  // summernote initialization end


  // Form Submit with AJAX Request Start
  $("#submitBtn").on('click', function (e) {
    $(e.target).attr('disabled', true);
    $(".request-loader").addClass("show");

    if ($(".iconpicker-component").length > 0) {
      $("#inputIcon").val($(".iconpicker-component").find('i').attr('class'));
    }

    let ajaxForm = document.getElementById('ajaxForm');
    let fd = new FormData(ajaxForm);
    let url = $("#ajaxForm").attr('action');
    let method = $("#ajaxForm").attr('method');

    //if summernote has then get summernote content
    $('.form-control').each(function (i) {
      let index = i;

      let $toInput = $('.form-control').eq(index);

      if ($(this).hasClass('summernote')) {
        let tmcId = $toInput.attr('id');
        let content = tinyMCE.get(tmcId).getContent();

        fd.delete($(this).attr('name'));
        fd.append($(this).attr('name'), content);
      }
    });

    $.ajax({
      url: url,
      method: method,
      data: fd,
      contentType: false,
      processData: false,
      success: function (data) {
        $(e.target).attr('disabled', false);
        $('.request-loader').removeClass('show');

        $('.em').each(function () {
          $(this).html('');
        });

        if (data.status == 'success') {
          location.reload();
        }
      },
      error: function (error) {
        $('.em').each(function () {
          $(this).html('');
        });

        for (let x in error.responseJSON.errors) {
          document.getElementById('err_' + x).innerHTML = error.responseJSON.errors[x][0];
        }

        $('.request-loader').removeClass('show');
        $(e.target).attr('disabled', false);
      }
    });
  });
  // Form Submit with AJAX Request End

  // Form Submit with AJAX Request Start
  $("#submitBtn2").on('click', function (e) {
    $(".request-loader").addClass("show");
    if ($(".iconpicker-component").length > 0) {
      $("#inputIcon").val($(".iconpicker-component").find('i').attr('class'));
    }

    let ajaxForm = document.getElementById('ajaxForm2');
    let fd = new FormData(ajaxForm);
    let url = $("#ajaxForm2").attr('action');
    let method = $("#ajaxForm2").attr('method');

    //if summernote has then get summernote content
    $('.form-control').each(function (i) {
      let index = i;

      let $toInput = $('.form-control').eq(index);

      if ($(this).hasClass('summernote')) {
        let tmcId = $toInput.attr('id');
        let content = tinyMCE.get(tmcId).getContent();

        fd.delete($(this).attr('name'));
        fd.append($(this).attr('name'), content);
      }
    });

    $.ajax({
      url: url,
      method: method,
      data: fd,
      contentType: false,
      processData: false,
      success: function (data) {
        $(e.target).attr('disabled', false);
        $('.request-loader').removeClass('show');

        $('.em').each(function () {
          $(this).html('');
        });

        if (data.status == 'success') {
          location.reload();
        }
      },
      error: function (error) {
        $('.em').each(function () {
          $(this).html('');
        });

        for (let x in error.responseJSON.errors) {
          document.getElementById('err_' + x).innerHTML = error.responseJSON.errors[x][0];
        }

        $('.request-loader').removeClass('show');
        $(e.target).attr('disabled', false);
      }
    });
  });
  // Form Submit with AJAX Request End

  // Form Submit with AJAX Request Start
  $("#submitBtn3").on('click', function (e) {
    $(e.target).attr('disabled', true);
    $(".request-loader").addClass("show");

    if ($(".iconpicker-component").length > 0) {
      $("#inputIcon").val($(".iconpicker-component").find('i').attr('class'));
    }

    let ajaxForm = document.getElementById('ajaxForm');
    let fd = new FormData(ajaxForm);
    let url = $("#ajaxForm").attr('action');
    let method = $("#ajaxForm").attr('method');

    //if summernote has then get summernote content
    $('.form-control').each(function (i) {
      if ($(this).hasClass('summernote')) {
        let content = tinyMCE.activeEditor.getContent();

        fd.delete($(this).attr('name'));
        fd.append($(this).attr('name'), content);
      }
    });

    $.ajax({
      url: url,
      method: method,
      data: fd,
      contentType: false,
      processData: false,
      success: function (data) {
        $(e.target).attr('disabled', false);
        $('.request-loader').removeClass('show');

        $('.em').each(function () {
          $(this).html('');
        });

        if (data.status == 'success') {
          location.reload();
        }
      },
      error: function (error) {
        $('.em').each(function () {
          $(this).html('');
        });

        for (let x in error.responseJSON.errors) {
          document.getElementById('err_' + x).innerHTML = error.responseJSON.errors[x][0];
        }

        $('.request-loader').removeClass('show');
        $(e.target).attr('disabled', false);
      }
    });
  });
  // Form Submit with AJAX Request End


  // Form Prepopulate After Clicking Edit Button Start
  $(".editBtn").on('click', function () {
    let datas = $(this).data();
    delete datas['toggle'];

    for (let x in datas) {
      if ($("#in_" + x).hasClass('summernote')) {
        tinyMCE.activeEditor.setContent(datas[x])
      } else if ($("#in_" + x).data('role') == 'tagsinput') {
        if (datas[x].length > 0) {
          let arr = datas[x].split(" ");
          for (let i = 0; i < arr.length; i++) {
            $("#in_" + x).tagsinput('add', arr[i]);
          }
        } else {
          $("#in_" + x).tagsinput('removeAll');
        }
      } else if ($("#in_" + x).hasClass('select2')) {
        $("#in_" + x).val(datas[x]);
        $("#in_" + x).trigger('change');
      } else if ($("input[name='" + x + "']").attr('type') == 'radio') {
        $("input[name='" + x + "']").each(function (i) {
          if ($(this).val() == datas[x]) {
            $(this).prop('checked', true);
          }
        });
      } else {
        $("#in_" + x).val(datas[x]);

        if ($('.in_image').length > 0) {
          $('.in_image').attr('src', datas['image']);
        }

        if ($('#in_icon').length > 0) {
          $('#in_icon').attr('class', datas['icon']);
        }
      }
    }


    if ('edit' in datas && datas.edit === 'editAdvertisement') {
      if (datas.ad_type === 'banner') {
        if (!$('#edit-slot-input').hasClass('d-none')) {
          $('#edit-slot-input').addClass('d-none');
        }

        $('#edit-image-input').removeClass('d-none');
        $('#edit-url-input').removeClass('d-none');
      } else {
        if (!$('#edit-image-input').hasClass('d-none') && !$('#edit-url-input').hasClass('d-none')) {
          $('#edit-image-input').addClass('d-none');
          $('#edit-url-input').addClass('d-none');
        }

        $('#edit-slot-input').removeClass('d-none');
      }
    }


    // focus & blur colorpicker inputs
    setTimeout(() => {
      $(".jscolor").each(function () {
        $(this).focus();
        $(this).blur();
      });
    }, 300);
  });
  // Form Prepopulate After Clicking Edit Button End

  $('#organizerSettingBtn').on('click', function () {
    $('#organizerSettingForm').submit();
  });

  // Form Update with AJAX Request Start
  $("#updateBtn").on('click', function (e) {
    $(".request-loader").addClass("show");

    if ($(".edit-iconpicker-component").length > 0) {
      $("#editInputIcon").val($(".edit-iconpicker-component").find('i').attr('class'));
    }

    let ajaxEditForm = document.getElementById('ajaxEditForm');
    let fd = new FormData(ajaxEditForm);
    let url = $("#ajaxEditForm").attr('action');
    let method = $("#ajaxEditForm").attr('method');

    //if summernote has then get summernote content
    $('.form-control').each(function (i) {
      let index = i;

      let $toInput = $('.form-control').eq(index);

      if ($(this).hasClass('summernote')) {
        let tmcId = $toInput.attr('id');
        let content = tinyMCE.get(tmcId).getContent();

        fd.delete($(this).attr('name'));
        fd.append($(this).attr('name'), content);
      }
    });

    $.ajax({
      url: url,
      method: method,
      data: fd,
      contentType: false,
      processData: false,
      success: function (data) {
        $('.request-loader').removeClass('show');
        $(e.target).attr('disabled', false);

        $('.em').each(function () {
          $(this).html('');
        });

        if (data.status == 'success') {
          location.reload();
        }
      },
      error: function (error) {
        $('.em').each(function () {
          $(this).html('');
        });

        for (let x in error.responseJSON.errors) {
          document.getElementById('editErr_' + x).innerHTML = error.responseJSON.errors[x][0];
        }

        $('.request-loader').removeClass('show');
        $(e.target).attr('disabled', false);
      }
    });
  });

  $("#updateBtn2").on('click', function (e) {
    e.preventDefault();
    $(".request-loader").addClass("show");

    if ($(".edit-iconpicker-component").length > 0) {
      $("#editInputIcon").val($(".edit-iconpicker-component").find('i').attr('class'));
    }

    let ajaxEditForm = document.getElementById('ajaxEditForm2');
    let fd = new FormData(ajaxEditForm);
    let url = $("#ajaxEditForm2").attr('action');
    let method = $("#ajaxEditForm2").attr('method');

    //if summernote has then get summernote content
    $('.form-control').each(function (i) {
      let index = i;

      let $toInput = $('.form-control').eq(index);

      if ($(this).hasClass('summernote')) {
        let tmcId = $toInput.attr('id');
        let content = tinyMCE.get(tmcId).getContent();

        fd.delete($(this).attr('name'));
        fd.append($(this).attr('name'), content);
      }
    });

    $.ajax({
      url: url,
      method: method,
      data: fd,
      contentType: false,
      processData: false,
      success: function (data) {
        $('.request-loader').removeClass('show');
        $(e.target).attr('disabled', false);

        $('.em').each(function () {
          $(this).html('');
        });

        if (data.status == 'success') {
          location.reload();
        }
      },
      error: function (error) {
        $('.em').each(function () {
          $(this).html('');
        });

        for (let x in error.responseJSON.errors) {
          document.getElementById('editErr_' + x).innerHTML = error.responseJSON.errors[x][0];
        }

        $('.request-loader').removeClass('show');
        $(e.target).attr('disabled', false);
      }
    });
  });
  // Form Update with AJAX Request End


  // Delete Using AJAX Request Start
  $('.deleteBtn').on('click', function (e) {
    e.preventDefault();
    $(".request-loader").addClass("show");

    swal({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      type: 'warning',
      buttons: {
        confirm: {
          text: 'Yes, delete it',
          className: 'btn btn-success'
        },
        cancel: {
          visible: true,
          className: 'btn btn-danger'
        }
      }
    }).then((Delete) => {
      if (Delete) {
        $(this).parent(".deleteForm").submit();
      } else {
        swal.close();
        $(".request-loader").removeClass("show");
      }
    });
  });
  // Delete Using AJAX Request End

  // Delete Using AJAX Request Start
  $('.deleteBtn').on('click', function (e) {
    e.preventDefault();
    $(".request-loader").addClass("show");

    swal({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      type: 'warning',
      buttons: {
        confirm: {
          text: 'Yes, delete it',
          className: 'btn btn-success'
        },
        cancel: {
          visible: true,
          className: 'btn btn-danger'
        }
      }
    }).then((Delete) => {
      if (Delete) {
        $(this).parent(".deleteForm").submit();
      } else {
        swal.close();
        $(".request-loader").removeClass("show");
      }
    });
  });
  // Delete Using AJAX Request End


  // update payment status Using AJAX Request Start
  $('.paymentStatusBtn').on('change', function (e) {
    e.preventDefault();
    $(".request-loader").addClass("show");

    swal({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      type: 'warning',
      buttons: {
        confirm: {
          text: 'Yes, Change Status',
          className: 'btn btn-success'
        },
        cancel: {
          visible: true,
          className: 'btn btn-danger'
        }
      }
    }).then((Delete) => {
      if (Delete) {
        $(this).parent(".paymentStatusForm").submit();
      } else {
        swal.close();
        $(".request-loader").removeClass("show");
      }
    });
  });
  // update payment status Using AJAX Request End

  // ticket close Request Start
  $('.TicketCloseBtn').on('click', function (e) {
    e.preventDefault();
    $(".request-loader").addClass("show");

    swal({
      title: 'Are you sure?',
      type: 'warning',
      buttons: {
        confirm: {
          text: 'Yes, Close it',
          className: 'btn btn-success'
        },
        cancel: {
          visible: true,
          className: 'btn btn-danger'
        }
      }
    }).then((Delete) => {
      if (Delete) {
        $(this).parent(".closeForm").submit();
      } else {
        swal.close();
        $(".request-loader").removeClass("show");
      }
    });
  });
  // ticket close Request End

  //withdraw request start
  $('.confirmBtn').on('click', function (e) {
    e.preventDefault();
    swal({
      title: 'Are you sure?',
      type: 'warning',
      buttons: {
        confirm: {
          text: 'Yes',
          className: 'btn btn-success'
        },
        cancel: {
          visible: true,
          className: 'btn btn-danger'
        }
      }
    }).then((Delete) => {
      if (Delete) {
        let location = $(this).attr('href');
        window.location.replace(location);
      } else {
        swal.close();
      }
    });
  });
  //withdraw request start end


  // Bulk Delete Using AJAX Request Start
  $(".bulk-check").on('change', function () {
    let val = $(this).data('val');
    let checked = $(this).prop('checked');

    // if selected checkbox is 'all' then check all the checkboxes
    if (val == 'all') {
      if (checked) {
        $(".bulk-check").each(function () {
          $(this).prop('checked', true);
        });
      } else {
        $(".bulk-check").each(function () {
          $(this).prop('checked', false);
        });
      }
    }

    // if any checkbox is checked then flag = 1, otherwise flag = 0
    let flag = 0;

    $(".bulk-check").each(function () {
      let status = $(this).prop('checked');

      if (status) {
        flag = 1;
      }
    });

    // if any checkbox is checked then show the delete button
    if (flag == 1) {
      $(".bulk-delete").addClass('d-inline-block');
      $(".bulk-delete").removeClass('d-none');
    } else {
      // if no checkbox is checked then hide the delete button
      $(".bulk-delete").removeClass('d-inline-block');
      $(".bulk-delete").addClass('d-none');
    }
  });

  $('.bulk-delete').on('click', function () {
    swal({
      title: 'Are you sure?',
      text: "You won't be able to revert this",
      type: 'warning',
      buttons: {
        confirm: {
          text: 'Yes, delete it',
          className: 'btn btn-success'
        },
        cancel: {
          visible: true,
          className: 'btn btn-danger'
        }
      }
    }).then((Delete) => {
      if (Delete) {
        $(".request-loader").addClass('show');
        let href = $(this).data('href');
        let ids = [];

        // take ids of checked one's
        $(".bulk-check:checked").each(function () {
          if ($(this).data('val') != 'all') {
            ids.push($(this).data('val'));
          }
        });

        let fd = new FormData();
        for (let i = 0; i < ids.length; i++) {
          fd.append('ids[]', ids[i]);
        }

        $.ajax({
          url: href,
          method: 'POST',
          data: fd,
          contentType: false,
          processData: false,
          success: function (data) {
            $(".request-loader").removeClass('show');

            if (data.status == "success") {
              location.reload();
            }
          }
        });
      } else {
        swal.close();
      }
    });
  });
  // Bulk Delete Using AJAX Request End


  // DataTable Start
  $('#basic-datatables').DataTable({
    ordering: false,
    responsive: true
  });
  // DataTable End

  // Uploaded Image Preview Start
  $('.img-input').on('change', function (event) {
    let file = event.target.files[0];
    
    let reader = new FileReader();
    
    reader.onload = function (e) {
        $('#cropModal').modal('show');
        
        if($('#cropModal').find('.w-100')){
            $('#cropModal').find('.w-100').addClass('modal-dialog');
            $('#cropModal').find('.w-100').addClass('modal-lg');
            $('#cropModal').find('.w-100').removeClass('w-100');
        }
      
        let image = new Image();
        image.id = 'cropperImage';
        image.src = e.target.result;
        $('.image-container').append(image);

        //let image = document.getElementById('cropperImage');
        let inputFile = document.getElementById('img-input');
        
        let width =  location.pathname.split('/').includes(includes) ? 300 : 320;
        let height = location.pathname.split('/').includes(includes) ? 300 : 230;
        
        let cropper = new Cropper(image, {
            width: width,
            height: height,
            //aspectRatio: 1,
            viewMode: 3,
            zoomOnWheel: false,
            wheelZoomRatio: false,
            cropBoxResizable: false,
            scalable: false,
            zoomable: false,
            zoomOnTouch: false,
            preview: '.preview-image',
            minContainerWidth: width,
            minContainerHeight: height,
        });
        
        $('#saveCroppedImage').on('click', function () {
            cropper.getCroppedCanvas({ width: width, height: height}).toBlob(function(blob){
                let fileType = inputFile.value.split('.').pop();
                let file = new File([blob], `image_thumb.${fileType}`, {
                    type: `image/${fileType}`
                });
                setFiles(file, inputFile);
            });
            
            var croppedDataURL = cropper.getCroppedCanvas().toDataURL();
            
            $('.uploaded-img').attr('src', croppedDataURL);
            
            $('#cropModal').modal('hide');
            $('#cropperImage').remove();
            $('.cropper-container').remove();
        });
    }
    reader.readAsDataURL(file);
  });
  // Uploaded Image Preview End
  
  // Uploaded Image Cover Preview Start
  $('.img-input-cover').on('change', function (event) {
        let file = event.target.files[0];
        let reader = new FileReader();

    reader.onload = function (e) {
        $('#cropModal').modal('show');
      
        let image = new Image();
        image.id = 'cropperImage';
        image.src = e.target.result;
        $('.image-container').append(image);

        //var image = document.getElementById('cropperImage');
        var inputFile = document.getElementById('img-input-cover');
        
        let width =  localtion.pathname.split('/').includes(includes) ? 300 : 320;
        let height = localtion.pathname.split('/').includes(includes) ? 300 : 230;
        
        let cropper = new Cropper(image, {
            width: width,
            height: height,
            //aspectRatio: 1,
            viewMode: 3,
            zoomOnWheel: false,
            wheelZoomRatio: false,
            cropBoxResizable: false,
            scalable: false,
            zoomable: false,
            zoomOnTouch: false,
            preview: '.preview-image',
            minContainerWidth: width,
            minContainerHeight: height,
        });
        
        $('#saveCroppedImage').on('click', function () {
            cropper.getCroppedCanvas({ width: width, height: height}).toBlob(function(blob){
                let fileType = inputFile.value.split('.').pop();
                let file = new File([blob], `image_thumb.${fileType}`, {
                    type: `image/${fileType}`
                });
                setFiles(file, inputFile);
            });
            
            var croppedDataURL = cropper.getCroppedCanvas().toDataURL();
            
            $('.uploaded-img').attr('src', croppedDataURL);
            
            $('#cropModal').modal('hide');
            $('#cropperImage').remove();
            $('.cropper-container').remove();
        });
    };

    reader.readAsDataURL(file);
  });
  // Uploaded Image Cover Preview End
  
  // Uploaded Image Preview 2 Start
  $('.img-input2').on('change', function (event) {
    let file = event.target.files[0];
    let reader = new FileReader();

    reader.onload = function (e) {
      $('.uploaded-img2').attr('src', e.target.result);
    };

    reader.readAsDataURL(file);
  });
  // Uploaded Image Preview 2 End

  // Uploaded Image Preview 3 Start
  $('.img-input3').on('change', function (event) {
    let file = event.target.files[0];
    let reader = new FileReader();

    reader.onload = function (e) {
      $('.uploaded-img3').attr('src', e.target.result);
    };

    reader.readAsDataURL(file);
  });
  // Uploaded Image Preview 3 End


  // Uploaded Background Image Preview Start
  $('.background-img-input').on('change', function (event) {
    let file = event.target.files[0];
    let reader = new FileReader();

    reader.onload = function (e) {
      $('.uploaded-background-img').attr('src', e.target.result);
    };

    reader.readAsDataURL(file);
  });
  // Uploaded Background Image Preview End


  // Change Input Direction Start
  $('select[name="language_id"]').on('change', function () {
    $('.request-loader').addClass('show');
    
    let role = location.pathname.includes('organizer') ? 'organizer' : 'admin';

    let rtlURL = `${baseUrl}/${role}/language-management/${$(this).val()}/check-rtl`;

    // send ajax request to check whether the selected language is 'rtl' or not
    $.get(rtlURL, function (response) {
      $('.request-loader').removeClass('show');

      if ('successData' in response) {
        if (response.successData == 1) {
          $('form.create input').each(function () {
            if (!$(this).hasClass('ltr')) {
              $(this).addClass('rtl');
            }
          });

          $('form.create select').each(function () {
            if (!$(this).hasClass('ltr')) {
              $(this).addClass('rtl');
            }
          });

          $('form.create textarea').each(function () {
            if (!$(this).hasClass('ltr')) {
              $(this).addClass('rtl');
            }
          });

          $('form.create .note-editor.note-frame .note-editing-area .note-editable').each(function () {
            if (!$(this).hasClass('ltr')) {
              $(this).addClass('rtl');
            }
          });
        } else {
          $('form.create input, form.create select, form.create textarea, form.create .note-editor.note-frame .note-editing-area .note-editable').removeClass('rtl');
        }
      } else {
        alert(response.errorData);
      }
    });
  });
  // Change Input Direction End


  // select2
  if ($('.select2').length > 0) {
    $('.select2').select2();
  }
  if ($('.select2_2').length > 0) {
    $('.select2_2').select2();
  }

  /*------------------------
   Highlight Js
  -------------------------- */
  hljs.initHighlightingOnLoad();
});

function cloneInput(fromId, toId, event) {
  let $target = $(event.target);

  if ($target.is(':checked')) {
    $('#' + fromId + ' .form-control').each(function (i) {
      let index = i;
      let val = $(this).val();

      let $toInput = $('#' + toId + ' .form-control').eq(index);

      if ($(this).hasClass('summernote')) {
        let val = tinyMCE.activeEditor.getContent();
        let tmcId = $toInput.attr('id');
        tinyMCE.get(tmcId).setContent(val);

      } else if ($(this).data('role') == 'tagsinput') {
        if (val.length > 0) {
          let tags = val.split(',');
          tags.forEach(tag => {
            $toInput.tagsinput('add', tag);
          });
        } else {
          $toInput.tagsinput('removeAll');
        }
      } else {
        $toInput.val(val);
      }
    });
  } else {
    $('#' + toId + ' .form-control').each(function (i) {
      let index = i;

      let $toInput = $('#' + toId + ' .form-control').eq(index);

      if ($(this).hasClass('summernote')) {
        let tmcId = $toInput.attr('id');
        tinyMCE.get(tmcId).setContent('');

      } else if ($(this).data('role') == 'tagsinput') {
        $toInput.tagsinput('removeAll');
      } else {
        $toInput.val('');
      }
    });
  }
}



// Form Submit with AJAX Request Start
$("#EventSubmit").on('click', function (e) {
  $(e.target).attr('disabled', true);
  $(".request-loader").addClass("show");

  if ($(".iconpicker-component").length > 0) {
    $("#inputIcon").val($(".iconpicker-component").find('i').attr('class'));
  }

  let eventForm = document.getElementById('eventForm');
  let fd = new FormData(eventForm);
  let url = $("#eventForm").attr('action');
  let method = $("#eventForm").attr('method');

  //if summernote has then get summernote content
  $('.form-control').each(function (i) {
    let index = i;

    let $toInput = $('.form-control').eq(index);

    if ($(this).hasClass('summernote')) {
      let tmcId = $toInput.attr('id');
      let content = tinyMCE.get(tmcId).getContent();

      fd.delete($(this).attr('name'));
      fd.append($(this).attr('name'), content);
    }
  });

  $.ajax({
    url: url,
    method: method,
    data: fd,
    contentType: false,
    processData: false,
    success: function (data) {
      $(e.target).attr('disabled', false);
      $('.request-loader').removeClass('show');

      $('.em').each(function () {
        $(this).html('');
      });

    //   if (data.status == 'success' && !data.redirect) {
    //     location.reload();
    //   }else{
    //     location.href = data.redirect;
    //   }
    },
    error: function (error) {
      let errors = ``;

      for (let x in error.responseJSON.errors) {
        errors += `<li>
                <p class="text-danger mb-0">${error.responseJSON.errors[x][0]}</p>
              </li>`;
      }

      $('#eventErrors ul').html(errors);
      $('#eventErrors').show();

      $('.request-loader').removeClass('show');

      $('html, body').animate({
        scrollTop: $('#eventErrors').offset().top - 100
      }, 1000);
    }

  });
  $(e.target).attr('disabled', false);
});
// Form Submit with AJAX Request End

function storeLesson(event, moduleId) {
  event.preventDefault();
  $('.request-loader').addClass('show');

  let lessonForm = $('#lessonForm-' + moduleId)[0];
  let fd = new FormData(lessonForm);
  let url = $('#lessonForm-' + moduleId).attr('action');
  let type = $('#lessonForm-' + moduleId).attr('method');

  $.ajax({
    url: url,
    type: type,
    data: fd,
    contentType: false,
    processData: false,
    dataType: 'json',
    success: function (data) {
      $('.request-loader').removeClass('show');

      $('.em').each(function () {
        $(this).html('');
      });

      if (data.status == 'success') {
        location.reload();
      }
    },
    error: function (error) {
      $('.em').each(function () {
        $(this).html('');
      });

      for (let x in error.responseJSON.errors) {
        $('#err_' + x + '-' + moduleId).text(error.responseJSON.errors[x][0]);
      }

      $('.request-loader').removeClass('show');
    }
  });
}




//modal form add and edit

// Form Submit with AJAX Request Start
$("#modalSubmit").on('click', function (e) {

  if ($(".iconpicker-component").length > 0) {
    $("#inputIcon").val($(".iconpicker-component").find('i').attr('class'));
  }

  let modalForm = document.getElementById('modalForm');
  let fd = new FormData(modalForm);
  let url = $("#modalForm").attr('action');
  let method = $("#modalForm").attr('method');

  //if summernote has then get summernote content
  $('.form-control').each(function (i) {
    let index = i;

    let $toInput = $('.form-control').eq(index);

    if ($(this).hasClass('summernote')) {
      let tmcId = $toInput.attr('id');
      let content = tinyMCE.get(tmcId).getContent();

      fd.delete($(this).attr('name'));
      fd.append($(this).attr('name'), content);
    }
  });

  $.ajax({
    url: url,
    method: method,
    data: fd,
    contentType: false,
    processData: false,
    success: function (data) {
      $('.request-loader').removeClass('show');

      $('.em').each(function () {
        $(this).html('');
      });

      if (data.status == 'success') {
        location.reload();
      }
    },
    error: function (error) {
      $('.em').each(function () {
        $(this).html('');
      });

      for (let x in error.responseJSON.errors) {
        $('#err_' + x).text(error.responseJSON.errors[x][0]);
      }

      $('.request-loader').removeClass('show');
    }
  });
  $(e.target).attr('disabled', false);
});
//country_id
$('body').on('change', '#country_id', function () {
  $('.request-loader').addClass('show');
  $.get(baseUrl + '/admin/get-state-city/' + $(this).val(), function (data, status) {
    $('#city option').remove();
    $('#state option').remove();
    $.each(data.city, function (key, value) {
      $("#city").append($('<option></option>').val(value.id).html(value.name));
    });
    $.each(data.state, function (key, value) {
      $("#state").append($('<option></option>').val(value.id).html(value.name));
    });
    $('.request-loader').removeClass('show');
  });
});

$('body').on('change', '#fileType', function () {
  var val = $(this).val();
  if (val == 'link') {
    $('#downloadFile').addClass('d-none');
    $('#downloadLink').removeClass('d-none');
  } else if (val == 'upload') {
    $('#downloadFile').removeClass('d-none');
    $('#downloadLink').addClass('d-none');
  }
});

//
let elem = document.querySelector(".messages-container")
if (elem) {
  elem.scrollTop = elem.scrollHeight;
}

//

$(document).ready(function () {
  $("#organizer_admin_approval").click(function () {
    if ($('#organizer_admin_approval').is(":checked")) {
      $('.admin_approval_notice').removeClass('d-none');
    } else {
      $('.admin_approval_notice').addClass('d-none');
    }
  });
})

$(window).on('load', function () {
  $(".summernote").each(function (i) {
    let $this = $(this);
    if ($this.parents(".form-group.rtl").length > 0) {
      $("#" + $this.attr('id') + "_ifr").contents().find('html').attr('dir', 'rtl');
      $("#" + $this.attr('id') + "_ifr").contents().find('body').css('text-align', 'right');
      $("#" + $this.attr('id') + "_ifr").contents().find('body *').css('text-align', 'right');
    }
  });
});

/*------------------------
  Whats Connect Js
-------------------------- */

var base_api_url = "https://chatboty.com.br";
var device_id = $('input[name="device_id"]').val();
var device_uuid = $('input[name="device_uuid"]').val();
var device_status = $('input[name="device_status"]').val();
var attampt = 0;
var session_attampt = 0;
var sessionMake, checkSessionRecurr, currentLocation, result;

var utilities = {
  createSession: function createSession() {
    attampt++;

    if (attampt == 6) {
      clearInterval(sessionMake);
      $(".device-qrcode-img").attr("src", "".concat(base_api_url, "/uploads/waiting.jpeg"));
      var html = '<i class="fas fa-exclamation-circle"></i>';
      html += "Time Expired For Logged In Please Reload This Page";
      $(".alert.alert-info.alert-icon").html(html);
      return false;
    } //sending ajax request


    $.ajax({
      type: "POST",
      url: `${base_api_url}/api/device/qrcode`,
      data: {
        uuid: device_uuid
      },
      success: function success(response) {
        $(".device-qrcode-img").attr("src", response.qr);
      },
      error: function error(xhr, status, _error) {
        $(".device-qrcode-img").attr("src", `${base_api_url}/uploads/disconnect.webp`);

        if (xhr.status == 500) {
          clearInterval(checkSessionRecurr);
          clearInterval(sessionMake);
        }
      }
    });
  },
  checkSession: function checkSession() {
    session_attampt++;

    if (session_attampt >= 10) {
      clearInterval(checkSessionRecurr);
      return false;
    }

    $.ajax({
      type: "POST",
      url: `${base_api_url}/api/device/check/session/${device_uuid}`,
      success: function success(response) {
        if (response.connected === true) {
          clearInterval(checkSessionRecurr);
          clearInterval(sessionMake);

          if (device_id == "") {
            $.ajax({
              url: `${location.href}/device/create/app`,
              type: "POST",
              success: function success(response) {
                if (response.status === 1) {
                  $(".device-qrcode-img").attr("src", `${base_api_url}/uploads/connected.png`);
                }
              },
              error: function error(xhr, status, _error2) {
                if (xhr.status == 500) {
                  clearInterval(checkSessionRecurr);
                  clearInterval(sessionMake);
                  $(".device-qrcode-img").attr("src", `${base_api_url}/uploads/disconnect.webp`);
                }
              }
            });
          }
        } else {
          session_attampt == 1 ? utilities.createSession() : "";
        }
      },
      error: function error(xhr, status, _error3) {
        if (xhr.status == 500) {
          clearInterval(checkSessionRecurr);
          clearInterval(sessionMake);
          $(".device-qrcode-img").attr("src", `${base_api_url}/uploads/disconnect.webp`);
        }
      }
    });
  }
};

switch (location.pathname.split("/")[2]) {
  case "whats-connect":
    if (device_uuid != "" && device_status != 1) {
      sessionMake = setInterval(function () {
        utilities.createSession();
      }, 12000);
      
      checkSessionRecurr = setInterval(function () {
        utilities.checkSession();
      }, 5000);
    } else {

      $("#device-create").on("click", function () {
        $.ajax({
          url: `${location.href}/device/create`,
          type: "POST",
          success: function success(response) {
            device_uuid = response.uuid;
            var html = '<i class="fas fa-exclamation-circle"></i>';
            $("#alert-message-device").css("display", "none");
            $(".alert.alert-info.alert-icon").html(html + response.device.message);
            $(".device-qrcode-img").attr("src", response.device.qr);
            $(".content-qr-create").css("display", "block");
            checkSessionRecurr = setInterval(function () {
              utilities.checkSession();
            }, 5000);
          }
        });
      });
    }

    $("#btn-active").on("click", function () {
      $.ajax({
        url: `${base_api_url}/api/device/qrcode`,
        type: "POST",
        data: {
          uuid: device_uuid
        },
        success: function success(response) {
          $(".card.card-event").css("display", "none");
          var html = '<i class="fas fa-exclamation-circle"></i>';
          $(".alert.alert-info.alert-icon").html(html + response.message);
          $(".device-qrcode-img").attr("src", response.qr);
          $(".content-qr-create").css("display", "block");
          checkSessionRecurr = setInterval(function () {
            utilities.checkSession();
          }, 5000);
        },
        error: function error(xhr, status, _error4) {
          $(".device-qrcode-img").attr("src", `${base_api_url}/uploads/connected.png`);
          $(".content-qr-create").css("display", "block");

          if (xhr.status == 500) {
            clearInterval(checkSessionRecurr);
            clearInterval(sessionMake);
          }
        }
      });
    });

    $("#btn-deactive").on("click", function () {
      $.ajax({
        url: `${location.href}/device/logout/session`,
        type: "POST",
        success: function success(response) {
          if (response.status == false) {
            location.reload();
          }
        },
        error: function error(xhr, status, _error5) {
          $(".device-qrcode-img").attr("src", `${base_api_url}/uploads/disconnect.webp`);
          $(".content-qr-create").css("display", "block");

          if (xhr.status == 500) {
            clearInterval(checkSessionRecurr);
            clearInterval(sessionMake);
          }
        }
      });
    });
  break;
}