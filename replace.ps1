$files = @(
  'about.html',
  'calculators\age-calculator.html',
  'calculators\compound-interest-calculator.html',
  'calculators\date-difference-calculator.html',
  'calculators\discount-calculator.html',
  'calculators\gpa-calculator.html',
  'calculators\loan-emi-calculator.html',
  'calculators\number-to-words-calculator.html',
  'calculators\percentage-calculator.html',
  'calculators\profit-loss-calculator.html',
  'calculators\simple-interest-calculator.html',
  'contact.html',
  'disclaimer.html',
  'index.html',
  'privacy-policy.html'
)

foreach ($file in $files) {
    if (Test-Path $file) {
        $content = Get-Content $file -Raw
        $content = [regex]::Replace($content, '<a href="([^"]*)">90STOREZON</a>', '<a href="$1"><span class="logo-90">90</span><span class="logo-storezon">STOREZON</span></a>')
        $content = [regex]::Replace($content, '<div class="footer-logo">90STOREZON</div>', '<div class="footer-logo"><span class="logo-90">90</span><span class="logo-storezon">STOREZON</span></div>')
        
        # In case the specific file is active and the logo might be somehow active - although it shouldn't have .active class, let's just make sure we capture it
        $content = [regex]::Replace($content, '<a href="([^"]*)" class="active">90STOREZON</a>', '<a href="$1" class="active"><span class="logo-90">90</span><span class="logo-storezon">STOREZON</span></a>')

        Set-Content -Path $file -Value $content -NoNewline
    }
}
