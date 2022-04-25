import os
import time
try:
    import requests
except ImportError:
    cmd = "python3 -m pip install -U requests"
    os.system(cmd)
    import requests

try:
    import mysql.connector as mysql
    from mysql.connector import Error
except ImportError:
    cmd = "python3 -m pip install -U mysql-connector-python"
    os.system(cmd)
    import mysql.connector as mysql
    from mysql.connector import Error

def CreateFolder(Folder):
    if not os.path.exists(Folder):
        os.makedirs(Folder)

def Download(sHost, sUser, sPass, sDatabase):
    import mysql.connector
    import requests
    url = "https://ftp.ncbi.nlm.nih.gov/blast/db/swissprot.tar.gz"
    CreateFolder("database")
    FileName    = "swissprot.tar.gz"
    Path        = os.path.join("database", FileName)
    Download    = requests.get(url, stream = True)
    if Download.ok:
        with open(Path, 'wb') as f:
            for chunk in Download.iter_content(chunk_size = 1024*8):
                if chunk:
                    f.write(chunk)
                    f.flush()
                    os.fsync(f.fileno())
        Now = str(time.strftime("%Y-%m-%d %H:%M:%S"))
        Connection = mysql.connector.connect(host = sHost, user = sUser, passwd = sPass, db = sDatabase)
        Cursor  = Connection.cursor()
        Query   = "UPDATE swissprot SET Date = '"+ str(Now) +"' WHERE id = '1'"
        Cursor.execute(Query)
        Connection.commit()
        Connection.close()
        cmd = "tar -xzvf swissprot.tar.gz"
        os.system(cmd)
    else:
        print("Download failed: status code {}\n{}".format(Download.status_code, Download.text))

if __name__ == "__main__":
    sHost = "localhost"
    sUser = "root"
    sPass = "root"
    sDatabase = "sgoat"
    Download(sHost, sUser, sPass, sDatabase)