# Quick Reference Guide - 90StoreZon

## 🚀 Getting Started in 3 Steps

1. **Open** `index.html` in your browser
2. **Test** all pages and features
3. **Customize** content and deploy

---

## 📁 File Structure at a Glance

```
90StoreZon/
├── index.html              ← Homepage (START HERE)
├── about.html              ← About page
├── contact.html            ← Contact form
├── privacy-policy.html     ← Privacy policy
├── disclaimer.html         ← Disclaimer
├── css/style.css          ← All styles
├── js/main.js             ← All JavaScript
├── calculators/           ← 10 calculator pages
├── assets/                ← Images & icons
├── README.md              ← Project overview
├── SETUP-GUIDE.md         ← Detailed setup
└── PROJECT-SUMMARY.md     ← Complete summary
```

---

## 🎨 Quick Customization

### Change Colors
**File:** `css/style.css` (Lines 8-15)
```css
:root {
    --primary-color: #3b50f7;  ← Change this
    --secondary-color: #3b50f7; ← And this
}
```

### Update Domain
**Find & Replace in all files:**
- Find: `https://90storezon.com/`
- Replace: `https://yourdomain.com/`

### Change Logo Text
**Find in all HTML files:**
```html
<div class="logo">
    <a href="index.html">90StoreZon</a> ← Change this
</div>
```

### Update Contact Email
**File:** `contact.html` (Line ~50)
```html
support@90storezon.com ← Change this
```

### Update Social Links
**Find in footer of all HTML files:**
```html
<a href="https://facebook.com" ← Change URL
```

---

## 🧮 Calculator Status

| Calculator | Status | File |
|------------|--------|------|
| Age Calculator | ✅ WORKING | age-calculator.html |
| Percentage | 🔨 Placeholder | percentage-calculator.html |
| Date Difference | ✅ WORKING | date-difference-calculator.html |
| Loan EMI | 🔨 Placeholder | loan-emi-calculator.html |
| Simple Interest | 🔨 Placeholder | simple-interest-calculator.html |
| Compound Interest | 🔨 Placeholder | compound-interest-calculator.html |
| Profit & Loss | 🔨 Placeholder | profit-loss-calculator.html |
| Discount | 🔨 Placeholder | discount-calculator.html |
| GPA | 🔨 Placeholder | gpa-calculator.html |
| Number to Words | 🔨 Placeholder | number-to-words-calculator.html |

---

## 🔧 Common Tasks

### Add a New Page
1. Copy existing HTML file
2. Update title and meta tags
3. Update navigation active class
4. Add link in footer
5. Add to sitemap.xml

### Add Images
1. Place in `assets/images/`
2. Reference: `<img src="assets/images/yourimage.jpg">`
3. Add alt text for SEO

### Add Favicon
1. Generate at https://favicon.io/
2. Place files in `assets/icons/`
3. Already linked in HTML `<head>`

### Modify Footer
**Find in all HTML files:** `<footer class="footer">`
- Column 1: Brand & social
- Column 2: Calculator links
- Column 3: Important pages
- Column 4: Quick links

---

## 📱 Testing Checklist

Quick test before deployment:
- [ ] Open index.html - loads correctly
- [ ] Click all navigation links - work
- [ ] Test mobile menu - opens/closes
- [ ] Try Age Calculator - calculates
- [ ] Submit contact form - validates
- [ ] Click FAQ items - expand/collapse
- [ ] Scroll down - scroll-to-top appears
- [ ] Test on mobile device
- [ ] Check all footer links

---

## 🌐 Deployment Quick Steps

### Option 1: FTP Upload
1. Connect to your hosting via FTP
2. Upload all files maintaining structure
3. Test live site

### Option 2: GitHub Pages
```bash
git init
git add .
git commit -m "Initial commit"
git remote add origin YOUR_REPO_URL
git push -u origin main
```
Enable GitHub Pages in repo settings

### Option 3: Netlify
1. Drag & drop entire folder to Netlify
2. Done!

---

## 🔍 SEO Quick Wins

After deployment:
1. Submit sitemap: `yourdomain.com/sitemap.xml`
2. Google Search Console: Add property
3. Google Analytics: Add tracking code
4. Test mobile-friendly: Google Mobile Test
5. Test speed: PageSpeed Insights

---

## 💡 Quick Fixes

### Styles not loading?
- Check file path: `css/style.css`
- Clear browser cache (Ctrl+F5)

### JavaScript not working?
- Check console for errors (F12)
- Verify `js/main.js` path

### Mobile menu stuck?
- Clear cache
- Check JavaScript loaded

### Calculator not working?
- Only Age Calculator is functional
- Others need implementation

---

## 📊 Key Features

✅ Fully responsive
✅ SEO optimized
✅ Fast loading
✅ No dependencies
✅ Modern design
✅ Animated effects
✅ Form validation
✅ Mobile menu
✅ Scroll effects
✅ FAQ accordion

---

## 🎯 Priority Tasks

**Before Launch:**
1. Add favicon (5 min)
2. Update domain URLs (10 min)
3. Update contact info (5 min)
4. Test all pages (15 min)

**After Launch:**
1. Submit to Google (10 min)
2. Add Analytics (5 min)
3. Share on social media
4. Monitor traffic

**Optional:**
- Implement remaining calculators
- Add more content
- Add blog section

---

## 📞 Need Help?

1. Check **SETUP-GUIDE.md** for detailed instructions
2. Check **README.md** for project overview
3. Check **PROJECT-SUMMARY.md** for complete details
4. Review code comments in files

---

## 🎨 Color Codes Reference

- Primary: `#3b50f7` (Blue)
- Text Dark: `#1a1a1a` (Almost Black)
- Text Light: `#666` (Gray)
- Background: `#ffffff` (White)
- Light BG: `#f8f9fa` (Light Gray)
- Border: `#e0e0e0` (Light Gray)

---

## 📏 Responsive Breakpoints

- Mobile: `max-width: 480px`
- Tablet: `max-width: 768px`
- Desktop: `1200px+`

---

## ⚡ Performance Tips

- Images: Compress before upload
- CSS: Already minified structure
- JS: Already optimized
- Hosting: Use CDN if possible
- Cache: Enable browser caching

---

## ✨ Animation Classes

Use these in HTML:
- `.fade-in` - Fade in on load
- `.fade-in-scroll` - Fade in on scroll
- Add to any element for effects

---

## 🔗 Important URLs to Update

Replace in all files:
- `https://90storezon.com/` → Your domain
- `support@90storezon.com` → Your email
- Social media links → Your profiles

---

## 📝 Content Sections

**Homepage has:**
- Hero section
- Introduction (3 paragraphs)
- 10 calculator cards
- Why choose us (4 cards)
- Detailed content (800+ words)
- FAQ (5 questions)

**Other pages:**
- About: Company story
- Contact: Form + info
- Privacy: Policy details
- Disclaimer: Legal info

---

## 🎉 You're Ready!

Everything is set up and ready to go. Just customize, test, and deploy!

**90StoreZon - FINAL BEST CALCULATORS**

---

*Last Updated: 2024*
*Version: 1.0*
