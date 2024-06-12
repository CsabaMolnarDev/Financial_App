/** @type {import('tailwindcss').Config} */
export default {
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
    /* 
    For the configs:
    https://tailwindcss.com/docs/theme#configuration-reference
     */
    /* Anything here EXTENDS */
    extend: {
      /* Import images that will be used as backgrounds */
      backgroundImage: {
        'spending': 'url("/public/storage/pictures/spendingPic.jpg")',
        'income': 'url("/public/storage/pictures/incomePic.jpg")',
        'home': 'url("/public/storage/pictures/homePic.jpg")',
      },
    },
  },
  plugins: [],
}

