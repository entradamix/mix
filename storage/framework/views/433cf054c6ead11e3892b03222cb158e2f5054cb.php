<div class="col-lg-4 col-md-6">
  <div class="sidebar rmt-75">
    <div class="widget widget-search">
      <h5 class="widget-title"><?php echo e(__('Search Blog')); ?></h5>
      <div class="blog-Search-content text-center">
        <form action="<?php echo e(route('blogs')); ?>" method="GET">
          <input type="text" placeholder="<?php echo e(__('Search By Title')); ?>" name="title"
            value="<?php echo e(!empty(request()->input('title')) ? request()->input('title') : ''); ?>">
          <input type="hidden" name="category"
            value="<?php echo e(!empty(request()->input('category')) ? request()->input('category') : ''); ?>">
          <button type="submit"><i class="fa fa-search"></i></button>
        </form>
      </div>
    </div>

    <div class="widget widget-cagegory">
      <h5 class="widget-title"><?php echo e(__('Categories')); ?></h5>
      <div class="blog-categories-content">
        <?php if(count($categories) == 0): ?>
          <h5><?php echo e(__('No Category Found') . '!'); ?></h5>
        <?php else: ?>
          <ul class="list-style-two">
            <li <?php if(empty(request()->input('category'))): ?> class="active" <?php endif; ?>>
              <a href="<?php echo e(route('blogs')); ?>"><?php echo e(__('All')); ?> <span>(<?php echo e($allBlogs); ?>)</span></a>
            </li>

            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <li <?php if($category->slug == request()->input('category')): ?> class="active" <?php endif; ?>>
                <a href="<?php echo e(route('blogs', ['category' => $category->slug])); ?>"
                  data-category_id="<?php echo e($category->slug); ?>"><?php echo e($category->name); ?>

                  <span>(<?php echo e($category->blogCount); ?>)</span>
                </a>
              </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </ul>
        <?php endif; ?>
      </div>
    </div>

    <div class="banner-add mt-40 text-center">
      <?php echo showAd(1); ?>

    </div>

    <div class="banner-add mt-40 text-center">
      <?php echo showAd(2); ?>

    </div>
  </div>

  
  <form class="d-none" action="<?php echo e(route('blogs')); ?>" method="GET">
    <input type="hidden" name="title"
      value="<?php echo e(!empty(request()->input('title')) ? request()->input('title') : ''); ?>">

    <input type="hidden" id="categoryKey" name="category">

    <button type="submit" id="submitBtn"></button>
  </form>
  
</div>
<?php /**PATH /home/u149868318/domains/vizzion.secretysbet.shop/public_html/resources/views/frontend/journal/side-bar.blade.php ENDPATH**/ ?>