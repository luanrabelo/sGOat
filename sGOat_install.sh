#!/bin/bash
apt update
apt upgrade
apt install lamp-serverˆ
echo Creating Structure sGOat
mkdir -m 777 /var/www/html/sGOat
mkdir -m 777 /var/www/html/sGOat/db
mkdir -m 777 /var/www/html/sGOat/db/swissprot
mkdir -m 777 /var/www/html/sGOat/apps
mkdir -m 777 /var/www/html/sGOat/apps/ncbi
mkdir -m 777 /var/www/html/sGOat/Projects
mkdir -m 777 /var/www/html/sGOat/uploads
chmod -R 777 /var/www/html/sGOat/*
cd /var/www/html/sGOat/apps/ncbi/
wget ftp://ftp.ncbi.nlm.nih.gov/blast/executables/blast+/LATEST/ncbi-blast-2.10.0+-x64-linux.tar.gz
tar -vzxf ncbi-blast-2.10.0+-x64-linux.tar.gz
cd ncbi-blast-2.10.0+/bin/
cp blastx /var/www/html/sGOat/apps/ncbi/
cp blastp /var/www/html/sGOat/apps/ncbi/
cp blastn /var/www/html/sGOat/apps/ncbi/
rm -r /ncbi-blast-2.10.0+
rm ncbi-blast-2.10.0+-x64-linux.tar.gz
cd /var/www/html/sGOat/db/swissprot/
wget ftp://ftp.ncbi.nlm.nih.gov/blast/db/swissprot.tar.gz
tar -vzxf swissprot.tar.gz
cd /var/www/html/sGOat/
wget https://github.com/luanrabelo/sGOat/archive/master.zip
unzip master.zip
cd /var/www/html/sGOat/sGOat-master
mv * /var/www/html/sGOat