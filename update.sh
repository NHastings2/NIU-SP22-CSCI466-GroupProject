git pull

#Upload to repo
git add --all
git commit -m "Updated Core Repo"
git push

#Copy files to live area
cp -r www/. ../../public_html/csci466/group_project/ww
