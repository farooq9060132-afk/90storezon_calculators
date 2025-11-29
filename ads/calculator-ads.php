<?php
// Calculator-specific ads template
if ($ads_config['enabled']) {
    echo '<!-- Calculator Ad -->';
    echo '<div class="calculator-ad">';
    echo '  <ins class="adsbygoogle"';
    echo '       style="display:block"';
    echo '       data-ad-client="' . $ads_config['ad_client'] . '"';
    echo '       data-ad-slot="' . $ads_config['calculator_ad_slot'] . '"';
    echo '       data-ad-format="auto"';
    echo '       data-full-width-responsive="true"></ins>';
    echo '  <script>(adsbygoogle = window.adsbygoogle || []).push({});</script>';
    echo '</div>';
}
?>