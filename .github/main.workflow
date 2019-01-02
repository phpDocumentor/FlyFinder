workflow "New workflow" {
  on = "push"
  resolves = ["oskarstark/php-cs-fixer-ga"]
}

action "oskarstark/php-cs-fixer-ga" {
  uses = "oskarstark/php-cs-fixer-ga"
  secrets = ["GITHUB_TOKEN"]
  args = "--diff --dry-run"
}
