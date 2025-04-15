# WSL + VSCode developer enviroment

With "Windows Subsystem for Linux" there is actually no reason to switch to a full Linux only for development or to use Docker. You will have a full working Linux under Windows.

## Setup WSL

> [!TIP]
> For a clean install run `wsl --uninstall` before to delete old WSL setups.

1. Install WSL System with Ubuntu as the default distribution:  
`wsl --install`  
*(Fellow the instructions to create a linux user)*

2. Always run WSL as Linux root:  
`ubuntu config --default-user root`  
*(This will prevent many problems especaly when apps like VSCode use WSL to change protected files. But never use a live Linux as root user.)*

## Setup Visual Studio Code

1. Install the [WSL Extension](https://marketplace.visualstudio.com/items?itemName=ms-vscode-remote.remote-wsl)

2. Connect to WSL by using the Remote Explorer (blue bottom in the status bar or from the Remote Explorer Tab)

## Infos

Now you have a VSCode Window to fully work with Linux.

To access the Linux shell use the already connectet terminal directly in VSCode or run `wsl` in a Windows Terminal.

There is nearly nothing you need to do different from a "real" Ubuntu runnung system. For example, your Linux Web Server is even reachable under Windows. This allows you to release a project 1:1 on a linux Webserver running Ubuntu.

## Other helpfull commands

- Install WSL without Ubuntu as pre distribution:  
`wsl --install --no-distribution`

- Install Ubuntu:  
`wsl --install 'Ubuntu'`

- Deinstall the Ubuntu:  
`wsl --unregister 'Ubuntu'`

- Shutdown WSL and its distribution completely:  
`wsl --shutdown`