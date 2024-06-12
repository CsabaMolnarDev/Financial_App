/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      backgroundImage: {
        'spending': 'url("/public/storage/pictures/spendingPic.jpg")',
        'income': 'url("/public/storage/pictures/incomePic.jpg")',
        'home': 'url("/public/storage/pictures/homePic.jpg")',
      }
    },
  },
  plugins: [],
}

