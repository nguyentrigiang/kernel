#!/bin/sh

if [ -d .subsplit ]; then
    git subsplit update
else
    git subsplit init git@github.com:orchestral/kernel.git
fi

git subsplit publish --heads="3.9" src/Config:git@github.com:orchestral/config.git
git subsplit publish --heads="3.9" src/Database:git@github.com:orchestral/database.git
git subsplit publish --heads="3.9" src/Hashing:git@github.com:orchestral/hashing.git
git subsplit publish --heads="3.9" src/Http:git@github.com:orchestral/http.git
git subsplit publish --heads="3.9" src/Notifications:git@github.com:orchestral/notifications.git
git subsplit publish --heads="3.9" src/Routing:git@github.com:orchestral/routing.git
