/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./index.html",
    "./pages/**/*.html"
  ],
  theme: {
    extend: {
      colors: {
        'kumkum': '#c1121f',
        'turmeric': '#f4a261',
        'deep-black': '#0f0f0f',
        'tilgul-white': '#ffffff',
        'cream': '#fdf6ec',
      },
      fontFamily: {
        'marathi': ['Tiro Devanagari Marathi', 'sans-serif'],
        'baloo': ['Baloo 2', 'sans-serif'],
      },
      animation: {
        'spin-slow': 'spin 15s linear infinite',
        'marquee': 'marquee 25s linear infinite',
        'float': 'float 4s ease-in-out infinite',
        'float-slow': 'float-slow 6s ease-in-out infinite',
      },
      keyframes: {
        float: {
          '0%, 100%': { transform: 'translateY(0px)' },
          '50%': { transform: 'translateY(-15px)' },
        },
        'float-slow': {
          '0%, 100%': { transform: 'translateY(0px)' },
          '50%': { transform: 'translateY(-20px)' },
        },
      },
      backdropBlur: {
        xs: '2px',
      },
    },
  },
  plugins: [],
}