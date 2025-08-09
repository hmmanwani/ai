# Surana Maloo & Co. WordPress Theme

A professional WordPress theme designed specifically for Surana Maloo & Co. Chartered Accountants. This theme converts your static HTML homepage into a fully functional WordPress website with dynamic content management.

## Features

- **Responsive Design**: Mobile-first approach with Bootstrap 5
- **Dynamic Content**: Custom post types for Services and Timeline
- **WordPress Customizer**: Easy content management through WordPress admin
- **Modern UI**: Clean, professional design with smooth animations
- **SEO Optimized**: Proper WordPress structure and meta tags
- **Performance Optimized**: Efficient code and optimized assets

## Installation

### Method 1: Manual Installation

1. **Download the theme files** to your computer
2. **Upload to WordPress**:
   - Go to your WordPress admin panel
   - Navigate to Appearance > Themes
   - Click "Add New" then "Upload Theme"
   - Choose the theme ZIP file and install
3. **Activate the theme** from Appearance > Themes

### Method 2: FTP Upload

1. **Extract the theme files** to a folder named `surana-maloo`
2. **Upload via FTP**:
   - Connect to your server via FTP
   - Navigate to `/wp-content/themes/`
   - Upload the `surana-maloo` folder
3. **Activate the theme** from WordPress admin

## Theme Structure

```
surana-maloo/
├── functions.php          # Theme functions and setup
├── style.css             # Main stylesheet with theme header
├── index.php             # Main template file
├── header.php            # Header template
├── footer.php            # Footer template
├── js/
│   └── script.js         # Custom JavaScript
└── README.md             # This file
```

## Setup Instructions

### 1. Initial Configuration

After activating the theme:

1. **Set up your site title and tagline**:
   - Go to Settings > General
   - Update Site Title and Tagline

2. **Create navigation menus**:
   - Go to Appearance > Menus
   - Create a new menu for "Primary Menu"
   - Add pages: Home, About, Services, Contact
   - Assign to "Primary Menu" location

### 2. Customize Content

#### Hero Section
- Go to Appearance > Customize > Hero Section
- Update the hero title and subtitle
- Changes will appear immediately on your homepage

#### Contact Information
- Go to Appearance > Customize > Contact Information
- Update address, phone, and email
- All contact details will be updated across the site

#### About Section
- Go to Appearance > Customize > About Section
- Update the about title and content
- Statistics are hardcoded but can be modified in the theme files

### 3. Add Services

1. **Create Services**:
   - Go to Services > Add New
   - Add service title and description
   - Set featured image (optional)
   - Publish the service

2. **Service Icons** (Optional):
   - Add custom field `_service_icon` with Bootstrap icon name
   - Example: `calculator`, `shield-check`, `graph-up`

### 4. Add Timeline Events

1. **Create Timeline Events**:
   - Go to Timeline > Add New
   - Add event title and description
   - Set the year in the "Timeline Year" field
   - Add Bootstrap icon class in "Timeline Icon" field
   - Publish the event

2. **Timeline Icons**:
   - Use Bootstrap Icons classes
   - Examples: `bi-building`, `bi-shield-check`, `bi-calculator`

## Customization Options

### Colors
The theme uses CSS custom properties for easy color customization:

```css
:root {
    --primary-color: #1e3a8a;
    --secondary-color: #3b82f6;
    --accent-color: #f59e0b;
    --text-dark: #1f2937;
    --text-light: #6b7280;
}
```

### Adding Custom CSS
- Go to Appearance > Customize > Additional CSS
- Add your custom styles

### Modifying Templates
- Copy template files to a child theme for safe modifications
- Never edit theme files directly

## Content Management

### Services Management
- **Add/Edit Services**: WordPress admin > Services
- **Service Icons**: Use Bootstrap Icons (bi-* classes)
- **Service Order**: Use the "Order" field in the service editor

### Timeline Management
- **Add/Edit Events**: WordPress admin > Timeline
- **Year Field**: Required for proper ordering
- **Icon Field**: Bootstrap Icons class name

### Contact Information
- **Update Contact Details**: Appearance > Customize > Contact Information
- **Address Formatting**: Use `<br>` tags for line breaks

## Browser Support

- Chrome (latest)
- Firefox (latest)
- Safari (latest)
- Edge (latest)
- Internet Explorer 11+

## Performance Tips

1. **Optimize Images**: Compress images before uploading
2. **Use Caching**: Install a caching plugin
3. **Minimize Plugins**: Only use necessary plugins
4. **Regular Updates**: Keep WordPress and theme updated

## Troubleshooting

### Common Issues

1. **Menu not appearing**:
   - Check if menu is assigned to "Primary Menu" location
   - Clear cache if using caching plugin

2. **Services not showing**:
   - Ensure services are published
   - Check if services have content

3. **Timeline events not ordered**:
   - Verify year field is filled
   - Check for proper number format

4. **Styling issues**:
   - Clear browser cache
   - Check for conflicting plugins
   - Verify CSS is loading properly

### Getting Help

If you encounter issues:

1. **Check WordPress Debug Log**: Enable debugging in wp-config.php
2. **Test with Default Theme**: Switch to default theme to isolate issues
3. **Disable Plugins**: Temporarily disable plugins to check for conflicts
4. **Check Browser Console**: Look for JavaScript errors

## Support

For theme support and customization requests, please contact your developer or refer to WordPress documentation.

## Changelog

### Version 1.0
- Initial release
- Responsive design with Bootstrap 5
- Custom post types for Services and Timeline
- WordPress Customizer integration
- Modern animations and interactions

## License

This theme is developed for Surana Maloo & Co. Please ensure you have proper licensing for any third-party assets used.

---

**Note**: Always backup your website before making changes, and test thoroughly in a staging environment before deploying to production. 