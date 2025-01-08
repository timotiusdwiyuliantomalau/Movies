/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./index.html",
    "./src/**/*.{vue,js,ts,jsx,tsx}",
  ],
  theme: {
    extend: {
      backgroundImage:{
        'custom-linear':'linear-gradient(180deg, rgb(13, 1, 1) 0%, rgb(176, 30, 30) 100%, hsla(0, 2%, 8%, 1) 100%)'
      }
    },
  },
  plugins: [],
}

