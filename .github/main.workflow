workflow "New workflow" {
  on = "push"
  resolves = ["oskarstark/php-cs-fixer-ga"]
}

action "PHP CS FIXER" {
  uses = "docker://oskarstark/php-cs-fixer-ga"
  secrets = ["GITHUB_TOKEN"]
  args = "--diff --dry-run"
}
