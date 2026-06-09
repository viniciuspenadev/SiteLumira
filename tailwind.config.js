/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./*.{php,html,js}",
    "./includes/**/*.{php,html,js}",
    "./components/**/*.{php,html,js}",
    "./admin/**/*.{php,html,js}"
  ],
  theme: {
    extend: {
      fontFamily: {
        sans: ['Nunito', 'sans-serif'],
      },
      colors: {
        lumira: {
          blue: '#5C8D9D',
          orange: '#F59E3F',
          dark: '#35525E',
          light: '#EBF4F7',
        }
      }
    }
  },
  plugins: [],
}
