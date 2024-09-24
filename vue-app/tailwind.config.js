/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./index.html",
    "./src/**/*.{vue,js,ts,jsx,tsx}",
  ],
  theme: {
    extend: {
      backgroundImage:{
        'custom-linear':'linear-gradient(180deg, hsla(0, 100%, 50%, 1) 0%, hsla(0, 20%, 10%, 1) 100%, hsla(0, 2%, 8%, 1) 100%)'
      }
    },
  },
  plugins: [],
}

