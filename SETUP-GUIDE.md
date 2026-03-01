# 90StoreZon Setup Guide

## 📋 Quick Start

1. **Extract/Clone the project** to your desired location
2. **Open `index.html`** in your web browser to view the website
3. **Test all pages** to ensure everything works correctly

## 🔧 Configuration Steps

### Step 1: Update Domain Information

Replace all instances of `https://90storezon.com/` with your actual domain:

Files to update:
- `index.html` (canonical URL, Open Graph, Twitter Cards)
- `about.html` (canonical URL)
- `contact.html` (canonical URL)
- `privacy-policy.html` (canonical URL)
- `disclaimer.html` (canonical URL)
- All calculator HTML files in `/calculators/` folder

### Step 2: Add Favicon and Images

1. Generate favicon files using https://favicon.io/
2. Place files in `assets/icons/` folder:
   - favicon.png
   - favicon.ico
   - apple-touch-icon.png

3. Create or add images to `assets/images/` folder:
   - logo.png (for header/footer)
   - og-image.jpg (1200x630px for social sharing)
   - twitter-image.jpg (1200x675px for Twitter)

### Step 3: Update Contact Information

Edit these files with your actual contact details:
- `contact.html` - Update email address
- `footer` sections in all HTML files - Update social media links

### Step 4: Customize Content

1. **Homepage (`index.html`)**
   - Review and edit SEO content
   - Update calculator descriptions if needed
   - Modify FAQ section

2. **About Page (`about.html`)**
   - Personalize your story
   - Update mission statement

3. **Contact Page (`contact.html`)**
   - Configure form submission (currently front-end only)
   - Add backend form handling if needed

### Step 5: Implement Remaining Calculators

Currently, only the Age Calculator is fully functional. To add functionality to other calculators:

1. Open the calculator HTML file (e.g., `calculators/percentage-calculator.html`)
2. Add calculator-specific HTML form elements
3. Write JavaScript calculation logic
4. Style with existing CSS classes or add new styles

Example structure for each calculator:
```html
<div class="calculator-box">
    <h2>Calculator Name</h2>
    <div class="calculator-form">
        <div class="form-group">
            <label>Input Label</label>
            <input type="text" class="calc-input">
        </div>
        <button onclick="calculate()" class="calc-btn">Calculate</button>
        <div id="result" class="result-box"></div>
    </div>
</div>
```

## 🌐 Deployment

### Option 1: Traditional Web Hosting

1. Upload all files via FTP/SFTP to your web server
2. Ensure folder structure is maintained
3. Set proper file permissions (644 for files, 755 for folders)
4. Test all pages after upload

### Option 2: GitHub Pages

1. Create a GitHub repository
2. Push all files to the repository
3. Enable GitHub Pages in repository settings
4. Access via `https://yourusername.github.io/repository-name/`

### Option 3: Netlify/Vercel

1. Create account on Netlify or Vercel
2. Connect your Git repository or drag & drop folder
3. Deploy with one click
4. Custom domain setup available

## 🔍 SEO Optimization Checklist

- [ ] Update all meta titles and descriptions
- [ ] Replace placeholder domain with actual domain
- [ ] Add Google Analytics tracking code
- [ ] Create and submit sitemap.xml
- [ ] Create robots.txt file
- [ ] Verify structured data with Google's Rich Results Test
- [ ] Submit to Google Search Console
- [ ] Optimize images (compress, add alt text)
- [ ] Test page speed with PageSpeed Insights
- [ ] Ensure mobile-friendliness with Mobile-Friendly Test

## 📱 Testing Checklist

### Browser Testing
- [ ] Chrome (latest version)
- [ ] Firefox (latest version)
- [ ] Safari (latest version)
- [ ] Edge (latest version)

### Device Testing
- [ ] Desktop (1920x1080)
- [ ] Laptop (1366x768)
- [ ] Tablet (768x1024)
- [ ] Mobile (375x667)

### Functionality Testing
- [ ] Navigation menu (desktop & mobile)
- [ ] All internal links work
- [ ] Contact form validation
- [ ] Age Calculator functionality
- [ ] Scroll to top button
- [ ] FAQ accordion
- [ ] Loading animation
- [ ] Smooth scrolling

## 🎨 Customization Options

### Change Theme Colors

Edit `css/style.css` - CSS Variables section:
```css
:root {
    --primary-color: #3b50f7;      /* Change to your brand color */
    --secondary-color: #3b50f7;    /* Change to your accent color */
    --text-dark: #1a1a1a;
    --text-light: #666;
}
```

### Modify Animations

Adjust animation speeds in `css/style.css`:
```css
--transition: all 0.3s ease;  /* Change duration */
```

### Update Font

Add Google Fonts or change font family in `css/style.css`:
```css
body {
    font-family: 'Your Font', sans-serif;
}
```

## 🔒 Security Recommendations

1. **Form Handling**: Implement server-side form validation and spam protection
2. **HTTPS**: Always use HTTPS in production
3. **Content Security Policy**: Add CSP headers
4. **Regular Updates**: Keep code updated and secure

## 📊 Analytics Setup

### Google Analytics

Add before closing `</head>` tag in all HTML files:
```html
<!-- Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=GA_MEASUREMENT_ID"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'GA_MEASUREMENT_ID');
</script>
```

### Google AdSense

Add AdSense code where you want ads to appear.

## 🐛 Troubleshooting

### Issue: Styles not loading
- Check file paths are correct (relative paths)
- Ensure `css/style.css` exists
- Clear browser cache

### Issue: JavaScript not working
- Check browser console for errors
- Ensure `js/main.js` is loaded
- Verify file paths

### Issue: Mobile menu not working
- Check JavaScript is enabled
- Verify nav-toggle element exists
- Test in different browsers

## 📞 Support

For questions or issues:
- Review README.md
- Check code comments
- Test in different browsers
- Validate HTML/CSS

## ✅ Pre-Launch Checklist

- [ ] All pages load correctly
- [ ] All links work (internal and external)
- [ ] Contact form validates properly
- [ ] Age Calculator works correctly
- [ ] Mobile responsive on all pages
- [ ] Images and icons added
- [ ] Favicon displays correctly
- [ ] Meta tags updated with actual domain
- [ ] Social media links updated
- [ ] Contact information updated
- [ ] Browser testing completed
- [ ] Page speed optimized
- [ ] SEO tags verified
- [ ] Analytics code added
- [ ] Sitemap created
- [ ] Robots.txt created

## 🚀 Post-Launch Tasks

1. Submit sitemap to Google Search Console
2. Monitor analytics for traffic
3. Test all calculators with real users
4. Gather feedback and improve
5. Implement remaining calculator functionality
6. Add more SEO content
7. Build backlinks
8. Promote on social media

---

**Need Help?**
Refer to the code comments in each file for detailed explanations.

**90StoreZon - FINAL BEST CALCULATORS**
