<div class="main-header">
  <!-- Logo Header Start -->
  <div class="logo-header"
    data-background-color="<?php echo e(Session::get('organizer_theme_version') == 'light' ? 'white' : 'dark2'); ?>">
    <?php if(!empty($websiteInfo->logo)): ?>
      <a href="<?php echo e(route('index')); ?>" class="logo" target="_blank">
        <img src="<?php echo e(asset('assets/admin/img/' . $websiteInfo->logo)); ?>" alt="logo" class="navbar-brand" width="120">
      </a>
    <?php endif; ?>

    <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse"
      aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon">
        <i class="icon-menu"></i>
      </span>
    </button>
    <button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>

    <div class="nav-toggle">
      <button class="btn btn-toggle toggle-sidebar">
        <i class="icon-menu"></i>
      </button>
    </div>
  </div>
  <!-- Logo Header End -->

  <!-- Navbar Header Start -->
  <nav class="navbar navbar-header navbar-expand-lg"
    data-background-color="<?php echo e(Session::get('organizer_theme_version') == 'light' ? 'white' : 'dark'); ?>">
    <div class="container-fluid">
      <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
        <form action="<?php echo e(route('organizer.change_theme')); ?>" class="form-inline mr-3" method="POST">

          <?php echo csrf_field(); ?>
          <div class="form-group">
            <div class="selectgroup selectgroup-secondary selectgroup-pills">
              <label class="selectgroup-item">
                <input type="radio" name="organizer_theme_version" value="light" class="selectgroup-input"
                  <?php echo e(Session::get('organizer_theme_version') == 'light' ? 'checked' : ''); ?>

                  onchange="this.form.submit()">
                <span class="selectgroup-button selectgroup-button-icon"><i class="fa fa-sun"></i></span>
              </label>

              <label class="selectgroup-item">
                <input type="radio" name="organizer_theme_version" value="dark" class="selectgroup-input"
                  <?php echo e(Session::get('organizer_theme_version') == 'dark' ? 'checked' : ''); ?>

                  onchange="this.form.submit()">
                <span class="selectgroup-button selectgroup-button-icon"><i class="fa fa-moon"></i></span>
              </label>
            </div>
          </div>
        </form>

        <li class="nav-item dropdown hidden-caret">
          <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
            <div class="avatar-sm">
              <?php if(Auth::guard('organizer')->user()->photo != null): ?>
                <img src="<?php echo e(asset('assets/admin/img/organizer-photo/' . Auth::guard('organizer')->user()->photo)); ?>"
                  alt="Admin Image" class="avatar-img rounded-circle">
              <?php else: ?>
                <img src="<?php echo e(asset('assets/admin/img/blank_user.jpg')); ?>" alt=""
                  class="avatar-img rounded-circle">
              <?php endif; ?>
            </div>
          </a>

          <ul class="dropdown-menu dropdown-user animated fadeIn">
            <div class="dropdown-user-scroll scrollbar-outer">
              <li>
                <div class="user-box">
                  <div class="avatar-lg">
                    <?php if(Auth::guard('organizer')->user()->photo != null): ?>
                      <img
                        src="<?php echo e(asset('assets/admin/img/organizer-photo/' . Auth::guard('organizer')->user()->photo)); ?>"
                        alt="Admin Image" class="avatar-img rounded-circle">
                    <?php else: ?>
                      <img src="<?php echo e(asset('assets/admin/img/blank_user.jpg')); ?>" alt=""
                        class="avatar-img rounded-circle">
                    <?php endif; ?>
                  </div>

                  <div class="u-text">
                    <h4>
                      <?php echo e(Auth::guard('organizer')->user()->first_name . ' ' . Auth::guard('organizer')->user()->name); ?>

                    </h4>
                    <p class="text-muted"><?php echo e(Auth::guard('organizer')->user()->email); ?></p>
                  </div>
                </div>
              </li>

              <li>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="<?php echo e(route('organizer.edit.profile')); ?>">
                  <?php echo e(__('Edit Profile')); ?>

                </a>

                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="<?php echo e(route('organizer.change.password')); ?>">
                  <?php echo e(__('Change Password')); ?>

                </a>

                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="<?php echo e(route('organizer.logout')); ?>">
                  <?php echo e(__('Logout')); ?>

                </a>
              </li>
            </div>
          </ul>
        </li>
      </ul>
    </div>
  </nav>
  <!-- Navbar Header End -->
</div>
<?php /**PATH /home/u149868318/domains/vizzion.secretysbet.shop/public_html/resources/views/organizer/partials/top-navbar.blade.php ENDPATH**/ ?>