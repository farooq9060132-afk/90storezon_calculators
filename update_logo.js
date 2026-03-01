const fs = require('fs');
const path = require('path');

const dir = 'c:\\\\Users\\\\LENOVO\\\\OneDrive\\\\Desktop\\\\90STOREZON';
const files = [
  'about.html',
  'calculators/age-calculator.html',
  'calculators/compound-interest-calculator.html',
  'calculators/date-difference-calculator.html',
  'calculators/discount-calculator.html',
  'calculators/gpa-calculator.html',
  'calculators/loan-emi-calculator.html',
  'calculators/number-to-words-calculator.html',
  'calculators/percentage-calculator.html',
  'calculators/profit-loss-calculator.html',
  'calculators/simple-interest-calculator.html',
  'contact.html',
  'disclaimer.html',
  'index.html',
  'privacy-policy.html'
];

for (const file of files) {
  const p = path.join(dir, file);
  if (fs.existsSync(p)) {
      let content = fs.readFileSync(p, 'utf8');
      content = content.replace(/<a href="([^"]*)">90STOREZON<\/a>/g, '<a href="$1"><span class="logo-90">90</span><span class="logo-storezon">STOREZON</span></a>');
      content = content.replace(/<div class="footer-logo">90STOREZON<\/div>/g, '<div class="footer-logo"><span class="logo-90">90</span><span class="logo-storezon">STOREZON</span></div>');
      fs.writeFileSync(p, content);
  }
}
