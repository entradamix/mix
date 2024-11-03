<div class="modal fade" id="editproductCategoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"><?php echo e(__('Edit Event Category')); ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <form id="ajaxEditForm" class="modal-form" action="<?php echo e(route('organizer.shop_management.update_category')); ?>" method="post">

          <?php echo method_field('PUT'); ?>
          <?php echo csrf_field(); ?>
          <input type="hidden" id="in_id" name="id">

          <div class="form-group">
            <label for=""><?php echo e(__('Category Name') . '*'); ?></label>
            <input type="text" id="in_name" class="form-control" name="name" placeholder="<?php echo e(__('Enter Category Name')); ?>">
            <p id="editErr_name" class="mt-1 mb-0 text-danger em"></p>
          </div>

          <div class="form-group">
            <label for=""><?php echo e(__('Category Status') . '*'); ?></label>
            <select name="status" id="in_status" class="form-control">
              <option disabled><?php echo e(__('Select a Status')); ?></option>
              <option value="1"><?php echo e(__('Active')); ?></option>
              <option value="0"><?php echo e(__('Deactive')); ?></option>
            </select>
            <p id="editErr_status" class="mt-1 mb-0 text-danger em"></p>
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
<?php /**PATH /home/u149868318/domains/vizzion.secretysbet.shop/public_html/resources/views/organizer/product/category/edit.blade.php ENDPATH**/ ?>