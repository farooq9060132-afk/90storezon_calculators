$files = Get-ChildItem -Path "c:\Users\LENOVO\OneDrive\Desktop\90STOREZON\calculators" -Filter "*.html"

$shareBtnHtml = @"
<div id="result-section" class="result-box" style="display: none;">
<h2>Result</h2>
<p id="result-text">Your result will appear here.</p>
<button type="button" id="share-btn" class="share-btn" onclick="shareResult()">&#128228; Share Result</button>
</div>
"@

foreach ($file in $files) {
    $content = Get-Content $file.FullName -Raw -Encoding UTF8
    
    # Check if we already injected
    if ($content -notmatch 'id="share-btn"') {
        # structural class replacements to give uniform layout
        $content = $content -replace 'class="container"', 'class="calculator-container"'
        $content = $content -replace 'class="invoice-app"', 'class="calculator-container"'
        $content = $content -replace 'class="app-container"', 'class="calculator-container"'
        
        $content = $content -replace 'class="card input-area"', 'class="calculator-box input-area"'
        $content = $content -replace 'class="calculator-card"', 'class="calculator-box"'
        
        $content = $content -replace 'class="form-group"', 'class="input-group"'
        $content = $content -replace 'class="btn btn-primary"', 'class="calc-btn"'
        $content = $content -replace 'class="primary"', 'class="calc-btn"'
        $content = $content -replace 'class="result-panel"', 'class="result-box"'
        
        # Inject share button block
        $content = $content -replace '<section class="seo-content-section">', ($shareBtnHtml + "`n<section class=`"seo-content-section`">")
        $content = $content -replace '<div class="seo-content">', ($shareBtnHtml + "`n<div class=`"seo-content`">")
        $content = $content -replace '<article class="seo-content-section">', ($shareBtnHtml + "`n<article class=`"seo-content-section`">")

        Set-Content -Path $file.FullName -Value $content -Encoding UTF8 -NoNewline
    }
}
