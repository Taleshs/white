const file_system = require('fs');
const path = require('path');
const archiver = require('archiver');
const dotenv = require('dotenv').config({ path: '.env' });

let full_path = path.join(__dirname, '../');

console.log('Compressing theme dir, this might take a few seconds...');

/** Progress bar function */
async function main() {
    for (let i = 0; i <= 20; i++) {
        const dots = ".".repeat(i);
        const empty = " ".repeat(20 - i);
        process.stdout.write(`\r[${dots}${empty}] ${i * 5}%`);
        await wait(200);
    }
    console.log('\n');
}

main();

function wait(ms) {
    return new Promise(res => setTimeout(res, ms));
}

let output = file_system.createWriteStream(`${full_path}${process.env.THEME_NAME}.zip`);
let archive = archiver('zip', { zlib: { level: 9 } });

output.on('close', function () {
    console.log(`The file is located on: ${full_path}${process.env.THEME_NAME}.zip`);
    console.log(`The file size is: ${archive.pointer()} total bytes`);
    console.log('Archiver has been finalized and the output file descriptor has closed.');
});

archive.on('error', function (err) {
    throw err;
});

archive.pipe(output);

archive.glob('**/*', {
    cwd: __dirname,
    ignore: [
        'node_modules/**',
        '.git/**',
        '.gitignore',
        '.vscode/*',
        'commitlint.config.js',
        'package.json',
        'package-lock.json',
        'vite.assets.config.js',
        'vite.sections.config.js',
        'composer.*'
    ],
});

archive.finalize();
