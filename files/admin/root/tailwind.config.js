const plugin = require('tailwindcss/plugin');

module.exports = {
    theme: {
        container: {
            center: true,
            padding: '20px',
        },
        borderRadius: {
            xs: '6px',
            sm: '11px',
            md: '15px',
            lg: '19px',
            full: '9999px',
        },
        colors: {
            white: 'white',
            white: 'black',
            blue: {
                100: '#EDF2FF',
                200: '#D4E0FF',
                300: '#ABC2FF',
                400: '#6489FF',
                500: '#4951F2',
                600: '#3038CA',
                700: '#252C9F',
                800: '#1E216D',
                900: '#0C122D',
                DEFAULT: '#4951F2',
            },
            gray: {
                100: '#F5F8FB',
                200: '#EEF2F7',
                300: '#E5EAEF',
                400: '#DAE1E8',
                500: '#CFD9E2',
                600: '#A6B5C5',
                700: '#6C8199',
                800: '#5A6776',
                900: '#404A56',
                DEFAULT: '#6C8199',
            },
            green: {
                100: '#E7FFF3',
                200: '#D0FFE9',
                300: '#A6FFD5',
                400: '#78FFBF',
                500: '#40FFA4',
                600: '#37CA85',
                700: '#238155',
                800: '#145436',
                900: '#0F4029',
                DEFAULT: '#78FFBF',
            },
            red: {
                100: '#FFE3E6',
                200: '#FFCACF',
                300: '#FFA9B1',
                400: '#FF8A96',
                500: '#D4002E',
                600: '#D4002E',
                700: '#7A001A',
                800: '#4E0011',
                900: '#3D000D',
                DEFAULT: '#FF8A96',
            },
            yellow: {
                100: '#FFF6D8',
                200: '#FFF0BD',
                300: '#FFE793',
                400: '#FFDC65',
                500: '#FFCB18',
                600: '#E6B818',
                700: '#A76F00',
                800: '#684500',
                900: '#513600',
                DEFAULT: '#FFDC65',
            },
        },
        fontFamily: {
            sans: ['Inter', 'sans-serif'],
        },
        fontSize: {
            xs: ['10px', '17px'],
            sm: ['12px', '21px'],
            base: ['14px', '24px'],
            lg: ['16px', '24px'],
            xl: ['25px', '33px'],
            '2xl': ['28px', '38px'],
        },
        boxShadow: {
            DEFAULT: '0px 0px 19px 0px rgba(0,0,0,0.08)',
        },
        extend: {},
    },
    plugins: [
        plugin(function ({ addBase }) {
            addBase({
                body: {
                    fontFamily: ['Ubuntu'],
                    '@apply text-blue text-base antialiased': {},
                },
                'h1, h2, h3, h4, p, ol, ul, .h1, .h2, .h3, .h4, blockquote': {
                    maxWidth: '630px',
                    '@apply mb-8': {},
                },
                'p + h1, p + h2, p + h3, p + h4': {
                    '@apply pt-8': {},
                },
                'h1, .h1': {
                    '@apply text-xl lg:text-2xl font-semibold': {},
                },
                'h2, .h2': {
                    paddingRight: '10%',
                    '@apply text-lg lg:text-xl font-semibold': {},
                },
                'h3, .h3': {
                    paddingRight: '10%',
                    '@apply text-base lg:text-lg font-semibold': {},
                },
                'h4, .h4': {
                    '@apply text-base font-semibold': {},
                },
                'main a': {},
                'main ol': {
                    listStyle: 'none',
                    counterReset: 'li',
                },
                'main ul': {
                    listStyle: 'none',
                },
                'main ol, main ul': {
                    position: 'relative',
                    paddingLeft: '35px',
                },
                'main ol>li::before': {
                    content: 'counter(li)',
                },
                'main ul>li::before': {
                    content: '"•"',
                },
                'main li::before': {},
                'main ol li': {
                    counterIncrement: 'li',
                },
                'main li': {
                    '@apply pb-4': {},
                },
                'main li *': {
                    '@apply pb-0 mb-0': {},
                },

                blockquote: {
                    '@apply pb-8': {},
                },
                '.container .container': {
                    '@apply px-0': {},
                },
            });
        }),
    ],
};
