module.exports = {
  content: ["./**/*.php", "./assets/js/**/*.js"],
  theme: {
    extend: {
      colors: {
        brand: {
          orange: "#f38e19",
          "orange-light": "#ff8533",
          "orange-dark": "#e07d08",
        },
        secondary: {
          DEFAULT: "#1F2937",
          dark: "#111827",
          light: "#374151",
        },
      },
      container: {
        center: true,
        padding: {
          DEFAULT: "1rem",
          sm: "2rem",
          lg: "4rem",
          xl: "5rem",
        },
      },
    },
  },
  plugins: [
    require("@tailwindcss/typography"),
    require("@tailwindcss/forms"),
    require("@tailwindcss/aspect-ratio"),
  ],
};
