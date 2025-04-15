# WinGet cheat sheet

Helpfull cheat sheet for the new package manager for windows.

## Commands

### install
Install a Package with the exact package ID.
```
winget install --exact --id [PACKAGE ID]

# More Options

--silent                (Try to use the silent instalation)  
--interactive           (Force GUI Installer)
--installer-type [TYP]  (Change the installer)  
--custom [COMMAND]      (Commands for the Installer)  
--manifest [FILE]       (Intall a local package from YAML file)
```

### show
Show infos about a package.
```
winget show --exact --id [PACKAGE ID]
```

### search
Search for Packages with a part of the name or ID.
```
winget search [PACKAGE NAME/ID]
```

### list
List all installed Packages, even those not installed by winget.
```
winget list
```

### upgrade
Shows and performs available upgrades.
```
winget upgrade [PACKAGE NAME/ID]
winget upgrade --all
```

### configure
Make your system ready for a development environment via config file. (WIP)
```
winget configuration [command] [configuration.dsc.yaml]

# Commands

show        Shows details of a configuration
list        Shows configuration history
test        Checks the system against a desired state
validate    Validates a configuration file
```

### export / import
Export and import a list of packages to install.
```
winget export --output [FILE.json]
winget import --import-file [FILE.json]
```
