/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            colors: {
                primary: '#8FD14F',
                secondary: '#604CC3',
                dark: '#080330',
                light: '#ffffff',
                white: '#f7f7f7', // Pastikan ini berbeda dari light jika ada tujuan lain
                stroke: '#000000',
                purple: '#876582',
                orange: '#FF6600',
                black: '#080330', // Ini sama dengan dark, bisa disatukan atau dibedakan
            },
            fontFamily: {
                lexend: ['Lexend', 'sans-serif'],
                exo2: ['"Exo 2"', 'sans-serif'] // Perhatikan Exo 2 karena ada spasi
            },
            boxShadow: {
                'border-offset': '3px 4px 0 #080330',
                'border-offset-lg': '5px 7px 0 #080330',
            },
            borderRadius: {
                'playful-sm': '12px',
                'playful-md': '18px',
                'playful-lg': '24px',
                'playful-sm-inner': '9px',
            },
            fontSize: {
                h1: ['2.5rem', { lineHeight: '3rem', fontWeight: '700' }],
                h2: ['2rem', { lineHeight: '2.5rem', fontWeight: '700' }],
                h3: ['1.75rem', { lineHeight: '2.25rem', fontWeight: '600' }],
                h4: ['1.5rem', { lineHeight: '2rem', fontWeight: '600' }],
                h5: ['1.25rem', { lineHeight: '1.75rem', fontWeight: '500' }],
                h6: ['1rem', { lineHeight: '1.5rem', fontWeight: '500' }],
            },
        },
    },
    plugins: [],
};