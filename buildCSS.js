const fs = require('fs');
const path = require('path');
const postcss = require('postcss');
const postcssImport = require('postcss-import');
const CleanCSS = require('clean-css');

// Fichier source principal et de sortie
const sourceFile = path.join(__dirname, './stylesheets/', 'style.css');
const outputDir = path.join(__dirname, './stylesheets/');
const outputFile = path.join(outputDir, 'style.min.css');

// Fonction pour compiler et minifier le CSS
const buildCSS = async () => {
    if (!fs.existsSync(sourceFile)) {
        console.error(`❌ Fichier source introuvable : ${sourceFile}`);
        return;
    }

    console.log(`📄 Traitement du fichier principal : ${sourceFile}`);

    try {
        // Lire le contenu du fichier source
        const cssContent = fs.readFileSync(sourceFile, 'utf-8');

        // Traiter les imports avec PostCSS et postcss-import
        const processedCSS = await postcss([postcssImport]).process(cssContent, {
            from: sourceFile,
        });

        // Minifier avec CleanCSS
        const minified = new CleanCSS().minify(processedCSS.css);
        if (minified.errors.length) {
            console.error('❌ Erreurs de minification CSS:', minified.errors);
            return;
        }

        // Créer le répertoire de sortie s'il n'existe pas
        if (!fs.existsSync(outputDir)) {
            fs.mkdirSync(outputDir, { recursive: true });
            console.log(`📂 Création du répertoire : ${outputDir}`);
        }

        // Écrire le fichier minifié
        fs.writeFileSync(outputFile, minified.styles, 'utf-8');
        console.log(`✅ CSS minifié créé avec succès : ${outputFile}`);
    } catch (error) {
        console.error('❌ Erreur lors de la compilation du CSS:', error);
    }
};

// Exécuter le script
buildCSS();
