workflow "New workflow" {
  on = "push"
  resolves = [
    "PHPStan",
  ]
}

action "PHPStan" {
  uses = "docker://oskarstark/phpstan-ga:with-extensions"
  args = "analyse src --level max --configuration phpstan.neon"
  secrets = ["GITHUB_TOKEN"]
}
