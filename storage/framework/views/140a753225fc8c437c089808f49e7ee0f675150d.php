<?php $__env->startSection('pageHeading'); ?>
  <?php echo e($product->title); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('meta-keywords', "<?php echo e($product->meta_keywords); ?>"); ?>
<?php $__env->startSection('meta-description', "$product->meta_description"); ?>

<?php
  $og_title = $product->title;
  $og_description = strip_tags($product->description);
  $og_image = asset('assets/admin/img/product/feature_image/' . $product->feature_image);
?>

<?php $__env->startSection('og-title', "$og_title"); ?>
<?php $__env->startSection('og-description', "$og_description"); ?>
<?php $__env->startSection('og-image', "$og_image"); ?>

<?php $__env->startSection('custom-style'); ?>
  <link rel="stylesheet" href="<?php echo e(asset('assets/front/css/common-style.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('assets/admin/css/summernote-content.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('hero-section'); ?>
  <!-- Page Banner Start -->
  <section class="page-banner overlay pt-120 pb-125 rpt-90 rpb-95 lazy"
    data-bg="<?php echo e(asset('assets/admin/img/' . $basicInfo->breadcrumb)); ?>">
    <div class="container">
      <div class="banner-inner">
        <h2 class="page-title"><?php echo e(__('Shop')); ?></h2>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo e(route('index')); ?>"><?php echo e(__('Home')); ?></a></li>
            <li class="breadcrumb-item active"><?php echo e(__('Product Details')); ?></li>
          </ol>
        </nav>
      </div>
    </div>
  </section>
  <!-- Page Banner End -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

  <!-- Shop Details Start -->

  <section class="shop-details-area pt-120 rpt-100 pb-95 rpb-75">
    <div class="container">
      <?php
        $reviews = App\Models\ShopManagement\ProductReview::where('product_id', $product->id)->get();
        $avarage_rating = App\Models\ShopManagement\ProductReview::where('product_id', $product->id)->avg('review');
        $avarage_rating = round($avarage_rating, 2);
      ?>
      <div class="shop-details-content">
        <div class="row justify-content-between pb-45">
          <div class="col-lg-6">
            <div class="product-gallery">
              <?php $__currentLoopData = $galleries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gallery): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a class="product-image-preview"
                  href="<?php echo e(asset('assets/admin/img/product/gallery/' . $gallery->image)); ?>">
                  <img class="lazy" data-src="<?php echo e(asset('assets/admin/img/product/gallery/' . $gallery->image)); ?>"
                    alt="Preview">
                </a>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <div class="product-thumb mt-30">
              <?php $__currentLoopData = $galleries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gallery): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="product-thumb-item">
                  <img class="lazy" data-src="<?php echo e(asset('assets/admin/img/product/gallery/' . $gallery->image)); ?>"
                    alt="Thumb">
                </div>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
          </div>
          <div class="col-lg-6 pl-lg-5">
            <div class="descriptions rmt-55 mb-50 rmb-35">
              <h3><?php echo e($product->title); ?></h3>
              <div class="rating-review d-flex align-items-center pt-5 mb-15">
                <?php if($basicInfo->is_shop_rating == 1): ?>
                  <div class="ratting">
                    <div class="d-flex justify-content-between">
                      <div class="rate">
                        <div class="rating" style="width:<?php echo e($avarage_rating * 20); ?>%"></div>
                      </div>
                    </div>
                  </div>
                <?php endif; ?>


                <?php if($product->type == 'digital'): ?>
                  <span class="in-stock"><i class="fas fa-check"></i><?php echo e(__('Available')); ?></span>
                <?php else: ?>
                  <?php if($product->stock > 0): ?>
                    <span class="in-stock"><i class="fas fa-check"></i> <?php echo e(__('In Stock')); ?></span>
                  <?php else: ?>
                    <span class="in-stock bg-danger"><i class="fas fa-times"></i><?php echo e(__('Out of Stock')); ?></span>
                  <?php endif; ?>
                <?php endif; ?>

              </div>
              <div class="shop-price mb-15" dir="ltr">
                <?php if(!is_null($product->previous_price)): ?>
                  <del><span class="price">
                      <?php echo e(symbolPrice($product->previous_price)); ?>

                    </span></del>
                <?php endif; ?>

                <b class="current-price">
                  <?php echo e(symbolPrice($product->current_price)); ?></b>
              </div>
              <p><?php echo e($product->summary); ?></p>
              <div class="add-to-cart pt-15">
                <form action="javascript:void(0)" method="post">
                  <?php echo csrf_field(); ?>
                  <input type="hidden" name="product_id" value="<?php echo e($product->id); ?>">
                  <div class="quantity-input">
                    <button class="quantity-down" id="quantityDown">
                      -
                    </button>
                    <input id="quantity" type="number" value="1" name="quantity">
                    <button class="quantity-up" id="quantityUP">
                      +
                    </button>
                  </div>
                  <div class="btns pt-20">
                    <a class="cart-link2 theme-btn" data-href="<?php echo e(route('add.cart2', $product->id)); ?>"
                      data-toggle="tooltip" data-placement="top" title="<?php echo e(__('Add to Cart')); ?>"
                      class="theme-btn cart-link2"><?php echo e(__('Add to Cart')); ?></a>
                  </div>
                </form>

              </div>
              <div class="social-style-two mt-30 mb-15">
                <a href="//www.facebook.com/sharer/sharer.php?u=<?php echo e(urlencode(url()->current())); ?>"><i
                    class="fab fa-facebook-f"></i></a>
                <a href="//twitter.com/intent/tweet?text=my share text&amp;url=<?php echo e(urlencode(url()->current())); ?>"><i
                    class="fab fa-twitter"></i></a>
                <a
                  href="//www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo e(urlencode(url()->current())); ?>&amp;title=<?php echo e($product->title); ?>"><i
                    class="fab fa-linkedin"></i></a>
              </div>
              <ul class="product-meta">
                <li><b><?php echo e(__('SKU')); ?>:</b> <span><?php echo e($product->sku); ?></span></li>
                <li><b><?php echo e(__('Category')); ?>:</b> <a
                    href="<?php echo e(route('shop', ['category' => $product->slug])); ?>"><?php echo e($product->category); ?></a></li>
              </ul>
            </div>

          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-9">

          <ul class="nav product-information-tab mb-30">
            <li><a href="#details" data-toggle="tab" class="active show"><?php echo e(__('Description')); ?></a></li>
            <?php if($basicInfo->is_shop_rating == 1): ?>
              <li><a href="#review" data-toggle="tab" class=""><?php echo e(__('Review')); ?> (<?php echo e(count($reviews)); ?>)</a>
              </li>
            <?php endif; ?>
          </ul>
          <div class="tab-content">
            <div class="tab-pane fade active show" id="details">
              <h4><?php echo e(__('Description')); ?></h4>
              <div class="summernote-content">
                <?php echo $product->description; ?>

              </div>
            </div>
            <?php if($basicInfo->is_shop_rating == 1): ?>
              <div class="tab-pane fade" id="review">
                <div class="shop-review-area">
                  <div class="shop-review-title">
                    <h3 class="title"><?php echo e(convertUtf8($product->title)); ?></h3>
                  </div>
                  <?php if(count($reviews) > 0): ?>
                    <?php $__currentLoopData = $reviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <div class="shop-review-user">
                        <?php
                          $customer = App\Models\Customer::where('id', $review->user_id)->first();
                        ?>
                        <img class="lazy"
                          src="<?php echo e($customer->photo != null ? asset('assets/admin/img/customer-profile/' . $customer->photo) : asset('assets/front/images/profile.jpg')); ?>"
                          alt="user image" width="60">


                        <ul>
                          <div class="rate">
                            <div class="rating" style="width:<?php echo e($review->review * 20); ?>%"></div>
                          </div>
                        </ul>
                        <span><span><?php echo e(convertUtf8($customer->fname)); ?> <?php echo e(convertUtf8($customer->lname)); ?></span> –
                          <?php echo e(date('d-m-Y', strtotime($review->created_at))); ?></span>
                        <p><?php echo e(convertUtf8($review->comment)); ?></p>
                      </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  <?php else: ?>
                    <div class="bg-light mt-4 text-center py-5">
                      <?php echo e(__('NOT RATED YET')); ?>

                    </div>
                  <?php endif; ?>
                  <?php if(Auth::guard('customer')->user()): ?>
                    <?php if(App\Models\ShopManagement\OrderItem::where('user_id', Auth::guard('customer')->user()->id)->where('product_id', $product->id)->exists()): ?>
                      <div class="shop-review-form">
                        <?php $__errorArgs = ['error'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                          <p class="text-danger my-2"><?php echo e(Session::get('error')); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        <form class="mt-5" action="<?php echo e(route('product.review.submit')); ?>" method="POST"><?php echo csrf_field(); ?>
                          <div class="input-box">
                            <span><?php echo e(__('Comment')); ?></span>
                            <textarea name="comment" cols="30" rows="10" placeholder="<?php echo e(__('Comment')); ?>"></textarea>
                          </div>
                          <input type="hidden" value="" id="reviewValue" name="review">
                          <input type="hidden" value="<?php echo e($product->id); ?>" name="product_id">
                          <div class="input-box">
                            <span><?php echo e(__('Rating') . ' *'); ?></span>
                            <div class="review-content ">
                              <ul class="review-value review-1">
                                <li><a class="cursor-pointer" data-href="1"><i class="far fa-star"></i></a></li>
                              </ul>
                              <ul class="review-value review-2">
                                <li><a class="cursor-pointer" data-href="2"><i class="far fa-star"></i></a></li>
                                <li><a class="cursor-pointer" data-href="2"><i class="far fa-star"></i></a></li>
                              </ul>
                              <ul class="review-value review-3">
                                <li><a class="cursor-pointer" data-href="3"><i class="far fa-star"></i></a></li>
                                <li><a class="cursor-pointer" data-href="3"><i class="far fa-star"></i></a></li>
                                <li><a class="cursor-pointer" data-href="3"><i class="far fa-star"></i></a></li>
                              </ul>
                              <ul class="review-value review-4">
                                <li><a class="cursor-pointer" data-href="4"><i class="far fa-star"></i></a></li>
                                <li><a class="cursor-pointer" data-href="4"><i class="far fa-star"></i></a></li>
                                <li><a class="cursor-pointer" data-href="4"><i class="far fa-star"></i></a></li>
                                <li><a class="cursor-pointer" data-href="4"><i class="far fa-star"></i></a></li>
                              </ul>
                              <ul class="review-value review-5">
                                <li><a class="cursor-pointer" data-href="5"><i class="far fa-star"></i></a></li>
                                <li><a class="cursor-pointer" data-href="5"><i class="far fa-star"></i></a></li>
                                <li><a class="cursor-pointer" data-href="5"><i class="far fa-star"></i></a></li>
                                <li><a class="cursor-pointer" data-href="5"><i class="far fa-star"></i></a></li>
                                <li><a class="cursor-pointer" data-href="5"><i class="far fa-star"></i></a></li>
                              </ul>
                            </div>
                          </div>
                          <div class="input-btn mt-3">
                            <button type="submit"><?php echo e(__('Submit')); ?></button>
                          </div>
                        </form>
                      </div>
                    <?php endif; ?>
                  <?php else: ?>
                    <div class="review-login mt-4">
                      <a class="theme-btn d-inline-block mr-2"
                        href="<?php echo e(route('customer.login')); ?>"><?php echo e(__('Login')); ?></a> <?php echo e(__('to leave a rating')); ?>

                    </div>
                  <?php endif; ?>
                </div>
              </div>
            <?php endif; ?>
          </div>
        </div>
      </div>
      <?php if(!empty(showAd(3))): ?>
        <div class="text-center mt-4">
          <?php echo showAd(3); ?>

        </div>
      <?php endif; ?>

    </div>
  </section>
  <!-- Shop Details End -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u149868318/domains/vizzion.secretysbet.shop/public_html/resources/views/frontend/shop/details.blade.php ENDPATH**/ ?>