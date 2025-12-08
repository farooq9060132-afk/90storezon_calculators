<?php include '../header.php'; ?>

<div class="vip-container">
    <header class="vip-header">
        <h1><i class="fas fa-calculator"></i> {CALCULATOR_TITLE}</h1>
        <p>{CALCULATOR_DESCRIPTION}</p>
    </header>

    <!-- Google Ads Slot -->
    <div class="ad-slot top-ad">
        [AD_TOP_BANNER]
    </div>

    <div class="calculator-container">
        {CALCULATOR_CONTENT}
    </div>

    <!-- Google Ads Slot -->
    <div class="ad-slot middle-ad">
        [AD_MIDDLE_BANNER]
    </div>

    <div class="result-container" id="resultContainer">
        {RESULT_CONTAINER}
    </div>
</div>

<!-- Google Ads Slot -->
<div class="ad-slot bottom-ad">
    [AD_BOTTOM_BANNER]
</div>

<?php include '../footer.php'; ?>