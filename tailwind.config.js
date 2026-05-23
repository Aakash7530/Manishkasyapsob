export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Inter', 'sans-serif'],
                display: ['Outfit', 'sans-serif'],
            },
            colors: {
                primary: {
                    50: '#fdf3f3',
                    100: '#fbe5e5',
                    500: '#ef4444', // Red for journalism
                    600: '#dc2626',
                    900: '#7f1d1d',
                },
                dark: {
                    bg: '#0f172a',
                    card: '#1e293b',
                    border: '#334155',
                }
            }
        },
    },
    darkMode: 'class',
    plugins: [
        require('@tailwindcss/typography'),
        require('@tailwindcss/forms'),
    ],
}
