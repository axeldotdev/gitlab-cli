# Gitlab CLI

[![Latest Version on Packagist](https://img.shields.io/packagist/v/axeldotdev/gitlab-cli.svg?style=flat-square)](https://packagist.org/packages/axeldotdev/gitlab-cli)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/axeldotdev/gitlab-cli/run-tests?label=tests)](https://github.com/axeldotdev/gitlab-cli/actions?query=workflow%3ATests+branch%3Amaster)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/axeldotdev/gitlab-cli/Check%20&%20fix%20styling?label=code%20style)](https://github.com/axeldotdev/gitlab-cli/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amaster)
[![Total Downloads](https://img.shields.io/packagist/dt/axeldotdev/gitlab-cli.svg?style=flat-square)](https://packagist.org/packages/axeldotdev/gitlab-cli)

This is a CLI that helps you use the Gitlab API.

## Installation

You can install the package via composer:

```bash
composer create-project --prefer-dist axeldotdev/gitlab-cli gitlab-cli
```

## Gitlab API Resource

[https://docs.gitlab.com/ee/api/api_resources.html](https://docs.gitlab.com/ee/api/api_resources.html)

## Usage

You need to run the commands below in a Git repository.

### Authentication

You need to generate an access token on Gitlab to use the API.

To create a new access token, go to your [access tokens section on GitLab](https://gitlab.com/-/profile/personal_access_tokens) (or the equivalent URL on your private instance) and create a new token. See also [the GitLab access token documentation](https://docs.gitlab.com/ee/user/profile/personal_access_tokens.html#creating-a-personal-access-token) for more informations.

When you have your personal access token, add it to your composer global `auth.json`. See also [The Composer authentification documentation](https://getcomposer.org/doc/articles/authentication-for-private-packages.md#gitlab-token) for more informations.

**Currently this package only works with Gitlab cloud. If you have a self-hosted Gitlab instance, you need to wait next release, I'm sorry.**

**WORK IN PROGRESS**

Then you can register it with the command: `gitlab-cli register:token {personal_token}`

If you have a self-hosted Gitlab, you can register it with the command: `gitlab-cli register:host {host_uri}`


### Issues

#### Create

TODO

#### Update

TODO

#### Delete

TODO

#### Reopen

```
gitlab-cli issue:reopen {issue_iid}

# gitlab-cli issue:reopen 345
```

#### Close

```
gitlab-cli issue:close {issue_iid}

# gitlab-cli issue:close 345
```

#### Browse

```
gitlab-cli issue:browse {issue_iid}

# gitlab-cli issue:browse 345
```

*Only works on macOS*

#### Add Labels

```
gitlab-cli issue:label:add {issue_iid} {label_names}

# gitlab-cli issue:label:add 345 todo,bug,auth
```

#### Remove Labels

```
gitlab-cli issue:label:remove {issue_iid} {label_names}

# gitlab-cli issue:label:remove 345 todo,bug,auth
```

#### Replace Labels

```
gitlab-cli issue:label:add {issue_iid} {old_label_names} {new_label_names}

# gitlab-cli issue:label:add 345 todo testing
```

#### Link Milestone

```
gitlab-cli issue:milestone:link {issue_iid} {milestone_iid}

# gitlab-cli issue:milestone:link 345 25
```

#### Unlink Milestone

```
gitlab-cli issue:milestone:unlink {issue_iid} {milestone_iid}

# gitlab-cli issue:milestone:unlink 345 25
```

#### Link Epic

```
gitlab-cli issue:epic:link {issue_iid} {milestone_iid}

# gitlab-cli issue:epic:link 345 25
```

#### Unlink Epic

```
gitlab-cli issue:epic:unlink {issue_iid} {milestone_iid}

# gitlab-cli issue:epic:unlink 345 25
```

### Milestones

#### Create

TODO

#### Update

TODO

#### Delete

TODO

### Releases

#### Create

TODO

#### Update

TODO

#### Delete

TODO

### Epics

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Axel Charpentier](https://github.com/axeldotdev)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
