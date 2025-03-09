const fs = require('fs');

// Verifica se o argumento do arquivo de commit foi passado
const commitMsgFile = process.argv[2];

if (!commitMsgFile) {
  console.error("❌ Erro: Caminho do arquivo de commit não fornecido.");
  process.exit(1);
}

const commitMsg = fs.readFileSync(commitMsgFile, 'utf8').trim();

// Mapeia os tipos de commit para os tags desejados
const commitMap = {
  'feat': '[FEATURE]',
  'fix': '[FIX]',
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

// Verifica se o commit começa com um dos tipos e substitui pelo formato desejado
const match = commitMsg.match(/^(\w+):\s*(.*)/);
if (match) {
  const type = match[1];
  const message = match[2];

  if (commitMap[type]) {
    const formattedCommit = `${commitMap[type]}: ${message}`;
    fs.writeFileSync(commitMsgFile, formattedCommit + '\n'); // Sobrescreve a mensagem do commit
  }
}
