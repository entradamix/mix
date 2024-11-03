<?php $__env->startSection('pageHeading'); ?>
  <?php if(!empty($pageHeading)): ?>
    <?php echo e($pageHeading->shop_page_title ?? __('Shop')); ?>

  <?php else: ?>
    <?php echo e(__('Shop')); ?>

  <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php
  $metaKeywords = !empty($seo->meta_keyword_shop) ? $seo->meta_keyword_shop : '';
  $metaDescription = !empty($seo->meta_description_shop) ? $seo->meta_description_shop : '';
?>
<?php $__env->startSection('meta-keywords', "<?php echo e($metaKeywords); ?>"); ?>
<?php $__env->startSection('meta-description', "$metaDescription"); ?>

<?php $__env->startSection('hero-section'); ?>
  <!-- Page Banner Start -->
  <section class="page-banner overlay pt-120 pb-125 rpt-90 rpb-95 lazy"
    data-bg="<?php echo e(asset('assets/admin/img/' . $basicInfo->breadcrumb)); ?>">
    <div class="container">
      <div class="banner-inner">
        <h2 class="page-title">
          <?php if(!empty($pageHeading)): ?>
            <?php echo e($pageHeading->shop_page_title ?? __('Shop')); ?>

          <?php else: ?>
            <?php echo e(__('Shop')); ?>

          <?php endif; ?>
        </h2>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo e(route('index')); ?>"><?php echo e(__('Home')); ?></a></li>
            <li class="breadcrumb-item active">
              <?php if(!empty($pageHeading)): ?>
                <?php echo e($pageHeading->shop_page_title ?? __('Shop')); ?>

              <?php else: ?>
                <?php echo e(__('Shop')); ?>

              <?php endif; ?>
            </li>
          </ol>
        </nav>
      </div>
    </div>
  </section>
    <div class="container">
      <div id="event-search" class="hero-content event-search py-35">
        <div class="widget-search search-item">
          <form id="event-search" action="">
            <input type="text" name="search"
              value="<?php echo e(!empty(request()->input('search')) ? request()->input('search') : ''); ?>"
              placeholder="<?php echo e(__('Search')); ?>.....">
            <button type="submit" id="product-search-button" class="fa fa-search"></button>
          </form>
        </div>
        <div class="widget widget-cagegory search-item">
          
          <form action="<?php echo e(route('shop')); ?>" id="catForm">
            <select id="borwseby" name="category" class="widget-select">
              <option value=""><?php echo e(__('All Category')); ?></option>
              
              <?php $__currentLoopData = $product_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option <?php echo e(request()->input('category') == $item->slug ? 'selected' : ''); ?>

                  value="<?php echo e($item->slug); ?>"><?php echo e($item->name); ?></option>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
          </form>
        </div>
        

        


        <?php if(!empty(showAd(2))): ?>
          <div class="text-center mt-4">
            <?php echo showAd(2); ?>

          </div>
        <?php endif; ?>
      </div>
    </div>
  <!-- Page Banner End -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
  <!-- Event Page Start -->
  <section class="event-page-section py-20 rpy-100">
    <div class="container">
      <div class="row">
        
        <div class="col-lg-12">
          <div class="shop-page-content">
            

            <div class="row">
              <?php if(count($products) > 0): ?>
                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <div class="col-md-4 col-sm-6">
                    <div class="shop-item">
                        <div class="image">
                            <img class="lazy" data-src="<?php echo e(asset('assets/admin/img/product/feature_image/' . $item->feature_image)); ?>" alt="Product">
                            <div class="product-icons">
                                
                                <a href="<?php echo e(route('shop.details', ['slug' => $item->slug, 'id' => $item->id])); ?>" class="view"><i class="far fa-eye"></i></a>
                            </div>
                      </div>
                      <?php
                        $reviews = App\Models\ShopManagement\ProductReview::where('product_id', $item->id)->get();
                        $avarage_rating = App\Models\ShopManagement\ProductReview::where('product_id', $item->id)->avg('review');
                        $avarage_rating = round($avarage_rating, 2);
                      ?>
                      <div class="content">
                        <?php if($basicInfo->is_shop_rating == 1): ?>
                          <div class="ratting">
                            <div class="d-flex justify-content-between">
                              <div class="rate">
                                <div class="rating" style="width:<?php echo e($avarage_rating * 20); ?>%"></div>
                              </div>
                            </div>
                          </div>
                        <?php endif; ?>
                        <h6><a
                            href="<?php echo e(route('shop.details', ['slug' => $item->slug, 'id' => $item->id])); ?>"><?php echo e($item->title); ?></a>
                        </h6>
                        <span class="price"
                          dir="ltr"><?php echo e($basicInfo->base_currency_symbol_position == 'left' ? $basicInfo->base_currency_symbol : ''); ?>

                          <?php echo e($item->current_price); ?>

                          <?php echo e($basicInfo->base_currency_symbol_position == 'right' ? $basicInfo->base_currency_symbol : ''); ?>

                          <?php if(!is_null($item->previous_price)): ?>
                            <del><?php echo e($basicInfo->base_currency_symbol_position == 'left' ? $basicInfo->base_currency_symbol : ''); ?>

                              <?php echo e($item->previous_price); ?>

                              <?php echo e($basicInfo->base_currency_symbol_position == 'right' ? $basicInfo->base_currency_symbol : ''); ?>

                            </del>
                          <?php endif; ?>
                        </span>
                      </div>
                    </div>
                  </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              <?php else: ?>
                <div class="col-lg-12">
                  <h3 class="text-center"><?php echo e(__('No Product Found')); ?></h3>
                </div>
              <?php endif; ?>
            </div>
            <?php echo e($products->links()); ?>


            <?php if(!empty(showAd(3))): ?>
              <div class="text-center mt-4">
                <?php echo showAd(3); ?>

              </div>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Event Page End -->

  <form id="filtersForm" class="d-none" action="<?php echo e(route('shop')); ?>" method="GET">
    <input type="hidden" id="category-id" name="category"
      value="<?php echo e(!empty(request()->input('category')) ? request()->input('category') : ''); ?>">
    <input type="hidden" id="country-id" name="country"
      value="<?php echo e(!empty(request()->input('country')) ? request()->input('country') : ''); ?>">

    <input type="hidden" id="event" name="event"
      value="<?php echo e(!empty(request()->input('event')) ? request()->input('event') : ''); ?>">

    <input type="hidden" id="min-id" name="min"
      value="<?php echo e(!empty(request()->input('min')) ? request()->input('min') : ''); ?>">

    <input type="hidden" id="max-id" name="max"
      value="<?php echo e(!empty(request()->input('max')) ? request()->input('max') : ''); ?>">

    <input type="hidden" id="keyword-id" name="search"
      value="<?php echo e(!empty(request()->input('search')) ? request()->input('search') : ''); ?>">

    <input type="hidden" id="state-id" name="state"
      value="<?php echo e(!empty(request()->input('state')) ? request()->input('state') : ''); ?>">
    <input type="hidden" id="city-id" name="city"
      value="<?php echo e(!empty(request()->input('city')) ? request()->input('city') : ''); ?>">

    <input type="hidden" id="dates-id" name="dates"
      value="<?php echo e(!empty(request()->input('dates')) ? request()->input('dates') : ''); ?>">

    <button type="submit" id="submitBtn"></button>
  </form>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('custom-script'); ?>
  <script type="text/javascript" src="<?php echo e(asset('assets/front/js/moment.min.js')); ?>"></script>
  <script type="text/javascript" src="<?php echo e(asset('assets/front/js/daterangepicker.min.js')); ?>"></script>
  <script>
    let min_price = <?php echo htmlspecialchars($min); ?>;
    let max_price = <?php echo htmlspecialchars($max); ?>;
    let curr_min = <?php echo !empty(request()->input('min')) ? htmlspecialchars(request()->input('min')) : 5; ?>;
    let curr_max = <?php echo !empty(request()->input('max')) ? htmlspecialchars(request()->input('max')) : 800; ?>;
  </script>
  <script src="<?php echo e(asset('assets/front/js/product.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u149868318/domains/vizzion.secretysbet.shop/public_html/resources/views/frontend/shop/index.blade.php ENDPATH**/ ?>