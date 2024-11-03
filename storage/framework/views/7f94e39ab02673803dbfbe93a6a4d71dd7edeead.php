<footer class="footer py-4">
  <div class="container-fluid">
    <div class="d-block mx-auto">
      <?php
        $date = Date('Y');
        if (!is_null($footerTextInfo)) {
            $footer_text = str_replace('{year}', $date, $footerTextInfo->copyright_text);
        }
      ?>
      <?php echo !is_null($footerTextInfo) ? $footer_text : ''; ?>

    </div>
  </div>
</footer>
<?php /**PATH /home/u149868318/domains/vizzion.secretysbet.shop/public_html/resources/views/backend/partials/footer.blade.php ENDPATH**/ ?>