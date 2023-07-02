#Child Theme Foce-child
Version: 1.0.0

#####Project - Enhancing an Animation Studio Website with JavaScript and CSS Animations WordPress (OpenClassrooms)

Author: Kouaki Studios, modified by Diana Spieser

License: GPL-2.0-or-later

##Development Dependencies:

@wordpress/scripts: ^26.6.0
dir-archiver: ^2.1.0
node-sass: ^9.0.0
rtlcss: ^4.1.0

###Scripts:

watch: "node-sass sass/ -o ./dist/css/ --source-map true --output-style expanded --indent-type tab --indent-width 1 -w"
compile:css: "node-sass sass/ -o ./dist/css/ && stylelint 'dist/css/.css' --fix || true && stylelint 'dist/css/.css' --fix"
compile:rtl: "rtlcss style.css style-rtl.css"
lint:scss: "wp-scripts lint-style 'sass/**/.scss'"
lint:js: "wp-scripts lint-js 'js/.js'"
bundle: "dir-archiver --src . --dest ../_s.zip --exclude .DS_Store .stylelintrc.json .eslintrc .git .gitattributes .github .gitignore README.md composer.json composer.lock node_modules vendor package-lock.json package.json .travis.yml phpcs.xml.dist sass style.css.map yarn.lock"

##Dependencies:

jquery-modal: ^0.9.2
swiper: ^9.4.1

##Key Steps Guide:



Project Mission:
The mission is to enhance the website of Kouaki Animation Studio, whose latest film has been nominated for the Best Animated Short Film at the Oscars!

###Project Execution:

1.Install WordPress locally

2.Set up backup functionality.

3.Activate the child theme and copy the files.

4.Create the "dist" directory and set up SASS.

5.Modify the appearance of the logo and titles' fade-in effect.

6.Implement a function to trigger the fade-in effect only when the sections are in view.

7.Add acceleration to flower rotation based on scrolling.

8.Move the flowers to the footer in the new Oscar section.

9.Add a bounce effect to the logo title once it's in place.

10.Make the clouds move vertically by scrolling.

11.Create a SWIPER slider template to display the characters, use JQUERY

12.Add fade-in effects to H2 and H3 titles when scrolling down, using a function  to trigger the effect.

13.Modify the navigation bar:

Replace the menu with a hamburger button that opens a full screen page.
- Set up a modal window to display this new page containing the menu.
- Add decorations (cats and flowers) according to Figma's guidelines, with corresponding animations (cats floating and flowers rotating).

- Use jQuery to manage the appearance and disappearance of the menu modal window.
Modify the display of H3 titles and the logo title on mobile devices as they were displayed too small.
14. Adjust and set up media queries to make the website responsive.

##Happy hacking!
