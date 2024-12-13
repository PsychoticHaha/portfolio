module.exports = {
    extends: "stylelint-config-standard", // Configuration standard de Stylelint
    rules: {
        "indentation": 2, // Utilise 2 espaces pour l'indentation
        "number-leading-zero": "always", // Toujours un zéro avant les nombres décimaux
        "color-hex-length": "short", // Préfère les couleurs hexadécimales courtes
        "color-function-notation": "legacy",
        "media-feature-range-notation": "standard"
    },
};
