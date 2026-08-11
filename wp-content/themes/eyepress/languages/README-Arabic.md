# Arabic Language Support for Eyepress Theme

This directory contains Arabic language files for the Eyepress WordPress theme.

## Files Created:

### 1. Arabic (General) - `ar.po`
- Standard Arabic translation
- Covers most Arabic-speaking regions
- Primary Arabic language file

### 2. Arabic (United Arab Emirates) - `ar_AE.po`
- Specific to UAE region
- Uses UAE-specific terminology where applicable

### 3. Arabic (Saudi Arabia) - `ar_SA.po`
- Specific to Saudi Arabia region
- Uses Saudi-specific terminology where applicable

## To Generate .mo Files:

You need to compile the .po files into .mo files for WordPress to use them. You can do this in several ways:

### Method 1: Using Poedit (Recommended)
1. Download and install Poedit (https://poedit.net/)
2. Open each .po file in Poedit
3. Save the file - Poedit will automatically generate the .mo file

### Method 2: Using WordPress Plugin
1. Install "Loco Translate" plugin
2. Go to Loco Translate > Themes > Eyepress
3. Import the .po files and the plugin will generate .mo files

### Method 3: Using Command Line (if you have gettext)
```bash
msgfmt ar.po -o ar.mo
msgfmt ar_AE.po -o ar_AE.mo
msgfmt ar_SA.po -o ar_SA.mo
```

## How to Use:

1. Ensure the .mo files are generated from the .po files
2. Go to WordPress Admin → Settings → General
3. Change the site language to Arabic (العربية)
4. The theme will automatically load the Arabic translations

## Translation Coverage:

The translation files include:
- ✅ Navigation elements
- ✅ Common theme strings
- ✅ Blog/post related text
- ✅ Comments system
- ✅ Search functionality
- ✅ Error messages
- ✅ Form labels
- ✅ Social media terms
- ✅ Date/time elements
- ✅ Theme-specific Eyepress strings

## Contributing:

To improve translations:
1. Edit the relevant .po file
2. Regenerate the .mo file
3. Test the changes on your site

## Notes:

- The theme already supports RTL (Right-to-Left) layout
- Text domain is properly configured as 'eyepress'
- Plural forms are set up for Arabic (6 plural forms)
- Character encoding is UTF-8 for proper Arabic display
