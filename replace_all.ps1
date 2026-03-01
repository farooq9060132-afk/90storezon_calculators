$files = Get-ChildItem -Path . -Recurse | Where-Object { $_.Extension -match '\.(html|md|js|css|txt)$' }

foreach ($file in $files) {
    if ($file.FullName -match 'update_logo\.js' -or $file.FullName -match 'replace\.ps1' -or $file.FullName -match 'replace_all\.ps1') {
        continue
    }
    
    $content = Get-Content $file.FullName -Raw
    
    # Case insensitive replacements
    $newContent = $content -ireplace '10 CALCULATORS', 'CALCULATORS'
    $newContent = $newContent -ireplace '10 Calculators', 'Calculators'
    $newContent = $newContent -ireplace '10 tools', 'tools'
    
    # Exact case replacements to avoid double replacements
    $newContent = $newContent -creplace '90STOREZON', '90StoreZon'
    $newContent = $newContent -creplace 'STOREZON', 'StoreZon'

    if ($content -cne $newContent) {
        Set-Content -Path $file.FullName -Value $newContent -NoNewline
    }
}
