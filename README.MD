# Highstarter
Highstarter is a lightweight starter theme developed by Atanas Yonkov in 2020. It doesn't use any libraries or frameworks - only core WordPress functions, custom css and vanilla js. This makes it fast, simple, and easy to adapt to any design. This tiny WordPress theme (only 33KB zip file excluding the header image and the screenshot) uses minimum resources to provide maximum results and the best possible user experience. It has extensive documentation and a lot of options in the theme customizer, which makes it accessible not only to WordPress developers but also to people with little or no coding experience at all. Option to pick between right sidebar or full-width layout. The visitors can choose between light and dark (night) theme mode and change their preferences with a single click. Option to use a static Homepage. Option to add custom header image, custom header call to action button, custom site icon and change theme accent colors from the theme customizer. The theme also offers a lot of options to customize the header image. Add parallax, image overlay or change the height of the header image with a single click. The theme supports nested dropdown sub menus, pagination and even breadcrumbs out of the box. Fully compatible with Gutenberg but also supports the good old Classic editor.

**Table of Contents**
- [Highstarter](#highstarter)
- [Theme Documentation](#theme-documentation)
  - [Installation](#installation)
  - [Theme Options](#theme-options)
    - [Site identity](#site-identity)
    - [Header Image](#header-image)
    - [Header Options](#header-options)
    - [Page Layout](#page-layout)
    - [Colors](#colors)
    - [Widgets](#widgets)
    - [Menus](#menus)
    - [Homepage Settings](#homepage-settings)
    - [Night Mode](#night-mode)
    - [Additional CSS](#additional-css)
  - [Child theme](#child-theme)
- [License](#license)

Highstarter has just enough theme options to get you started. In fact, its theme customizer offers more options than most of the other free themes in the market:

- light and dark theme mode switch
- custom header image
- options to change header image height and position
- options to add image overlay and parallax effect to the header image
- custom call to action button on homepage
- custom logo
- custom site icon
- custom menu
- nested dropdown submenus
- keyboard navigation
- static homepage
- beautiful icons
- change theme accent colors, headings, links and buttons
- choose between beautiful right sidebar page layout or full-width layout
- beautiful pagination
- simple breadcrumbs
- add custom widgets to right sidebar and footer
- responsive design on tablets and mobile
- translation ready
- beginner-friendly
- developer-friendly
- lightweight

# Theme Documentation

## Installation
1. In your admin panel, go to Appearance -> Themes and click the 'Add New' button.
2. Type in Highstarter in the search form and press the 'Enter' key on your keyboard.
3. Click on the 'Activate' button to use your new theme right away.
4. Navigate to Appearance > Customize in your admin panel and customize to taste.

## Theme Options
Use the theme customizer to customize the theme to taste. There are just enough options to make your site unique. You can change the header background color, the headings text color, the primary menu text color, the call to action button on the homepage and more. 

To use the theme's customizer log in to your dashboard and navigate to Appearance > Customize. You can also access the customizer directly from the admin bar on the top of the page.

### Site identity

* **Upload logo** - you have the option to upload custom logo that will display in the site's header. 

* **Change Site Title & Tagline** - you have the option to add a site's name and description

* **Site Icon** - you have the option to change the site icon in the browser tab (the tab icon at the top part of your browser)

### Header Image
Highstarter supports the option to add custom header image via the theme customizer. Go to Appearance > Customize > Header Image and upload a header image from your PC. The recommended image size is 2000X420px. You have the options to crop the image (top, bottom or center) or to use the whole image (in this case it should center vertically). As a general recommendation, I would suggest to always compress the images that you upload, otherwise the site performace may deteriorate with time. Read more about that [here](https://rawinfopages.co.uk/squash-images-with-squoosh-to-improve-website-performance/).

### Header Options
When you scroll down in the same section from the theme customizer (Header Image), you will see that there are options to customize the header image and the call to action button in the header of the homepage. You can choose to change the image position, change the image height, display paralax effect and image overlay.

The call to action banner is the big orange button on the header of the homepage. You can change the url and the text of the header banner from the Call to Action section in the theme customizer. You can also hide the button if you leave any of the two fields empty.

### Page Layout
Choose between page layout with right sidebar, left sidebar or full-width layout with a single click.

### Colors
Change the colors of the light theme such as the header, the headings, the links, the buttons and the primary menu text items.

### Widgets
Widgets are something very useful if you want to display dynamic info such as latest posts, latest comments or post archives on the website. Highstarter theme supports two places to add widgets: the right sidebar and the footer. If you have chosen full-width layout, you will be able to add widgets in the footer only. This theme works best if you add just one widget in "Footer 1" and two widgets in "Footer 2". In the "Right Sidebar" widget you can add as many widgets as you want.

### Menus
This theme supports two menu locations - Top menu and Social Links Menu. 

* **Top Menu** - You can create the primary menu from the theme customizer or you can also go to dashboard > menu. Click on create menu and give it a name, then drag or add the pages you want to it. After that, from the menu locations section, select Top Menu checkbox. This theme supports as many sub-menus as you want.

* **Social Links Menu** - You can add social links to this menu location. It is not displayed by default but you can add it as a menu widget in the sidebar or the footer. You can also use dashicons to show beautiful social media icons for better user experience.

After you create the menu and add it to the Social links menu location, click on add items > custom links and in the navigation label tab add the following html code: 

```<span class="dashicons dashicons-facebook-alt"></span>```

In the url tab add the exact address of the facebook link, e.g. https://facebook.com/wordpress

Other menu items that you may wish to add:

```<span class="dashicons dashicons-twitter"></span>```

```<span class="dashicons dashicons-instagram"></span>```

You can add as many social icons as you wish. For more information check Dashicons's documentation: https://developer.wordpress.org/resource/dashicons/

### Homepage Settings
Optionally specify a static front page.

### Night Mode
Protect your visitors' eyes and help them spend more time on your website by allowing them to switch between day and night mode (light and dark layout). To change to dark mode, you just need to click on the toggle button in the theme footer. You can change the background color and add custom css to further customize the colors of the night mode. For example, if you want to change the link colors, you can use the following css:

    body.dark-mode a {
	    color: rgba(102, 222, 209, .8) !important;
    }

### Additional CSS
This section is for more advanced users who want to write custom css to override the default theme's styles.

## Child theme

If you want to customise Highstarter beyond the included options, I strongly recommend that you do so via a [child theme](https://developer.wordpress.org/themes/advanced-topics/child-themes/). Here is a [premade child theme](https://github.com/yonkov/highstarter-child) of the Highstarter theme that you can use to get started.

# License
* License: [GNU General Public License v2.0](http://www.gnu.org/licenses/gpl-2.0.html)

Happy blogging!