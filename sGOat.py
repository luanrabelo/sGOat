import time
import os
import sys

def MySQLInstall():
    try:
        import mysql.connector as mysql
        from mysql.connector import Error
        print('Module mysql.connector was installed!')
        print('Module mysql.connector imported!')
    except ImportError:
        print('There was no such module installed')
        print("Installing mysql-connector-python")
        print("Please wait...")
        cmd = "python3 -m pip install -U mysql-connector-python"
        os.system(cmd)
        print("Module mysql.connector installed")
        import mysql.connector as mysql
        from mysql.connector import Error
        print('Module mysql.connector imported!')

def BioPython():
    try:
        import Bio
        print('Module Biopython was installed')
        print('Module biopython imported!')
    except ImportError:
        print('There was no such module installed')
        print("Installing BioPython")
        print("Please wait...")
        cmd = "python3 -m pip install -U biopython"
        os.system(cmd)
        print("Module BioPython installed")
        import Bio
        print('Module biopython imported!')

def Request():
    try:
        import requests
        print('Module requests was installed')
        print('Module requests imported!')
    except ImportError:
        print('There was no such module installed')
        print("Installing requests")
        print("Please wait...")
        cmd = "python3 -m pip install -U requests"
        os.system(cmd)
        print("Module requests installed")
        import requests
        print('Module requests imported!')

def BlastX(File, SeqName, idUser, idRepository, sHost, sUser, sPassword, Database, app, base, KeyUser, Table, evaluedata, numberHits, CPUBlast):
    from Bio.Blast.Applications import NcbiblastxCommandline
    BlastX  = f"./usr/bin/{app}"
    Command = NcbiblastxCommandline(
        cmd = BlastX, 
        query = File, 
        db = f"database/{base}", 
        outfmt = "6 qseqid stitle evalue sacc sseqid sgi qcovhsp", 
        out = f"Users/{KeyUser}/{Table}/results/"+SeqName+".csv", 
        evalue = evaluedata,
        max_target_seqs = numberHits,
        num_threads = CPUBlast)
    stdout, stderr = Command()
    print(f"Blast: {SeqName}")
    time.sleep(1)
    os.remove(File)
    ReadResult(f"Users/{KeyUser}/{Table}/results/"+SeqName+".csv", idUser, idRepository, sHost, sUser, sPassword, Database, Table, KeyUser)

def UpdateStatus(DataStatus, idUser, idRepository, sHost, sUser, sPassword, Database):
    import mysql.connector
    Status = str(DataStatus)
    Connection = mysql.connector.connect(host = sHost, user = sUser, passwd = sPassword, db = Database)
    Cursor  = Connection.cursor()
    Query   = "UPDATE repodata SET Status = %s WHERE idUser = %s AND idRepository = %s" 
    Values = (Status, idUser, idRepository)
    Cursor.execute(Query, Values)
    Connection.commit()
    Connection.close()

def UpdateBlasted(idUser, idRepository, sHost, sUser, sPassword, Database):
    import mysql.connector
    Connection = mysql.connector.connect(host = sHost, user = sUser, passwd = sPassword, db = Database)
    Cursor  = Connection.cursor()
    Query   = "UPDATE repodata SET `Blasted` = `Blasted`+1 WHERE idUser = %s AND idRepository = %s" 
    Values = (idUser, idRepository)
    Cursor.execute(Query, Values)
    Connection.commit()
    Connection.close()

def UpdateResult(idUser, idRepository, sHost, sUser, sPassword, Database):
    import mysql.connector
    Connection = mysql.connector.connect(host = sHost, user = sUser, passwd = sPassword, db = Database)
    Cursor  = Connection.cursor()
    Query   = "UPDATE repodata SET `Result` = `Result`+1 WHERE idUser = %s AND idRepository = %s" 
    Values = (idUser, idRepository)
    Cursor.execute(Query, Values)
    Connection.commit()
    Connection.close()

def UpdateNoResult(idUser, idRepository, sHost, sUser, sPassword, Database):
    import mysql.connector
    Connection = mysql.connector.connect(host = sHost, user = sUser, passwd = sPassword, db = Database)
    Cursor  = Connection.cursor()
    Query   = "UPDATE RepoData SET `NoResult` = `NoResult`+1 WHERE idUser = %s AND idRepository = %s" 
    Values = (idUser, idRepository)
    Cursor.execute(Query, Values)
    Connection.commit()
    Connection.close()

def DownloadXML(Voucher, Table, KeyUser):
    import requests
    import os
    if not os.path.exists(f"Users/{KeyUser}/{Table}/uniprot/"):
        os.makedirs(f"Users/{KeyUser}/{Table}/uniprot")
        print(f"Folder uniprot Created!")
    Link = f"https://www.uniprot.org/uniprot/{Voucher}.xml"
    Response = requests.get(Link)
    with open(f'Users/{KeyUser}/{Table}/uniprot/{Voucher}.xml', 'wb') as File:
        File.write(Response.content)

def ReadResult(File, idUser, idRepository, sHost, sUser, sPassword, Database, Table, KeyUser):
    import mysql.connector
    import csv
    import pandas as pd 
    import os
    FileSize = os.path.getsize(File)
    FileName = os.path.basename(File)
    FileName = str(FileName).replace(".csv", "")
    if(FileSize>0):
        HitsPD = pd.read_csv(File, low_memory = False, header = None, sep = "\t")
        Hits = len(HitsPD)
        print(f"Read Result: {File}")
        csvFile = open(File)
        csvreader = csv.reader(csvFile, delimiter = '\t')
        for row in csvreader:
            Voucher = row[3]
            if(Hits>0):
                Protein = row[1]
                SeqName = row[0]
                evalue  = row[2]
                Voucher = row[3]
                Status  = "Result"
                Connection = mysql.connector.connect(host = sHost, user = sUser, passwd = sPassword, db = Database)
                Cursor  = Connection.cursor()
                Query   = f"UPDATE {Table} SET Description = %s, Hits = %s, eValue = %s, Accession = %s, Status = %s WHERE SeqName = %s"
                Values = (Protein, Hits, evalue, Voucher, Status, SeqName)
                Cursor.execute(Query, Values)
                Connection.commit()
                Connection.close()
                print(f"Data Result MySQL: {File}")
                DownloadXML(Voucher, Table, KeyUser)
                UpdateResult(idUser, idRepository, sHost, sUser, sPassword, Database)
                csvFile.close()
                break
    else:
        Status  = "NoResult"
        Protein = "-"
        Hits    = 0
        evalue  = "-"
        Voucher = "-"
        Connection = mysql.connector.connect(host = sHost, user = sUser, passwd = sPassword, db = Database)
        Cursor  = Connection.cursor()
        Query   = f"UPDATE {Table} SET Description = %s, Hits = %s, eValue = %s, Accession = %s, Status = %s WHERE SeqName = %s"
        Values = (Protein, Hits, evalue, Voucher, Status, FileName)
        Cursor.execute(Query, Values)
        Connection.commit()
        Connection.close()
        UpdateNoResult(idUser, idRepository, sHost, sUser, sPassword, Database)
        print(f"Data Result MySQL: {FileName}")

if __name__ == "__main__":
    MySQLInstall()
    BioPython()
    Request()
    import mysql.connector
    sHost           = sys.argv[1]
    sUser           = sys.argv[2]
    sPassword       = sys.argv[3]
    Database        = sys.argv[4]
    idUser          = sys.argv[5]
    idRepository    = sys.argv[6]
    KeyUser         = sys.argv[7]
    Table           = sys.argv[8]
    app             = sys.argv[9]
    base            = sys.argv[10]
    evaluedata      = sys.argv[11]
    numberHits      = sys.argv[12]
    CPUBlast        = sys.argv[13]
    x = 0
    Connection = mysql.connector.connect(
    host = sHost,
    user = sUser, 
    passwd = sPassword, 
    db = Database)
    Query   = f"SELECT * FROM {Table} WHERE Status = 'raw' ORDER BY id ASC"
    Cursor  = Connection.cursor()
    Cursor.execute(Query)
    RowData = Cursor.fetchall()
    if(Cursor.rowcount > 0):
        UpdateStatus(str("Blasting"),idUser, idRepository, sHost, sUser, sPassword, Database)
        for Row in RowData:
            x = x + 1
            UpdateBlasted(idUser, idRepository, sHost, sUser, sPassword, Database)
            FastaFile = open(f"Users/{KeyUser}/{Table}/data/"+str(Row[4]+".fasta"), 'w')
            FastaFile.write(str(">"+Row[4]))
            FastaFile.write("\n")
            FastaFile.write(str(Row[5]))
            FastaFile.close()
            BlastX(f"Users/{KeyUser}/{Table}/data/"+str(Row[4]+".fasta"), str(Row[4]), idUser, idRepository, sHost, sUser, sPassword, Database, app, base, KeyUser, Table, evaluedata, numberHits, CPUBlast)
    Connection.close()
    UpdateStatus(str("Blast Done"),idUser, idRepository, sHost, sUser, sPassword, Database)