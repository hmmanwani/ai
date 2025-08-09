# Quick Installation Guide - Surana Maloo WordPress Theme

## Step-by-Step Installation

### 1. Prepare Your WordPress Site
- Ensure you have a WordPress installation (version 5.0 or higher recommended)
- Make sure your hosting supports PHP 7.4 or higher
- Have admin access to your WordPress dashboard

### 2. Upload the Theme

#### Option A: WordPress Admin Upload
1. **Download the theme files** to your computer
2. **Create a ZIP file** containing all theme files:
   - `functions.php`
   - `style.css`
   - `index.php`
   - `header.php`
   - `footer.php`
   - `page.php`
   - `js/script.js`
   - `README.md`
3. **Upload via WordPress Admin**:
   - Go to Appearance > Themes
   - Click "Add New" → "Upload Theme"
   - Choose your ZIP file and click "Install Now"
   - Click "Activate" to activate the theme

#### Option B: FTP Upload
1. **Extract theme files** to a folder named `surana-maloo`
2. **Upload via FTP**:
   - Connect to your server via FTP
   - Navigate to `/wp-content/themes/`
   - Upload the `surana-maloo` folder
3. **Activate the theme** from WordPress admin

### 3. Initial Setup

#### Set Site Information
1. Go to **Settings > General**
2. Update:
   - Site Title: "Surana Maloo & Co."
   - Tagline: "Chartered Accountants"
   - Save Changes

#### Create Navigation Menu
1. Go to **Appearance > Menus**
2. Create a new menu called "Primary Menu"
3. Add these pages (create them if they don't exist):
   - Home (link to `#`)
   - About (link to `#about`)
   - Services (link to `#services`)
   - Contact (link to `#contact`)
4. Assign to "Primary Menu" location
5. Save Menu

### 4. Customize Content

#### Hero Section
1. Go to **Appearance > Customize > Hero Section**
2. Update:
   - Hero Title: "Trusted Chartered Accountants"
   - Hero Subtitle: Your custom subtitle
3. Click "Publish"

#### Contact Information
1. Go to **Appearance > Customize > Contact Information**
2. Update:
   - Address: Your business address
   - Phone: Your phone number
   - Email: Your email address
3. Click "Publish"

#### About Section
1. Go to **Appearance > Customize > About Section**
2. Update the about title and content
3. Click "Publish"

### 5. Add Services (Optional)

1. Go to **Services > Add New**
2. Create services with:
   - Title: Service name
   - Description: Service description
   - Featured image (optional)
3. Publish each service

### 6. Add Timeline Events (Optional)

1. Go to **Timeline > Add New**
2. Create events with:
   - Title: Event title
   - Description: Event description
   - Timeline Year: Year (e.g., 1991)
   - Timeline Icon: Bootstrap icon class (e.g., bi-building)
3. Publish each event

### 7. Test Your Site

1. **Visit your homepage** to see the theme in action
2. **Test responsive design** on mobile devices
3. **Check all sections** are displaying correctly
4. **Test navigation** links work properly

## Quick Troubleshooting

### If menu doesn't appear:
- Check menu is assigned to "Primary Menu" location
- Clear any caching plugins

### If services don't show:
- Ensure services are published
- Check services have content

### If styling looks wrong:
- Clear browser cache
- Check for conflicting plugins

### If customizer changes don't appear:
- Click "Publish" in customizer
- Clear any caching

## Next Steps

1. **Add your logo**: Go to Appearance > Customize > Site Identity
2. **Create additional pages**: About, Services, Contact pages
3. **Add content**: Fill in your business information
4. **Optimize images**: Compress images for better performance
5. **Set up SEO**: Install an SEO plugin like Yoast SEO

## Support

If you encounter issues:
1. Check the main README.md file for detailed instructions
2. Ensure your WordPress version is compatible
3. Test with default theme to isolate issues
4. Check for plugin conflicts

---

**Important**: Always backup your website before making changes! 