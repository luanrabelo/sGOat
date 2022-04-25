sudo apt update -y
sudo apt upgrade -y
sudo apt install ncbi-blast+ apache2 mysql-server unzip python3 -y
sudo ufw allow in "Apache"
sudo mysql_secure_installation
sudo apt install php libapache2-mod-php php-mysql -y
sudo mkdir /var/www/html/sGOat
sudo chmod 777 -R /var/www/html/sGOat
cd /var/www/html/sGOat
wget https://github.com/luanrabelo/sGOat/releases/download/sGOat-v1.0/sGOat-v1.0.zip
unzip sGOat-v1.0.zip
sudo chmod 777 -R /var/www/html/sGOat/*