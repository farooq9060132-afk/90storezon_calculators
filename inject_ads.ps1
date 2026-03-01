$files = Get-ChildItem -Path "c:\Users\LENOVO\OneDrive\Desktop\90STOREZON\calculators" -Filter "*.html"

foreach ($file in $files) {
    $content = Get-Content $file.FullName -Raw
    if ($content -notmatch 'google-ads\.js') {
        # Inject right after the sub div
        $content = [regex]::Replace($content, '(<div class="sub">[\s\S]*?</div>)', "`$1`n`n    <!-- Google Add-on Space -->`n    <script src=`"../add-on/google-ads.js`"></script>")
        Set-Content -Path $file.FullName -Value $content -NoNewline
    }
}
