<div class="modal fade" id="editEventCategoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"><?php echo e(__('Edit Event Category')); ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <form id="ajaxEditForm" class="modal-form" action="<?php echo e(route('admin.event_management.update_category')); ?>" method="post">

          <?php echo method_field('PUT'); ?>
          <?php echo csrf_field(); ?>
          <input type="hidden" id="in_id" name="id">

          <div class="form-group">
            <label for=""><?php echo e(__('Image') . '*'); ?></label>
            <br>
            <div class="thumb-preview">
              <img src="<?php echo e(asset('assets/admin/img/noimage.jpg')); ?>" alt="..." class="uploaded-img in_image">
            </div>

            <div class="mt-3">
              <div role="button" class="btn btn-primary btn-sm upload-btn">
                <?php echo e(__('Choose Image')); ?>

                <input type="file" class="img-input" name="image">
              </div>
            </div>
          </div>


          <div class="form-group">
            <label for=""><?php echo e(__('Name') . '*'); ?></label>
            <input type="text" id="in_name" class="form-control" name="name" placeholder="Enter Category Name">
            <p id="editErr_name" class="mt-1 mb-0 text-danger em"></p>
          </div>

          <div class="form-group">
            <label for=""><?php echo e(__('Status') . '*'); ?></label>
            <select name="status" id="in_status" class="form-control">
              <option disabled><?php echo e(__('Select a Status')); ?></option>
              <option value="1"><?php echo e(__('Active')); ?></option>
              <option value="0"><?php echo e(__('Deactive')); ?></option>
            </select>
            <p id="editErr_status" class="mt-1 mb-0 text-danger em"></p>
          </div>

          <div class="form-group">
            <label for=""><?php echo e(__('Featured') . '*'); ?></label>
            <select name="is_featured" id="in_is_featured" class="form-control">
              <option  disabled><?php echo e(__('Select Is Feature')); ?></option>
              <option value="yes"><?php echo e(__('YES')); ?></option>
              <option value="no"><?php echo e(__('NO')); ?></option>
            </select>
            <p id="editErr__is_featured" class="mt-1 mb-0 text-danger em"></p>
          </div>

          <div class="form-group">
            <label for=""><?php echo e(__('Serial Number') . '*'); ?></label>
            <input type="number" id="in_serial_number" class="form-control ltr" name="serial_number" placeholder="Enter Category Serial Number">
            <p id="editErr_serial_number" class="mt-1 mb-0 text-danger em"></p>
            <p class="text-warning mt-2 mb-0">
              <small><?php echo e(__('The higher the serial number is, the later the category will be shown.')); ?></small>
            </p>
          </div>
        </form>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">
          <?php echo e(__('Close')); ?>

        </button>
        <button id="updateBtn" type="button" class="btn btn-primary btn-sm">
          <?php echo e(__('Update')); ?>

        </button>
      </div>
    </div>
  </div>
</div>
<?php /**PATH /home/u149868318/domains/vizzion.secretysbet.shop/public_html/resources/views/backend/event/category/edit.blade.php ENDPATH**/ ?>