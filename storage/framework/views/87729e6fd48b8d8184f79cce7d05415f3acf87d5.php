<?php $__env->startSection('content'); ?>
  <div class="page-header">
    <h4 class="page-title"><?php echo e(__('Edit Product')); ?></h4>
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
        <a href="#"><?php echo e(__('Shop Management')); ?></a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#"><?php echo e(__('Manage Products')); ?></a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a
          href="<?php echo e(route('organizer.shop_management.products', ['language' => $defaultLang->code])); ?>"><?php echo e(__('Products')); ?></a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#"><?php echo e(__('Edit Product')); ?></a>
      </li>
    </ul>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="card-title d-inline-block"><?php echo e(__('Edit Product')); ?></div>
          <a class="btn btn-info btn-sm float-right d-inline-block"
            href="<?php echo e(route('organizer.shop_management.products', ['language' => $defaultLang->code])); ?>">
            <span class="btn-label">
              <i class="fas fa-backward"></i>
            </span>
            <?php echo e(__('Back')); ?>

          </a>
        </div>

        <div class="card-body">
          <div class="row">
            <div class="col-lg-8 offset-lg-2">
              <div class="alert alert-danger pb-1 dis-none" id="eventErrors">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <ul></ul>
              </div>
              <div class="col-lg-12">
                <label for="" class="mb-2"><strong><?php echo e(__('Gallery Images ') . ' **'); ?></strong></label>

                <div class="row">
                  <div class="col-12">
                    <table class="table" id="img-table">

                    </table>
                  </div>
                </div>
                <form action="<?php echo e(route('organizer.shop_management.product.imgstore')); ?>" id="my-dropzone"
                  enctype="multipart/formdata" class="dropzone create">
                  <?php echo csrf_field(); ?>
                  <div class="fallback">
                    <input name="file" type="file" multiple />
                  </div>
                </form>
                <p class="em text-danger mb-0" id="errslider_images"></p>
              </div>
              <form id="eventForm" action="<?php echo e(route('organizer.shop_management.product.update')); ?>" method="POST"
                enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="type" value="<?php echo e($product->type); ?>">
                <input type="hidden" name="product_id" value="<?php echo e($product->id); ?>">
                <div class="form-group">
                  <label for=""><?php echo e(__('Feature Image') . '*'); ?></label>
                  <br>
                  <div class="thumb-preview">
                    <?php if($product->feature_image): ?>
                      <img src="<?php echo e(asset('assets/admin/img/product/feature_image/' . $product->feature_image)); ?>"
                        alt="..." class="uploaded-img">
                    <?php else: ?>
                      <img src="<?php echo e(asset('assets/admin/img/noimage.jpg')); ?>" alt="..." class="uploaded-img">
                    <?php endif; ?>


                  </div>

                  <div class="mt-3">
                    <div role="button" class="btn btn-primary btn-sm upload-btn">
                      <?php echo e(__('Choose Image')); ?>

                      <input type="file" class="img-input" name="feature_image">
                    </div>
                  </div>
                </div>

                <div class="row ">
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label><?php echo e(__('SKU') . '*'); ?></label>
                      <input type="text" name="sku" placeholder="<?php echo e(__('Enter Sku')); ?>"
                        value="<?php echo e($product->sku != null ? $product->sku : mt_rand(10000000, 99999999)); ?>"
                        class="form-control">
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label><?php echo e(__('Current Price') . '*'); ?></label>
                      <input type="number" name="current_price" value="<?php echo e($product->current_price); ?>"
                        placeholder="<?php echo e(__('Enter Current Price')); ?>" class="form-control">
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label><?php echo e(__('Previous Price')); ?></label>
                      <input type="number" name="previous_price" value="<?php echo e($product->previous_price); ?>"
                        placeholder="Enter Previous Price" class="form-control">
                    </div>
                  </div>

                  <div class="col-lg-6">
                    <div class="form-group">
                      <label for=""><?php echo e(__('Status') . '*'); ?></label>
                      <select name="status" class="form-control">
                        <option selected disabled><?php echo e(__('Select a Status')); ?></option>
                        <option <?php echo e($product->status == 1 ? 'selected' : ''); ?> value="1">
                          <?php echo e(__('Active')); ?>

                        </option>
                        <option <?php echo e($product->status == 0 ? 'selected' : ''); ?> value="0">
                          <?php echo e(__('Deactive')); ?>

                        </option>
                      </select>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label for=""><?php echo e(__('Is Feature') . '*'); ?></label>
                      <select name="is_feature" class="form-control">
                        <option selected disabled><?php echo e(__('Select')); ?></option>
                        <option <?php echo e($product->is_feature == 'yes' ? 'selected' : ''); ?> value="yes">
                          <?php echo e(__('Yes')); ?>

                        </option>
                        <option <?php echo e($product->is_feature == 'no' ? 'selected' : ''); ?> value="no"><?php echo e(__('No')); ?>

                        </option>
                      </select>
                    </div>
                  </div>


                  <div class="col-lg-6">
                    <?php if($product->type == 'physical'): ?>
                      <div class="form-group">
                        <label for=""><?php echo e(__('Stock Product') . ' **'); ?> </label>
                        <input type="number" class="form-control ltr" name="stock" value="<?php echo e($product->stock); ?>"
                          placeholder="<?php echo e(__('Enter Product Stock')); ?>">
                        <p id="errstock" class="mb-0 text-danger em"></p>
                      </div>
                    <?php endif; ?>
                    <?php if($product->type == 'digital'): ?>
                      <div class="form-group">
                        <label for=""><?php echo e(__('Type') . ' **'); ?> </label>
                        <select name="file_type" class="form-control" id="fileType">
                          <option <?php echo e($product->file_type == 'upload' ? 'selected' : ''); ?> value="upload" selected>
                            <?php echo e(__('File Upload')); ?></option>
                          <option <?php echo e($product->file_type == 'link' ? 'selected' : ''); ?> value="link">
                            <?php echo e(__('File Download Link')); ?>

                          </option>
                        </select>
                        <p id="errfile_type" class="mb-0 text-danger em"></p>
                      </div>
                    <?php endif; ?>
                  </div>
                  <?php if($product->type == 'digital'): ?>
                    <div class="col-lg-6">
                      <div id="downloadFile" class="form-group <?php echo e($product->file_type == 'upload' ? '' : 'd-none'); ?>">
                        <label for=""><?php echo e(__('Downloadable File') . ' **'); ?> </label>
                        <br>
                        <input name="download_file" type="file">

                        <p class="mb-0 text-warning"><?php echo e(__('Only zip file is allowed')); ?></p>
                        <p id="errdownload_file" class="mb-0 text-danger em">
                          <?php echo e(__('File Name') . ' :'); ?>

                          <?php echo e($product->download_file); ?>

                        </p>
                      </div>

                      <div id="downloadLink" class="form-group <?php echo e($product->file_type == 'link' ? '' : 'd-none'); ?> ">
                        <label for=""><?php echo e(__('Downloadable Link') . ' **'); ?> </label>
                        <input name="download_link" type="text" value="<?php echo e($product->download_link); ?>"
                          class="form-control">
                        <p id="errdownload_link" class="mb-0 text-danger em"></p>
                      </div>
                    </div>
                  <?php endif; ?>
                </div>


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

                            <?php echo e($language->is_default == 1 ? '(Default)' : ''); ?>

                          </button>
                        </h5>
                      </div>

                      <?php
                        $product_content = DB::table('product_contents')
                            ->where('language_id', $language->id)
                            ->where('product_id', $product->id)
                            ->first();
                      ?>

                      <div id="collapse<?php echo e($language->id); ?>"
                        class="collapse <?php echo e($language->is_default == 1 ? 'show' : ''); ?>"
                        aria-labelledby="heading<?php echo e($language->id); ?>" data-parent="#accordion">
                        <div class="version-body">
                          <div class="row">
                            <div class="col-lg-6">
                              <div class="form-group <?php echo e($language->direction == 1 ? 'rtl text-right' : ''); ?>">
                                <label><?php echo e(__('Title') . '*'); ?></label>
                                <input type="text" class="form-control" name="<?php echo e($language->code); ?>_title"
                                  value="<?php echo e(@$product_content->title); ?>" placeholder="Enter  title">
                              </div>
                            </div>

                            <div class="col-lg-6">
                              <div class="form-group <?php echo e($language->direction == 1 ? 'rtl text-right' : ''); ?>">
                                <?php
                                  $categories = DB::table('product_categories')
                                      ->where('language_id', $language->id)
                                      ->where('status', 1)
                                      ->orderByDesc('id')
                                      ->get();
                                ?>

                                <label for=""><?php echo e(__('Category') . '*'); ?></label>
                                <select name="<?php echo e($language->code); ?>_category_id" class="form-control">
                                  <option selected disabled><?php echo e(__('Select Category')); ?>

                                  </option>

                                  <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option <?php if(@$product_content->category_id == $category->id): echo 'selected'; endif; ?> value="<?php echo e($category->id); ?>">
                                      <?php echo e($category->name); ?></option>
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col">
                              <div class="form-group <?php echo e($language->direction == 1 ? 'rtl text-right' : ''); ?>">
                                <label for="summary"><?php echo e(__('Summary')); ?> </label>
                                <textarea name="<?php echo e($language->code); ?>_summary" id="summary" class="form-control" rows="4"
                                  placeholder="<?php echo e(__('Enter Product Summary')); ?>"><?php echo e(@$product_content->summary); ?></textarea>
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col">
                              <div class="form-group <?php echo e($language->direction == 1 ? 'rtl text-right' : ''); ?>">
                                <label><?php echo e(__('Description') . '*'); ?></label>
                                <textarea id="descriptionTmce<?php echo e($language->id); ?>" class="form-control summernote"
                                  name="<?php echo e($language->code); ?>_description" placeholder="<?php echo e(__('Enter Product Description')); ?>" data-height="300"><?php echo @$product_content->description; ?></textarea>
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col">
                              <div class="form-group <?php echo e($language->direction == 1 ? 'rtl text-right' : ''); ?>">
                                <label for=""><?php echo e(__('Tags')); ?> </label>
                                <input type="text" class="form-control" name="<?php echo e($language->code); ?>_tags"
                                  value="<?php echo e(@$product_content->tags); ?>" data-role="tagsinput"
                                  placeholder="<?php echo e(__('Enter tags')); ?>">
                                <p id="errtags" class="mb-0 text-danger em"></p>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col">
                              <div class="form-group <?php echo e($language->direction == 1 ? 'rtl text-right' : ''); ?>">
                                <label><?php echo e(__('Meta Keywords')); ?></label>
                                <input class="form-control" name="<?php echo e($language->code); ?>_meta_keywords"
                                  value="<?php echo e(@$product_content->meta_keywords); ?>"
                                  placeholder="<?php echo e(__('Enter Meta Keywords')); ?>" data-role="tagsinput">
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col">
                              <div class="form-group <?php echo e($language->direction == 1 ? 'rtl text-right' : ''); ?>">
                                <label><?php echo e(__('Meta Description')); ?></label>
                                <textarea class="form-control" name="<?php echo e($language->code); ?>_meta_description" rows="5"
                                  placeholder="<?php echo e(__('Enter Meta Description')); ?>"><?php echo e(@$product_content->meta_description); ?></textarea>
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
                                    <span class="form-check-sign"><?php echo e(__('Clone for')); ?>

                                      <strong class="text-capitalize text-secondary"><?php echo e($language->name); ?></strong>
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
                <div id="sliders"></div>
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
      </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
  <?php
    $languages = App\Models\Language::get();
  ?>
  <script>
    let languages = "<?php echo e($languages); ?>";
  </script>
  <script type="text/javascript" src="<?php echo e(asset('assets/admin/js/admin-partial.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/admin/js/admin_dropzone.js')); ?>"></script>
  <script>
    $(document).ready(function() {
      $('.js-example-basic-single').select2();
    });
  </script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('variables'); ?>
  <script>
    "use strict";
    var storeUrl = "<?php echo e(route('organizer.shop_management.product.imgstore')); ?>";
    var removeUrl = "<?php echo e(route('organizer.shop_management.product.imgrmv')); ?>";

    var rmvdbUrl = "<?php echo e(route('organizer.shop_management.imgdbrmv')); ?>";
    var ProductloadImgs = "<?php echo e(route('organizer.shop_management.product.images', $product->id)); ?>";
  </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('organizer.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u149868318/domains/vizzion.secretysbet.shop/public_html/resources/views/organizer/product/edit.blade.php ENDPATH**/ ?>