module.exports = {
    extends: ['@commitlint/config-conventional'],
    rules: {
      'type-enum': [2, 'always', [
        'build', 'chore', 'ci', 'docs', 'feat', 'fix', 'perf', 'refactor', 'revert', 'style', 'test', 'hotfix'
      ]],
      'subject-empty': [2, 'never'],  
      'type-empty': [2, 'never'],  
      'header-max-length': [2, 'always', 100], 
      'type-case': [2, 'always', 'lower-case'], 
    },
    ignores: [
      (message) => message.startsWith('[FEATURE]'),
      (message) => message.startsWith('[FIX]'),
      (message) => message.startsWith('[DOCS]'),
      (message) => message.startsWith('[STYLE]'),
      (message) => message.startsWith('[REFACTOR]'),
      (message) => message.startsWith('[TEST]'),
      (message) => message.startsWith('[CHORE]'),
      (message) => message.startsWith('[BUILD]'),
      (message) => message.startsWith('[CI]'),
      (message) => message.startsWith('[PERF]'),
      (message) => message.startsWith('[REVERT]'),
      (message) => message.startsWith('[HOTFIX]')
    ],
  };
  