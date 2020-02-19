#!/bin/bash

MESSAGE=$1
BRANCH=$2

git add .
git commit -am '$MESSAGE'
git push origin $BRANCH
exit
git checkout master
git merge $BRANCH
git push origin master
git status
