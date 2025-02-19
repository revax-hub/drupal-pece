/*
** TailwindCSS Configuration File
**
** Docs: https://tailwindcss.com/docs/configuration
** Default: https://github.com/tailwindcss/tailwindcss/blob/master/stubs/defaultConfig.stub.js
*/
module.exports = {
  theme: {
    extend: {
      colors: {
        primary: '',
        accent: '#3D42C7',
        accentHover: '#595BB5',
        headerAdmin: '#2d2d2d',
        overlay: 'rgba(0, 0, 0, 0.4)'
      },
      boxShadow: {
        pece: '0 6px 4px #F7FAFC',
        gray100: '0 6px 4px #EDF2F7'
      },
      margin: {
        '-px': '-1px',
        '-1': '-0.25rem',
        '-2': '-0.5rem',
        '-3': '-0.75rem',
        '-4': '-1rem'
      }
    }
  },
  variants: {
    borderWidth: ['responsive', 'hover', 'focus'],
    width: ['responsive', 'hover', 'focus']
  },
  plugins: []
}
