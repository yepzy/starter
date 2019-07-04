<Todo : personalize readme>

# Pre-built base for new app development on Laravel 5.8

**Master :** 
`<build-status-badge>`
`<coverage-report-badge>`  
**Develop :**
`<build-status-badge>`


------------------------------------------------------------------------------------------------------------------------

## Installation

### Required
- Git installed.
- Docker Community Edition installed : https://docs.docker.com/install.
- Node last LTS version installed (important to avoid errors).
- Yarn last stable version installed.

### Import and git setup
Clone the project `<project-repository>`.

### DNS setup
Set your project domain resolution in your virtualhost : `sudo vim /etc/hosts`
```sh
    # add these lines in your /etc/hosts file
    <project-local-ip>   <project-local-dns>
```

### Project configuration and dependencies installation 
First, execute the following commands on your host machine :
- `cp .env.example .env`. Then set the environment variable according to your project needs.
- `git submodule update --init --recursive --remote --force`
- `yarn install`
- `.utils/docker/up.sh --build` 
- `.utils/docker/workspace.sh` 
Once you are connected into your docker workspace (previous command), execute the following commands :
- `composer install`
- `php artisan key:generate`
- `php artisan storage:link`
- `php artisan migrate:refresh --seed`
Finally, back on your host machine, execute the following commands :
- `yarn dev` or `yarn watch`

------------------------------------------------------------------------------------------------------------------------

## Docker
This project use the following docker submodule : `<project-docker-repository>`.

### Setup
- In your `.docker` directory, copy the `env-example` to `.env` in the same directory.
- Customize the needed values if needed (containers ports, for example).

### Commands
**Notice :** all the commands listed bellow are shortcuts. If you are more comfortable to directly use the docker commands, make yourself at ease but you should give a look to the docker utils files content.
- Start and build your project in docker by running the command : `./.utils/docker/up.sh --build`
- To start your project without building it, just execute `./.utils/docker/up.sh`
- Access to your docker workspace with : `./.utils/docker/workspace` (you will be connected as the `Laradock` user. The get connected with the root user, add the `--root` option to the command)
- Stop your project docker with `./.utils/docker/stop.sh`

------------------------------------------------------------------------------------------------------------------------

## Git submodules
To update the project submodules, just execute this command : `./.utils/git/submodules/update.sh` (or `git submodule update --init --recursive --remote --force` when it is the first sync).

------------------------------------------------------------------------------------------------------------------------

## Database
- Execute a database reset from your docker `workspace` with the command : `php artisan migrate:refresh --seed` : this will execute all your migrations and seeds.

------------------------------------------------------------------------------------------------------------------------

## Building resources
Compile all your project resources (mainly sass and javascript) by executing the following commands.
You can run these commands from your docker workspace, Node and Yarn are installed. However, running them from your host machine will be quicker.
- `yarn dev` (does merge but does not minify resources).
- `yarn prod` (does merge **and** minify).
- `yarn watch` (recompile automatically when a change is detected in a resource file).

------------------------------------------------------------------------------------------------------------------------

## Testing
- To launch the project test, run the following command : `composer test`.

------------------------------------------------------------------------------------------------------------------------

## Debugging

This project has Laravel Telescope included. To open the debug dashboard go to `http://your-project.url/telescope`
