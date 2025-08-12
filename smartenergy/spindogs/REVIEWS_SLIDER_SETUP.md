# Reviews Slider Setup Guide

## Overview
A new reviews slider has been created that displays multiple reviews at once using the Slick slider functionality. This replaces the single review display with a carousel that shows multiple reviews simultaneously.

## Files Created/Modified

### New Files:
1. `views/flex/blocks/reviews_slider.twig` - Main slider template
2. `views/components/review_item.twig` - Reusable review component
3. `css/reviews-slider.css` - Styles for the reviews slider
4. `images/flex-previews/reviews_slider.png` - Admin preview image
5. `REVIEWS_SLIDER_SETUP.md` - This documentation

## Setup Instructions

### 1. Include CSS
Add the reviews slider CSS to your theme by including it in your `functions.php`:

```php
// Add to functions.php
function enqueue_reviews_slider_styles() {
    wp_enqueue_style(
        'reviews-slider-css',
        get_template_directory_uri() . '/css/reviews-slider.css',
        array(),
        filemtime(get_stylesheet_directory() . '/css/reviews-slider.css'),
        'all'
    );
}
add_action('wp_enqueue_scripts', 'enqueue_reviews_slider_styles');
```

### 2. ACF Field Configuration
Create a new ACF Flexible Content field group with the following fields:

**Field Group: Reviews Slider Block**
- **Field Type:** Flexible Content
- **Field Name:** `reviews_slider_block`
- **Layout:** `reviews_slider`

**Layout Fields:**
- **Title** (Text) - `title`
- **Reviews to Show** (Relationship) - `reviews_to_show`
  - Post Type: Review
  - Multiple: Yes
- **Slides to Show** (Number) - `slides_to_show`
  - Default: 3
- **Slides to Show Tablet** (Number) - `slides_to_show_tablet`
  - Default: 2
- **Slides to Show Mobile** (Number) - `slides_to_show_mobile`
  - Default: 1
- **Autoplay** (Boolean) - `autoplay`
  - Default: Yes
- **Autoplay Speed** (Number) - `autoplay_speed`
  - Default: 5000 (5 seconds)
- **Margin Top** (Select) - `margin_top`
  - Options: None, Small, Medium, Large

### 3. Review Post Type Fields
Ensure your Review post type has these ACF fields:
- **Image** (Image) - `image`
- **Rating** (Number) - `rating` (1-5)
- **Title** (Text) - `title`
- **Content** (Textarea) - `content`
- **Name** (Text) - `name`

## Usage

### In Templates
The reviews slider can be used in any template that supports flexible content:

```twig
{% if flexible_content %}
    {% for block in flexible_content %}
        {% if block.acf_fc_layout == 'reviews_slider' %}
            {% include 'flex/blocks/reviews_slider.twig' with { block: block } %}
        {% endif %}
    {% endfor %}
{% endif %}
```

### In Page Builder
1. Edit any page with flexible content
2. Add a new "Reviews Slider" block
3. Configure the settings:
   - Select reviews to display
   - Set number of slides to show
   - Configure autoplay settings
   - Add title if desired

## Features

### Responsive Design
- **Desktop:** Shows 3 reviews by default
- **Tablet:** Shows 2 reviews by default
- **Mobile:** Shows 1 review by default

### Customization Options
- **Slides per view:** Configurable for each breakpoint
- **Autoplay:** Enable/disable with configurable speed
- **Navigation:** Custom arrow controls
- **Progress bar:** Visual indicator of slider progress

### Styling
- **Light theme:** White cards with dark text
- **Dark theme:** Semi-transparent cards with light text
- **Hover effects:** Cards lift on hover
- **Star ratings:** Gold stars for ratings
- **Typography:** Consistent with theme design

## Customization

### Modifying Styles
Edit `css/reviews-slider.css` to customize:
- Colors and themes
- Card layouts
- Spacing and typography
- Responsive breakpoints

### Modifying Behavior
Edit `views/flex/blocks/reviews_slider.twig` to customize:
- Slider configuration
- JavaScript behavior
- HTML structure

### Adding Features
The slider uses Slick slider, so you can add features like:
- Dots navigation
- Fade transitions
- Center mode
- Touch/swipe support

## Troubleshooting

### Common Issues:
1. **Slider not working:** Ensure jQuery and Slick are loaded
2. **Styles not applying:** Check CSS file is enqueued
3. **Reviews not showing:** Verify ACF relationship field is configured
4. **Responsive issues:** Check breakpoint settings

### Debug Mode:
Enable WordPress debug mode to see any PHP errors:
```php
define('WP_DEBUG', true);
define('WP_DEBUG_LOG', true);
```

## Browser Support
- Chrome 60+
- Firefox 55+
- Safari 12+
- Edge 79+
- Mobile browsers (iOS Safari, Chrome Mobile)

## Performance Notes
- Images are lazy-loaded for better performance
- Slider only initializes when visible
- CSS is optimized for minimal reflows
- JavaScript is non-blocking

## Future Enhancements
Potential improvements:
- Filter reviews by category
- Search functionality
- Infinite scroll
- Video reviews support
- Social sharing integration
