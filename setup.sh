#!/bin/bash

cd

echo "Running :sudo apt-get update"
sudo apt-get update

echo "Running: sudo apt-get install g++"
sudo apt-get install g++

echo "Running:sudo apt-get install gdb"
sudo apt-get install gdb

echo "Running: sudo apt-get install make"
sudo apt-get install make

echo "Running: sudo apt-get install cscope"
sudo apt-get install cscope

echo "Running: sudo apt-get install vim"
sudo apt-get install vim

echo "Running: sudo apt-get install git"
sudo apt-get install git

echo "Running: sudo apt-get install libcap-dev"
sudo apt-get install libcap-dev 

echo "Running: git config --global user.name "Debdipta Ghosh""
git config --global user.name "Debdipta Ghosh"

echo "Running: git config --global user.email /"debdipta1078@gmail.com/""
git config --global user.email "debdipta1078@gmail.com"

echo "Running: git clone https://github.com/stealth/sshttp.git"
git clone https://github.com/stealth/sshttp.git

echo "Running: https://github.com/debdipta/vimrc.git"
git clone https://github.com/debdipta/vimrc.git

echo "Running: https://github.com/debdipta/tista.git"
git clone https://github.com/debdipta/tista.git
cd
echo "Copying vimrc"
cp ~/vimrc/vimrc ~/.vimrc

echo "alias vi="/usr/bin/vim"" >> ~/.profile
echo "EDITOR=vim" >> ~/.profile
echo "export EDITOR " >> ~/.profile
