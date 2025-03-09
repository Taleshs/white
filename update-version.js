const fs = require('fs');
const dotenv = require('dotenv').config();

if (!process.env.VERSION) {
  console.error('Erro: A variável VERSION não está definida no arquivo .env.');
  process.exit(1);
}

const newVersion = process.env.VERSION;

// Atualizar package.json
const packageJsonPath = './package.json';
const packageJson = require(packageJsonPath);
packageJson.version = newVersion;
fs.writeFileSync(packageJsonPath, JSON.stringify(packageJson, null, 2));
console.log(`package.json atualizado para versão ${newVersion}`);

// Atualizar style.css
const styleCssPath = './style.css';
let styleCssContent = fs.readFileSync(styleCssPath, 'utf8');

// Substituir a versão existente no style.css
styleCssContent = styleCssContent.replace(/(Version:\s*)([0-9]+\.[0-9]+\.[0-9]+)/, `$1${newVersion}`);
fs.writeFileSync(styleCssPath, styleCssContent);
console.log(`style.css atualizado para versão ${newVersion}`);
