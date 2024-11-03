<?php $__env->startSection('content'); ?>
  <div class="page-header">
    <h4 class="page-title"><?php echo e(__('Edit Profile')); ?></h4>
    <ul class="breadcrumbs">
      <li class="nav-home">
        <a href="<?php echo e(route('organizer.dashboard')); ?>">
          <i class="flaticon-home"></i>
        </a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#"><?php echo e(__('Edit Profile')); ?></a>
      </li>
    </ul>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col-lg-12">
              <div class="card-title"><?php echo e(__('Edit Profile')); ?></div>
            </div>
          </div>
        </div>

        <div class="card-body">
          <div class="row ">
            <div class="col-lg-8 mx-auto">
              <div class="alert alert-danger pb-1 dis-none" id="eventErrors">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <ul></ul>
              </div>

              <form id="eventForm" action="<?php echo e(route('organizer.update_profile')); ?>" method="POST"
                enctype="multipart/form-data">
                <?php echo csrf_field(); ?>


                <div class="row">
                  <div class="col-lg-12">
                    <div class="form-group">
                      <label for=""><?php echo e(__('Photo') . '*'); ?></label>
                      <br>
                      <div class="thumb-preview">
                        <?php if(Auth::guard('organizer')->user()->photo != null): ?>
                          <img
                            src="<?php echo e(asset('assets/admin/img/organizer-photo/' . Auth::guard('organizer')->user()->photo)); ?>"
                            alt="..." class="uploaded-img">
                        <?php else: ?>
                          <img src="<?php echo e(asset('assets/admin/img/noimage.jpg')); ?>" alt="..." class="uploaded-img">
                        <?php endif; ?>

                      </div>

                      <div class="mt-3">
                        <div role="button" class="btn btn-primary btn-sm upload-btn">
                          <?php echo e(__('Choose Photo')); ?>

                          <input type="file" accept="image/*" class="img-input" id="img-input" name="photo">
                        </div>
                        <?php if($errors->has('photo')): ?>
                          <p class="mt-2 mb-0 text-danger"><?php echo e($errors->first('photo')); ?></p>
                        <?php endif; ?>
                        <p class="mt-1 mb-0 text-warning em"><?php echo e(__('Image Size 300x300')); ?></p>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-12">
                    <div class="form-group">
                      <label for=""><?php echo e(__('Photo') . '*'); ?></label>
                      <br>
                      <div class="thumb-preview">
                        <?php if(Auth::guard('organizer')->user()->cover != null): ?>
                          <img
                            src="<?php echo e(asset('assets/admin/img/organizer-cover/' . Auth::guard('organizer')->user()->cover)); ?>"
                            alt="..." class="uploaded-img-cover">
                        <?php else: ?>
                          <img src="<?php echo e(asset('assets/admin/img/noimage.jpg')); ?>" alt="..." class="uploaded-img-cover">
                        <?php endif; ?>
                      </div>

                      <div class="mt-3">
                        <div role="button" class="btn btn-primary btn-sm upload-btn">
                          <?php echo e(__('Choose Cover Photo')); ?>

                          <input type="file" accept="image/*" class="img-input-cover" id="img-input-cover" name="cover">
                        </div>
                        <?php if($errors->has('cover')): ?>
                          <p class="mt-2 mb-0 text-danger"><?php echo e($errors->first('cover')); ?></p>
                        <?php endif; ?>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="form-group">
                      <label><?php echo e(__('Email') . '*'); ?></label>
                      <input type="email" class="form-control" name="email"
                        value="<?php echo e(Auth::guard('organizer')->user()->email); ?>">
                      <?php if($errors->has('email')): ?>
                        <p class="mt-2 mb-0 text-danger"><?php echo e($errors->first('email')); ?></p>
                      <?php endif; ?>
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="form-group">
                      <label><?php echo e(__('Phone')); ?></label>
                      <input type="tel" class="form-control" name="phone"
                        value="<?php echo e(Auth::guard('organizer')->user()->phone); ?>">
                      <?php if($errors->has('phone')): ?>
                        <p class="mt-2 mb-0 text-danger"><?php echo e($errors->first('phone')); ?></p>
                      <?php endif; ?>
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="form-group">
                      <label><?php echo e(__('Username') . '*'); ?></label>
                      <input type="text" class="form-control" name="username"
                        value="<?php echo e(Auth::guard('organizer')->user()->username); ?>">
                      <?php if($errors->has('username')): ?>
                        <p class="mt-2 mb-0 text-danger"><?php echo e($errors->first('username')); ?></p>
                      <?php endif; ?>
                    </div>
                  </div>

                  <div class="col-lg-4">
                    <div class="form-group">
                      <label><?php echo e(__('Facebook')); ?></label>
                      <input type="text" class="form-control" name="facebook"
                        value="<?php echo e(Auth::guard('organizer')->user()->facebook); ?>">
                      <?php if($errors->has('facebook')): ?>
                        <p class="mt-2 mb-0 text-danger"><?php echo e($errors->first('facebook')); ?></p>
                      <?php endif; ?>
                    </div>
                  </div>

                  <div class="col-lg-4">
                    <div class="form-group">
                      <label><?php echo e(__('Twitter')); ?></label>
                      <input type="text" class="form-control" name="twitter"
                        value="<?php echo e(Auth::guard('organizer')->user()->twitter); ?>">
                      <?php if($errors->has('twitter')): ?>
                        <p class="mt-2 mb-0 text-danger"><?php echo e($errors->first('twitter')); ?></p>
                      <?php endif; ?>
                    </div>
                  </div>

                  <div class="col-lg-4">
                    <div class="form-group">
                      <label><?php echo e(__('Linkedin')); ?></label>
                      <input type="text" class="form-control" name="linkedin"
                        value="<?php echo e(Auth::guard('organizer')->user()->linkedin); ?>">
                      <?php if($errors->has('linkedin')): ?>
                        <p class="mt-2 mb-0 text-danger"><?php echo e($errors->first('linkedin')); ?></p>
                      <?php endif; ?>
                    </div>
                  </div>

                  <div class="col-lg-12">
                    <div id="accordion" class="mt-3">
                      <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="version">
                          <div class="version-header" id="heading<?php echo e($language->id); ?>">
                            <h5 class="mb-0">
                              <button type="button" class="btn btn-link" data-toggle="collapse"
                                data-target="#collapse<?php echo e($language->id); ?>"
                                aria-expanded="<?php echo e($language->is_default == 1 ? 'true' : 'false'); ?>"
                                aria-controls="collapse<?php echo e($language->id); ?>">
                                <?php echo e($language->name . __(' Language')); ?>

                                <?php echo e($language->is_default == 1 ? '('.__('Default').')' : ''); ?>

                              </button>
                            </h5>
                          </div>

                          <?php
                            $organizer_info = App\Models\OrganizerInfo::where('organizer_id', Auth::guard('organizer')->user()->id)
                                ->where('language_id', $language->id)
                                ->first();
                          ?>

                          <div id="collapse<?php echo e($language->id); ?>"
                            class="collapse <?php echo e($language->is_default == 1 ? 'show' : ''); ?>"
                            aria-labelledby="heading<?php echo e($language->id); ?>" data-parent="#accordion">
                            <div class="version-body">
                              <div class="row">
                                <div class="col-lg-4">
                                  <div class="form-group <?php echo e($language->direction == 1 ? 'rtl text-right' : ''); ?>">
                                    <label><?php echo e(__('Name') . '*'); ?></label>
                                    <input type="text" class="form-control" name="<?php echo e($language->code); ?>_name"
                                      placeholder="Enter Your Full Name"
                                      value="<?php echo e($organizer_info ? $organizer_info->name : ''); ?>">
                                    <?php if($errors->has("$language->code" . '_name')): ?>
                                      <p class="mt-2 mb-0 text-danger">
                                        <?php echo e($errors->first("$language->code" . '_name')); ?></p>
                                    <?php endif; ?>
                                  </div>
                                </div>

                                <div class="col-lg-4">
                                  <div class="form-group <?php echo e($language->direction == 1 ? 'rtl text-right' : ''); ?>">
                                    <label><?php echo e(__('Designation')); ?></label>
                                    <input type="text" class="form-control"
                                      name="<?php echo e($language->code); ?>_designation"
                                      value="<?php echo e($organizer_info ? $organizer_info->designation : ''); ?>">

                                  </div>
                                </div>

                                <div class="col-lg-4">
                                  <div class="form-group <?php echo e($language->direction == 1 ? 'rtl text-right' : ''); ?>">
                                    <label><?php echo e(__('Enter Country')); ?></label>
                                    <input type="text" class="form-control" name="<?php echo e($language->code); ?>_country"
                                      value="<?php echo e($organizer_info ? $organizer_info->country : ''); ?>">
                                  </div>
                                </div>
                                <div class="col-lg-4">
                                  <div class="form-group <?php echo e($language->direction == 1 ? 'rtl text-right' : ''); ?>">
                                    <label><?php echo e(__('City')); ?></label>
                                    <input type="text" class="form-control" name="<?php echo e($language->code); ?>_city"
                                      value="<?php echo e($organizer_info ? $organizer_info->city : ''); ?>">
                                  </div>
                                </div>
                                <div class="col-lg-4">
                                  <div class="form-group <?php echo e($language->direction == 1 ? 'rtl text-right' : ''); ?>">
                                    <label><?php echo e(__('State')); ?></label>
                                    <input type="text" class="form-control" name="<?php echo e($language->code); ?>_state"
                                      value="<?php echo e($organizer_info ? $organizer_info->state : ''); ?>">
                                  </div>
                                </div>
                                <div class="col-lg-4">
                                  <div class="form-group <?php echo e($language->direction == 1 ? 'rtl text-right' : ''); ?>">
                                    <label><?php echo e(__('Zip/Post Code')); ?></label>
                                    <input type="text" class="form-control" name="<?php echo e($language->code); ?>_zip_code"
                                      value="<?php echo e($organizer_info ? $organizer_info->zip_code : ''); ?>">
                                  </div>
                                </div>
                                <div class="col-lg-12">
                                  <div class="form-group <?php echo e($language->direction == 1 ? 'rtl text-right' : ''); ?>">
                                    <label><?php echo e(__('Address')); ?></label>
                                    <textarea name="<?php echo e($language->code); ?>_address" class="form-control"><?php echo e($organizer_info ? $organizer_info->address : ''); ?></textarea>
                                  </div>
                                </div>
                                <div class="col-lg-12">
                                  <div class="form-group <?php echo e($language->direction == 1 ? 'rtl text-right' : ''); ?>">
                                    <label><?php echo e(__('Details')); ?></label>
                                    <textarea name="<?php echo e($language->code); ?>_details" rows="5" class="form-control"><?php echo e($organizer_info ? $organizer_info->details : ''); ?></textarea>
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col">
                                  <?php $currLang = $language; ?>

                                  <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($language->id == $currLang->id) continue; ?>

                                    <div class="form-check py-0">
                                      <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox"
                                          onchange="cloneInput('collapse<?php echo e($currLang->id); ?>', 'collapse<?php echo e($language->id); ?>', event)">
                                        <span class="form-check-sign"><?php echo e(__('Clone for')); ?> <strong
                                            class="text-capitalize text-secondary"><?php echo e($language->name); ?></strong>
                                          <?php echo e(__('language')); ?></span>
                                      </label>
                                    </div>
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>

        <div class="card-footer">
          <div class="row">
            <div class="col-12 text-center">
              <button type="submit" id="EventSubmit" class="btn btn-success">
                <?php echo e(__('Update')); ?>

              </button>
            </div>
          </div>
        </div>
        <div class="modal fade" id="cropModal" tabindex="-1" role="dialog" data-backdrop="static">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="cropModalLabel">Recorte de Imagem</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body d-flex justify-content-center">
                        <div class="image-container">
                            <!--<img id="cropperImage" src="" alt="Cortar"-->
                            <!--    style="max-width: 100%;">-->
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="" class="btn btn-secondary">
                            Fechar
                        </a>
                        <button type="button" class="btn btn-primary"
                            id="saveCroppedImage">Salvar</button>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('organizer.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u149868318/domains/vizzion.secretysbet.shop/public_html/resources/views/organizer/edit-profile.blade.php ENDPATH**/ ?>