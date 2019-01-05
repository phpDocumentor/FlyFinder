workflow "New workflow" {
  on = "push"
  resolves = [
    "PHP-CS-Fixer",
    "PHPStan",
  ]
}

action "PHP-CS-Fixer" {
  uses = "docker://oskarstark/php-cs-fixer-ga"
  secrets = ["GITHUB_TOKEN"]
  args = "--diff --dry-run"
}

action "PHPStan" {
  uses = "docker://oskarstark/phpstan-ga"
  args = "analyse src --level max --configuration phpstan.neon"
  secrets = ["GITHUB_TOKEN"]
}
