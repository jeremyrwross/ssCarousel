# ssCarousel

Based on the great script: http://kenwheeler.github.io/slick/

This set of files will create a sidebar which can contain widgets to create a carousel that can be place inside your WordPress template files or content.

### Install Instructions

How to integrate into your theme

- Open add-to-functions.php and copy the code into the bottom of your existing themes functions.php file. 
- Add the following folders to your WordPress theme: scripts, Scss & widgets.
- Open your themes style.scss file, and add this code to the imports section: @import ‘scss/slick’;
- Open template.php and copy the code and place into your header.php or footer.php file.
    - or use the following shortcode to place inside the content: [get_slick_sidebar]

### Modifying the carousel items

To modify what your carousel items contains, simply open the php file inside the widgets folder and edit the first section of variables.

### Adding more than one carousel

Coming soon!

#### Todo

- 