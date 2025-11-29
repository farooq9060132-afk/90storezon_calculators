<?php
// In-article ads template
if ($ads_config['enabled']) {
    echo '<!-- In-Article Ad -->';
    echo '<div class="inarticle-ad">';
    echo '  <ins class="adsbygoogle"';
    echo '       style="display:block; text-align:center;"';
    echo '       data-ad-client="' . $ads_config['ad_client'] . '"';
    echo '       data-ad-slot="' . $ads_config['inarticle_ad_slot'] . '"';
    echo '       data-ad-format="fluid"';
    echo '       data-full-width-responsive="true"></ins>';
    echo '  <script>(adsbygoogle = window.adsbygoogle || []).push({});</script>';
    echo '</div>';
}
?>