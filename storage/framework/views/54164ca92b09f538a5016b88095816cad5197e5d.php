<footer class="footer-section bg-lighter pt-20"
  style="background:#<?php echo e($footerInfo ? $footerInfo->footer_background_color : ''); ?>">
  <div class="container">
    <div class="row justify-content-between">
      <div class="col-lg-5 col-sm-6">
        <div class="footer-widget about-widget">
          <div class="footer-logo mb-30">
            <?php if(!is_null($footerInfo)): ?>
              <a href="<?php echo e(route('index')); ?>"><img
                  src="<?php echo e(asset('assets/admin/img/footer_logo/' . $footerInfo->footer_logo)); ?>" alt="Logo"></a>
            <?php endif; ?>
          </div>
          <p><?php echo $footerInfo ? $footerInfo->about_company : ''; ?></p>
          <div class="social-style-one mt-30">
            <?php if(count($socialMediaInfos) > 0): ?>
              <?php $__currentLoopData = $socialMediaInfos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $socialMediaInfo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e($socialMediaInfo->url); ?>"><i class="<?php echo e($socialMediaInfo->icon); ?>"></i></a>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-sm-6">
        <div class="footer-widget link-widget ml-sm-auto">
          <h5 class="footer-title"><?php echo e(__('Quick Links')); ?></h5>
          <ul>
            <?php $__currentLoopData = $quickLinkInfos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $quickLinkInfo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <li><a href="<?php echo e($quickLinkInfo->url); ?>"><?php echo e($quickLinkInfo->title); ?></a></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </ul>
        </div>
      </div>
      <div class="col-lg-4 col-sm-6">
        <div class="footer-widget about-widget ml-sm-auto">
          <h5 class="footer-title"><?php echo e(__('Contact Us')); ?></h5>
          <?php if(!is_null($bex)): ?>
            <?php
              $addresses = explode(PHP_EOL, $bex->contact_addresses);
            ?>
            <?php if(!empty($addresses)): ?>
              <p class="ip">
                <i class="fas fa-map-marker-alt"></i>
                <?php $__currentLoopData = $addresses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $address): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <?php echo e($address); ?>

                  <?php if(!$loop->last): ?>
                    |
                  <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </p>
            <?php endif; ?>

            <?php
              $mails = explode(',', $bex->contact_mails);
            ?>
            <?php if(!empty($mails)): ?>
              <p class="ip">
                <i class="fas fa-envelope"></i>
                <?php $__currentLoopData = $mails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <a href="mailto:<?php echo e($mail); ?>"
                    class="d-inline-block text-transform-normal"><?php echo e($mail); ?></a>
                  <?php if(!$loop->last): ?>
                    ,
                  <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </p>
            <?php endif; ?>

            <?php
              $phones = explode(',', $bex->contact_numbers);
            ?>
            <p class="ip"><i class="fas fa-mobile-alt"></i>
              <?php $__currentLoopData = $phones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $phone): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="tel:<?php echo e($phone); ?>"><?php echo e($phone); ?></a>
                <?php if(!$loop->last): ?>
                  ,
                <?php endif; ?>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </p>
          <?php endif; ?>
        </div>
      </div>
    </div>

    <div class="copyright-area">
      <?php
        $date = Date('Y');
        if (!empty($footerInfo->copyright_text)) {
            $footer_text = str_replace('{year}', $date, $footerInfo->copyright_text);
        }
      ?>
      <p><?php echo !empty($footerInfo->copyright_text) ? $footer_text : ''; ?></p>
      <!-- Scroll Top Button -->
      <button class="scroll-top scroll-to-target" data-target="html"><span class="fa fa-angle-up"></span></button>
    </div>
  </div>
</footer>
<?php /**PATH /home/u149868318/domains/vizzion.secretysbet.shop/public_html/resources/views/frontend/partials/footer/footer.blade.php ENDPATH**/ ?>