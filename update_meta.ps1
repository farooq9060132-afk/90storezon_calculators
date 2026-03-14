$files = Get-ChildItem -Path "c:\Users\LENOVO\OneDrive\Desktop\90STOREZON\calculators" -Filter "*.html"
foreach ($file in $files) {
    $content = Get-Content $file.FullName -Raw
    $newContent = $content -replace '<meta name="viewport"[^>]*>', '<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">'
    Set-Content -Path $file.FullName -Value $newContent -NoNewline
}
