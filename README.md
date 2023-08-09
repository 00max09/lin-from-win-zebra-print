# lin-from-win-zebra-print
Printing from linux system on printer connected to Windows using PHP script

## How to add shared Windows printer to linux system
Make sure that Windows printer is shared\
\
For every printer you want to add to system type in terminal (substitute LINUX_PRINTER_NAME (that is name that will be shown), WINDOWS_USER, WINDOWS_PASSWORD, WINDOWS_HOST_ADDRESS, PRINTER_NAME) : 
### If Windows printer is behind password
```
sudo lpadmin -p LINUX_PRINTER_NAME -E -v 'smb://WINDOWS_USER:WINDOWS_PASSWORD@WINDOWS_HOST_ADDRESS/PRINTER_NAME'
```
### Else if Windows printer is not behind password
```
sudo lpadmin -p LINUX_PRINTER_NAME -E -v 'smb://WINDOWS_HOST_ADDRESS/PRINTER_NAME'
```

## Known issues 


- There is possibility that you don't have installed SAMBA server. In Ubuntu you can install it by typing 
```
sudo apt install samba
```
- There can be some problems with old Windows versions that does not natively support SMB2(or SMB2 is not enabled) in this case you can add to `/etc/samba/smb.conf` file after line with `workgroup` to enable SMB1 communication (Note that SMB1 has some known security issues and may be dangerous)
```
client min protocol = NT1
server min protocol = NT1
```
- 'print.php' file does create temporary file, so there is possibility that php doesn't have permissions to create and edit files in directory

- On old operatining systems there is possibility that you have to submit in what workgroup is Windows computer in this case instead of just `WINDOWS_HOST_ADDRESS` you have to type `WORKGROUP/WINDOWS_HOST_ADDRESS`

## WARNING

In current state implementation is very dangerous and malicous user can easily get access to whole operating system effectively running any code on server