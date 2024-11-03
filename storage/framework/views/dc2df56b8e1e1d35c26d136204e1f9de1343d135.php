<header class="main-header">

  <!--Header-Upper-->
  <div class="header-upper py-25">
    <div class="container clearfix">

      <div class="header-inner">
        <div class="logo-outer">
          <div class="logo"><a href="<?php echo e(route('index')); ?>"><img
                src="<?php echo e(asset('assets/admin/img/' . $websiteInfo->logo)); ?>" alt="Logo"></a></div>
        </div>

        <div class="nav-outer clearfix ml-lg-auto">
          <!-- Main Menu -->
          <nav class="main-menu navbar-expand-xl">
            <div class="navbar-header">
              <div class="logo-mobile"><a href="<?php echo e(route('index')); ?>"><img
                    src="<?php echo e(asset('assets/admin/img/' . $websiteInfo->logo)); ?>" alt="Logo"></a></div>
              <!-- Toggle Button -->
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"
                aria-controls="main-menu">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
            </div>

            <div class="navbar-collapse collapse clearfix" id="main-menu">
              <?php
                $links = json_decode($menuInfos, true);
              ?>
              <ul class="navigation clearfix">
                <?php $__currentLoopData = $links; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <?php
                    $href = get_href($link, $currentLanguageInfo->id);
                  ?>
                  <?php if(!array_key_exists('children', $link)): ?>
                    <li><a href="<?php echo e($href); ?>" target="<?php echo e($link['target']); ?>"><?php echo e(__($link['text'])); ?></a></li>
                  <?php else: ?>
                    <li class="dropdown">
                      <a href="<?php echo e($href); ?>" target="<?php echo e($link['target']); ?>">
                        <?php echo e($link['text']); ?>

                        <i class="fa fa-angle-down"></i>
                      </a>
                      <ul>
                        <?php $__currentLoopData = $link['children']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $level2): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <?php
                            $l2Href = get_href($level2, $currentLanguageInfo->id);
                          ?>
                          <li>
                            <a href="<?php echo e($l2Href); ?>" target="<?php echo e($level2['target']); ?>"><?php echo e(__($level2['text'])); ?></a>
                          </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </ul>
                    </li>
                  <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </ul>

              <div class="menu-right">
                <form action="<?php echo e(route('change_language')); ?>" method="get">
                  <select name="lang_code" id="language" class="form-control" onchange="this.form.submit()">
                    <?php $__currentLoopData = $allLanguageInfos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <option value="<?php echo e($item->code); ?>"
                        <?php echo e($item->code == $currentLanguageInfo->code ? 'selected' : ''); ?>><?php echo e($item->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </select>
                </form>
                <?php if(!Auth::guard('customer')->check()): ?>
                  <div class="dropdown">
                    <button type="button" class="menu-btn dropdown-toggle mr-1"
                      data-toggle="dropdown"><?php echo e(__('Customer')); ?></button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                      <a class="dropdown-item" href="<?php echo e(route('customer.login')); ?>"><?php echo e(__('Login')); ?></a>
                      <a class="dropdown-item" href="<?php echo e(route('customer.signup')); ?>"><?php echo e(__('Signup')); ?></a>
                    </div>
                  </div>
                <?php else: ?>
                  <div class="dropdown">
                    <button type="button" class="menu-btn dropdown-toggle mr-1"
                      data-toggle="dropdown"><?php echo e(Auth::guard('customer')->user()->username); ?></button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                      <a class="dropdown-item" href="<?php echo e(route('customer.dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a>
                      <a class="dropdown-item" href="<?php echo e(route('customer.logout')); ?>"><?php echo e(__('Logout')); ?></a>
                    </div>
                  </div>
                <?php endif; ?>
                <?php if(!Auth::guard('organizer')->check()): ?>
                  <div class="dropdown">
                    <button type="button" class="menu-btn dropdown-toggle"
                      data-toggle="dropdown"><?php echo e(__('Organizer')); ?></button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                      <a class="dropdown-item" href="<?php echo e(route('organizer.login')); ?>"><?php echo e(__('Login')); ?></a>
                      <a class="dropdown-item" href="<?php echo e(route('organizer.signup')); ?>"><?php echo e(__('Signup')); ?></a>
                    </div>
                  </div>
                <?php else: ?>
                  <div class="dropdown">
                    <button type="button" class="menu-btn dropdown-toggle mr-1"
                      data-toggle="dropdown"><?php echo e(Auth::guard('organizer')->user()->username); ?></button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                      <a class="dropdown-item" href="<?php echo e(route('organizer.dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a>
                      <a class="dropdown-item" href="<?php echo e(route('organizer.logout')); ?>"><?php echo e(__('Logout')); ?></a>
                    </div>
                  </div>
                <?php endif; ?>
              </div>
            </div>
          </nav>
          <!-- Main Menu End-->
        </div>
      </div>
    </div>
  </div>
  <!--End Header Upper-->
</header>
<?php /**PATH /home/u149868318/domains/vizzion.secretysbet.shop/public_html/resources/views/frontend/partials/header/header-nav.blade.php ENDPATH**/ ?>