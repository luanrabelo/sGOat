# %%
import os
import sys
import time 

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

def ReadFasta(File, Repository, idRepository, User, sHost, sUser, sPassword, sDatabase):
    MySQLInstall()
    BioPython()
    from Bio import SeqIO
    import mysql.connector as mysql
    Connection  = mysql.connect(host = sHost, user = sUser, passwd = sPassword, database = sDatabase)
    Cursor      = Connection.cursor()
    i = 0
    with open(File) as handle:
        for record in SeqIO.parse(handle, "fasta"):
            i = i + 1
            now         = time.strftime("%Y-%m-%d %H:%M:%S")
            InsertMySQL = "INSERT INTO "+Repository+" (idRepository, idUser, Status, SeqName, Seq, Description, Organism, Hits, eValue, Accession, GONames, GOFunctions, Date) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)"
            Values = (str(idRepository), str(User), 'raw', str(record.id).replace(" ", "_"), str(record.seq), "", "", "", "", "", "", "", now)
            Cursor.execute(InsertMySQL, Values)
            Connection.commit()
    UpdateMySQL = "UPDATE repodata SET Sequences = %s WHERE idUser = %s AND idRepository = %s"
    Values = (i, User, idRepository)
    Cursor.execute(UpdateMySQL, Values)
    Connection.commit()
    Cursor.close()
    Connection.close()
    print("Done")

if __name__ == "__main__":
    FastaFile       = sys.argv[1]
    Repository      = sys.argv[2]
    idRepository    = sys.argv[3]
    idUser          = sys.argv[4]
    sHost           = sys.argv[5]
    sUser           = sys.argv[6]
    sPassword       = sys.argv[7]
    sDatabase       = sys.argv[8]
    ReadFasta(FastaFile, Repository, idRepository, idUser, sHost, sUser, sPassword, sDatabase)


