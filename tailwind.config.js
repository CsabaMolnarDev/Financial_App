/** @type {import('tailwindcss').Config} */
/* 
  For the configs:
  https://tailwindcss.com/docs/theme#configuration-reference
*/
export default {
  mode: 'jit',
  darkMode: 'class',
  content: [
    /* NEVER LINK CSS HERE */
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  safelist: [
    /* 
    For the smallest file size and best development experience, we highly recommend 
    relying on your content configuration to tell Tailwind which classes to generate as much as possible.
    Safelisting is a last-resort, and should only be used in situations where 
    it’s impossible to scan certain content for class names. These situations are rare, and you should almost never need this feature.
    If you need to make sure Tailwind generates certain class names that don’t exist in your content files, use the safelist option:
    */
  ],
  blocklist: [
    /* You may also want to prevent Tailwind from generating certain classes when those classes
     would conflict with some existing CSS, but you don’t want to go so far as to prefix all of your Tailwind classes.
    In these situations, you can use the blocklist option to tell Tailwind to ignore 
    specific classes that it detects in your content: 
    */
  ],
  theme: {
    /* Anything here OVERWRITES */

    /* Anything here EXTENDS */
    extend: {
      colors: {
        'light': '#FBFBFB',
        'dark': '#212529',
      },
      /* Import images that will be used as backgrounds */
      backgroundImage: {
        'spending': 'url("/public/storage/pictures/spendingPic.jpg")',
        'income': 'url("/public/storage/pictures/incomePic.jpg")',
        'incomeCreate': 'url("/public/storage/pictures/incomeCreatePic.jpg")',
        'home': 'url("/public/storage/pictures/homePic.jpg")',
        'settings': 'url("/public/storage/pictures/settingsPic.jpg")',
        'login': 'url("/public/storage/pictures/loginPic.jpg")',
        'register': 'url("/public/storage/pictures/registerPic.jpg")',
        /* Icons */
        'homeIcon': 'url("/public/storage/pictures/homePic.jpg")',
      },

    },
  },
  plugins: ["prettier-plugin-tailwindcss"],
}

