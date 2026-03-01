$files = Get-ChildItem -Path "c:\Users\LENOVO\OneDrive\Desktop\90STOREZON\calculators" -Filter "*.html"

foreach ($file in $files) {
    $content = Get-Content $file.FullName -Raw
    if ($content -match '../add-on/google-ads.js') {
        $content = $content -replace '../add-on/google-ads.js', '../google-ads/google-ads.js'
        Set-Content -Path $file.FullName -Value $content -NoNewline
    }
}
