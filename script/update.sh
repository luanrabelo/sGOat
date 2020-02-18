#!/bin/bash
cd /var/www/html/sGOat/db/swissprot/
wget ftp://ftp.ncbi.nlm.nih.gov/blast/db/swissprot.tar.gz
tar -vzxf swissprot.tar.gz
cd swissprot
cp * /var/www/html/sGOat/db