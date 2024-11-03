<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"><?php echo e(__('Edit Feature')); ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <form id="ajaxEditForm" class="modal-form" action="<?php echo e(route('admin.home_page.update_event_feature')); ?>" method="post">

          <?php echo method_field('PUT'); ?>
          <?php echo csrf_field(); ?>
          <input type="hidden" name="id" id="in_id">
          <input type="hidden" name="theme_version" value="<?php echo e($themeInfo->theme_version); ?>">

          <div class="form-group">
            <label for=""><?php echo e(__('Icon') . '*'); ?></label>
            <div class="btn-group d-block">
              <button type="button" class="btn btn-primary iconpicker-component edit-iconpicker-component">
                <i class="" id="in_icon"></i>
              </button>
              <button type="button" class="icp icp-dd btn btn-primary dropdown-toggle" data-selected="fa-car" data-toggle="dropdown"></button>
              <div class="dropdown-menu"></div>
            </div>

            <input type="hidden" id="editInputIcon" name="icon">
            <p id="editErr_icon" class="mt-1 mb-0 text-danger em"></p>

            <div class="text-warning mt-2">
              <small><?php echo e(__('Click on the dropdown icon to select an icon')); ?></small>
            </div>
          </div>

          <?php if($themeInfo->theme_version == 3): ?>
            <div class="form-group">
              <label for=""><?php echo e(__('Icon') . '*'); ?></label>
              <div class="btn-group d-block">
                <button type="button" class="btn btn-primary iconpicker-component edit-iconpicker-component">
                  <i class="" id="in_icon"></i>
                </button>
                <button type="button" class="icp icp-dd btn btn-primary dropdown-toggle" data-selected="fa-car" data-toggle="dropdown"></button>
                <div class="dropdown-menu"></div>
              </div>

              <input type="hidden" id="editInputIcon" name="icon">
              <p id="editErr_icon" class="mt-1 mb-0 text-danger em"></p>

              <div class="text-warning mt-2">
                <small><?php echo e(__('Click on the dropdown icon to select an icon')); ?></small>
              </div>
            </div>
          <?php endif; ?>

          <div class="form-group">
            <label for=""><?php echo e(__('Title') . '*'); ?></label>
            <input type="text" class="form-control" name="title" placeholder="<?php echo e(__('Enter Feature Title')); ?>" id="in_title">
            <p id="editErr_title" class="mt-1 mb-0 text-danger em"></p>
          </div>

          <div class="form-group">
            <label for=""><?php echo e(__('Text') . '*'); ?></label>
            <textarea class="form-control" name="text" placeholder="<?php echo e(__('Enter Feature Text"')); ?> id="in_text" rows="5"></textarea>
            <p id="editErr_text" class="mt-1 mb-0 text-danger em"></p>
          </div>

          <div class="form-group">
            <label for=""><?php echo e(__('Serial Number') . '*'); ?></label>
            <input type="number" class="form-control ltr" name="serial_number" placeholder="<?php echo e(__('Enter Feature Serial Number')); ?>" id="in_serial_number">
            <p id="editErr_serial_number" class="mt-1 mb-0 text-danger em"></p>
            <p class="text-warning mt-2 mb-0">
              <small><?php echo e(__('The higher the serial number is, the later the feature will be shown')); ?></small>
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
<?php /**PATH /home/u149868318/domains/vizzion.secretysbet.shop/public_html/resources/views/backend/home-page/event-feature/edit.blade.php ENDPATH**/ ?>