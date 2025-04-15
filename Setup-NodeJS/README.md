# NodeJS Enviroment

The only logic and right way to install NodeJS Enviroment on windows

## Install NodeJS

Install with winget:  
`winget install OpenJS.NodeJS`

## Importand Settings
Fix the global install path for the npm package manager:  
`npm config set prefix "C:\Program Files\nodejs"`  
*(otherwise, for whatever stupid reason, it uses a new path under user.*)

## Update the package manager

Update the already pre-installed package manager  
`npm update -g`

## More side informations

### Update NodeJS
Simple use winget:  
`winget upgrade OpenJS.NodeJS`  
*(maybe you need to update the package manager again*)

### "But there are other package managers"

Yes but just like 70% of library's they only exist to make the 2 devs mentally happy but pointless confuse all other humans by reinvent the wheel again to improve something that doesn't need to be improved only to save 1 second in the package installation process or to save 100mb when you use multiple projects 😊