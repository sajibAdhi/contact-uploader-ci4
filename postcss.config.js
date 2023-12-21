module.exports = {
    plugins: {
        tailwindcss: {},
        autoprefixer: {},
        ...(process.env.CI_ENVIRONMENT === 'production' ? {cssnano: {}} : {})
    },
}
