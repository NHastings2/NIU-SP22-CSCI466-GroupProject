#Change Directory to Project
cd github/NIU-SP22-CSCI466-GroupProject/

#Upload to repo
git add --all
git commit -m "Updated Core Repo"
git push

#Update the repository
git pull

#Copy files to live area
cp -r www/. ../../www/
