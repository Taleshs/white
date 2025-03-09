const fs = require('fs');

const commitMsgFile = process.argv[1]; // Pega o caminho do commit message
const commitMsg = fs.readFileSync(commitMsgFile, 'utf8').trim();

// Mapeia os tipos para o formato desejado
const commitMap = {
  'fix': '[FIX]',
  'feat': '[FEATURE]',
  'docs': '[DOCS]',
  'style': '[STYLE]',
  'refactor': '[REFACTOR]',
  'test': '[TEST]',
  'chore': '[CHORE]',
  'build': '[BUILD]',
  'ci': '[CI]',
  'perf': '[PERF]',
  'revert': '[REVERT]',
  'hotfix': '[HOTFIX]'
};

// Verifica se o commit começa com um dos tipos e converte para o formato desejado
const match = commitMsg.match(/^(\w+):\s*(.*)/);
if (match) {
  const type = match[1];
  const message = match[2];

  if (commitMap[type]) {
    const formattedCommit = `${commitMap[type]} ${message}`;
    fs.writeFileSync(commitMsgFile, formattedCommit);
  }
}
