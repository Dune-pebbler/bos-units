When initializing a new project follow these steps to push the local theme to github:

git init

git status

git add .

git commit -m "first commit"

git branch -M main

git remote add origin "urloftheprojectbutwithoutquotes".git

Before pushing we need to grab the template files from the repo, it has github workflows in it, to do this use:

git pull origin main --allow-unrelated-histories

Check your code and use git status, if evertyhing is correct go ahead and push:

git push -u origin main

If the repo already has code either pull or clone it, never push code without pulling the code first!
