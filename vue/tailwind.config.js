const defaultTheme = require('tailwindcss/defaultTheme')

module.exports = {
  content: [
    "./index.html",
    "./src/**/*.{vue,js,ts,jsx,tsx}",
  ],
  theme: {
    extend: {
      keyframes: {
        'fade-in-down': {
          'from': {
            transform: 'translateY(-0.75rem)',
            opacity: '0'
          },
          'to': {
            transform: 'translateY(0rem)',
            opacity: '1'
          }
        },
        'fade-in-up': {
          'from': {
            transform: 'translateY(0.75rem)',
            opacity: '0'
          },
          'to': {
            transform: 'translateY(0rem)',
            opacity: '1'
          }
        },
        'fade-in-right': {
          'from': {
            transform: 'translateX(-0.75rem)',
            opacity: '0'
          },
          'to': {
            transform: 'translateY(0rem)',
            opacity: '1'
          }
        },
        'fade-in-left': {
          'from': {
            transform: 'translateX(0.75rem)',
            opacity: '0'
          },
          'to': {
            transform: 'translateY(0rem)',
            opacity: '1'
          }
        },
        'fade-out-left': {
          'from': {
            transform: 'translateY(0rem)',
            opacity: '1'
          },
          'to': {
            transform: 'translateX(0.75rem)',
            opacity: '0'
          },
        },
      },
      animation: {
        'fade-in-down': 'fade-in-down 0.2s ease-in-out both',
        'fade-in-up': 'fade-in-up 0.2s ease-in-out both',
        'fade-in-left': 'fade-in-left 0.2s ease-in-out both',
        'fade-in-right': 'fade-in-right 0.2s ease-in-out both',

        'fade-out-left': 'fade-in-left 0.2s ease-in-out both',
      }
    },
    screens: {
      'xs': '475px',
      ...defaultTheme.screens,
    },
  },
  plugins: [
    require('@tailwindcss/forms'),
    require('@tailwindcss/aspect-ratio'),
  ],
}
